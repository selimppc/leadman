<?php

namespace App\Http\Controllers\Auth;
use App\Role;
use App\User;
use App\UserActivity;
use App\UserImage;
use App\UserLoginHistory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use URL;
use HTML;
use Mockery\CountValidator\Exception;
use Validator;
use Input;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Session\TokenMismatchException;

use App\Helpers\MenuItems;
use Illuminate\Support\Facades\Schema;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;
use App\MenuPanel;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }*/

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
           # 'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            #'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /*password reset before login by inactive user*/
    public function reset_password($user_id){

        return view('user::reset_password._form',['user_id'=>$user_id]);
    }

    public function update_new_password(Request $request){

        $input = $request->all();

        date_default_timezone_set("Asia/Dacca");

        if($input['confirm_password']==$input['password']) {

            $model = User::findOrFail($request['user_id']);
            $model->password = Hash::make($input['password']);
            $model->last_visit = date('Y-m-d h:i:s', time());
            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                $model->save();
                DB::commit();

                Auth::logout();
                Session::flush(); //delete the session

                Session::flash('message','Successfully Reset Your Password.You May Login Now.');
                return redirect()->route('get-user-login');
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('error',$e->getMessage());
            }
        }
        else{
            Session::flash('error', "Password and Confirm Password Does not match !");
        }
        return redirect()->back();
    }

    public function getLogin()
    {
        if(Session::has('email')) {
            return view('admin::layouts.dashboard');
        }
        else{
            return view('user::signin._form');
        }
    }

    public function postLogin(Request $request)
    {
        /*if ($e instanceof TokenMismatchException){

            // Catch it here and do what you want. For example...
            return redirect()->back()->withInput()->with('error', 'Your session has expired');
        }*/
        $data = Input::all();
        date_default_timezone_set("Asia/Dacca");

        //print_r($data);exit;

        if(Auth::check()){
            Session::put('email', isset(Auth::user()->get()->id));
            Session::flash('message', "You Have Already Logged In.");
            return redirect()->route('dashboard');
        }else{
            $field = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user_data_exists = User::where($field, $data['email'])->exists();

            if($user_data_exists){

                $user_data = User::where($field, $data['email'])->first();
                $check_password = Hash::check($data['password'], $user_data->password);
                if($check_password){
                    #exit('ok');
                    if($user_data->last_visit!=NULL){
                        if($user_data->expire_date < date('Y-m-d h:i:s', time())){
                            DB::table('user')->where('id', '=', $user_data->id)->update(array('status' =>'inactive'));
                            Session::flash('message', "Login Activation Time Is Expired.You Can Contact With System-Admin To Reactivate Account.");
                        }elseif($user_data->status=='inactive'){
                            Session::flash('error', "Sorry!!Your Account Is Inactive.You Can Contact With System-Admin To Reactivate Account.");
                        }
                        else{
                            $attempt = Auth::attempt([
                                $field => $request->get('email'),
                                'password' => $request->get('password'),
                            ]);
                            if($attempt){
                                DB::table('user')->where('id', '=', $user_data->id)->update(array('last_visit' =>date('Y-m-d h:i:s', time())));
                                $user_model = new UserLoginHistory();

                                $user_history = [
                                    /*'action_name' => 'user-login',
                                    'action_url' => 'get-user-login',
                                    'action_details' => Auth::user()->username.' '. 'logged in',
                                    'action_table' => 'user',
                                    'date' => date('Y-m-d h:i:s', time()),
                                    'user_id' => Auth::user()->id,*/
                                    'user_id' => Auth::user()->id,
                                    'login_time' => date('Y-m-d h:i:s', time()),
                                    'ip_address' => getHostByName(getHostName()),
                                    'date' => date('Y-m-d h:i:s', time()),
                                ];
                                $user_model->create($user_history);
                                /*user-image in session........*/
                                if(!Session::has('user_image')){
                                    $image_exists = UserImage::where('user_id',Auth::user()->id)->exists();
                                    if($image_exists){
                                        $user_image = UserImage::where('user_id',Auth::user()->id)->first()->thumbnail;
                                        Session::put('user_image',$user_image);
                                    }
                                }

                                $role_name = Role::where('id', $user_data->role_id)->first();

                                #print_r($role_name->slug);exit;

                                Session::put('email', $user_data->email);
                                Session::put('user_id', $user_data->id);
                                Session::put('role_title', $role_name->slug);

                                #print_r(Auth::user()->email);exit;

                                Session::flash('message', "Successfully  Logged In.");

                                $this->menu_permission();

                                if($role_name->slug == 'user'){
                                    return redirect()->intended('dashboard/user');
                                }else{
                                    return redirect()->intended('dashboard');
                                }


                            }else{
                                Session::flash('danger', "Password Incorrect.Please Try Again");
                            }
                        }
                    }else{
                        Session::flash('info', "Your account is inactive.To activate your account you should reset your password.");
                        #return redirect()->to('welcome');
                        return redirect()->route('reset-password',['user_id'=>$user_data['id']]);
                    }
                }else{
                    #exit('no');
                    Session::flash('danger', "Password Incorrect.Please Try Again!!!");
                }
            }else{
                Session::flash('danger', "UserName/Email does not exists.Please Try Again");
            }
            return redirect()->back();
        }
    }

    protected function menu_permission()
    {
        if(Schema::hasTable('role_user') && Schema::hasTable('menu_panel')){
            if(!Session::has('sidebar_menu_user')) {
                // Get User ID
                $user_id = \Auth::user()->id;
                //print_r($user_id);exit;

                //get Role(s)
                $role_list = RoleUser::where('user_id','=',$user_id)
                    ->select('role_user.role_id')
                    ->get()->toArray();

                #print_r($role_list); exit;


                //routes per role(s)
                $permis_route = Permission::join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                    ->whereIn('permission_role.role_id', $role_list)
                    ->select('permissions.route_url')
                    ->get()->toArray();
                //module route
                $arr []=[
                    'route_url'=>'#'
                ];
                // Merge all routes per ROLE(S) and USER ID
                $per_routes = array_merge($permis_route, $arr);

                //print_r($per_routes); exit;

                //Get Menu Lists by PERMISSION (ROLE+USER+Permission)
                $tree = MenuPanel::select('id','menu_id','menu_type','menu_name','route','parent_menu_id','icon_code','menu_order','status')->whereIn('menu_panel.route',$per_routes)->orderBy('menu_order', 'ASC')->get()->toArray();
                //print_r($tree); exit;

                $parent = 0;

                $result = MenuItems::menu_tree($tree, $parent);
                //print_r($result); exit;

                // put the menu items in session
                Session::put('sidebar_menu_user', $result);
            }
        }
    }
}
