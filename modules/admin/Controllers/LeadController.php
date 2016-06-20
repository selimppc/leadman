<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:22 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Lead;
use Modules\Admin\PoppingEmail;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input)
    {
        $per_page=10;
        $data['pageTitle'] = " Lead ";
        if(isset($input->email)){
            $per_page=10;
            if(!empty($input['email']) && $input['status'] =='select')
            {
                $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
                if(!empty($email)){
                    $result= Lead::where('popping_email_id',$email->id)->with('relPoppingEmail')->paginate($per_page);
                }
            }elseif(empty($input['email']) && $input['status'] !='select')
            {
                $result= Lead::where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
            }elseif(!empty($input['email']) && $input['status'] !='select')
            {
                $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
                if(!empty($email)){
                    $result= Lead::where('popping_email_id',$email->id)->where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
                }
            }else{
                $result= Lead::with('relPoppingEmail')->paginate($per_page);
            }
            $data['leads']=$result;
        }else{
            $data['leads']= Lead::with('relPoppingEmail')->paginate($per_page);
        }
        return view('admin::lead.index', $data);
    }
    public function leadByUser(Request $input,$id)
    {
        $access=true;
        if(Session::get('role_title') == 'user')
        {
            $poppingEmail= PoppingEmail::findOrFail($id);
            if(isset($poppingEmail->user_id) && $poppingEmail->user_id==Auth::id())
            {
                $access=true;
            }else{
                $access=false;
            }
        }
        if($access)
        {
            $per_page=10;
            $data['pageTitle'] = " Lead ";
            if(isset($input->email)){
                $per_page=10;
                if(!empty($input['email']) && $input['status'] =='select')
                {
                    $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
                    if(!empty($email)){
                        $result= Lead::where('popping_email_id',$email->id)->with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);
                    }else{
                        $result= Lead::with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);

                    }
                }elseif(empty($input['email']) && $input['status'] !='select')
                {
                    $result= Lead::where('status',$input['status'])->with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);
                }elseif(!empty($input['email']) && $input['status'] !='select')
                {
                    $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
                    if(!empty($email)){
                        $result= Lead::where('popping_email_id',$email->id)->where('status',$input['status'])->with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);
                    }else{
                        $result= Lead::with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);

                    }
                }else{
                    $result= Lead::with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);
                }
                $data['leads']=$result;
            }else{
                $data['leads']= Lead::with('relPoppingEmail')->where('popping_email_id',$id)->paginate($per_page);
            }
            $data['popping_email_id']=2;
            return view('admin::lead.index', $data);
        }else{
            Session::flash('error','Sorry,you don\'t have permission.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}