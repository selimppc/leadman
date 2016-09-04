<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:21 PM
 */

namespace Modules\Admin\Controllers;

use App\Helpers\GenerateExecutionTime;
use App\Helpers\GenerateNumber;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
use Modules\Admin\Country;
use Modules\Admin\Imap;
use Modules\Admin\InvoiceHead;
use Modules\Admin\InvoiceDetail;
use Modules\Admin\Lead;
use Modules\Admin\PoppingEmail;
use Modules\Admin\Schedule;
use Modules\Admin\Smtp;
use Google_Service_Gmail;
use Google_Service_Gmail_ModifyMessageRequest;
use Google_Client;
use Google_Service_Books;
use Google_Auth_AssertionCredentials;
use Google_Service_Datastore;
use Google_Service_Urlshortener;
use Google_Service_Urlshortener_Url;


class PoppingEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data['pageTitle'] = " Popping Email ";
        $data['country_id'] = [''=>'Select Country'] + Country::lists('title','id')->all();
        $data['smtp_id'] = [''=>'Select Smtp'] + Smtp::lists('name','id')->all();
        $data['imap_id'] = [''=>'Select Imap'] + Imap::lists('name','id')->all();
        #$data['schedule_id'] = [''=>'Select Schedule'] + Schedule::lists(concat ('day','time'),'id')->all();
        $data['schedule_id'] = [''=>'Select Schedule'] + Schedule::select(
            DB::raw("CONCAT('Day ',day,',Time  ', time,'') AS full_name, id")
        )->lists('full_name', 'id')->all();


        if(isset($request->popmail_filter))
        {
            $data['popping_emails'] = $this->search($request->all());
        }else{
            if(Session::get('role_title') == 'user') {
                $data['popping_emails'] = PoppingEmail::with(['relSmtp' => function ($query) {
                    $query->addSelect('id', 'name');
                }, 'relimap' => function ($query) {
                    $query->addSelect('id', 'name');
                }, 'relCountry' => function ($query) {
                    $query->addSelect('id', 'title');
                }])->where('user_id',Auth::id())->where('status','!=','cancel')->paginate(10);
            }else{
                $data['popping_emails'] = PoppingEmail::with(['relSmtp' => function ($query) {
                    $query->addSelect('id', 'name');
                }, 'relimap' => function ($query) {
                    $query->addSelect('id', 'name');
                }, 'relCountry' => function ($query) {
                    $query->addSelect('id', 'title');
                }])->where('status','!=','cancel')->paginate(10);
            }
        }
//        dd($data);
        return view('admin::popping_email.index', $data);
    }
    private static function search($data)
    {
        $query= PoppingEmail::with(['relSmtp' => function ($query) {
            $query->addSelect('id', 'name');
        }, 'relImap' => function ($query) {
            $query->addSelect('id', 'name');
        }, 'relCountry' => function ($query) {
            $query->addSelect('id', 'title');
        }, 'relSchedule' => function ($query) {
            $query->addSelect('id', 'day', 'time');
        }]);
        // if only email
        if(!empty($data['popmail_filter'])){
            $query->where('email','like','%'.$data['popmail_filter'].'%');
        }
        // if only smtp
        if(!empty($data['smtp'])){
            $query->where('smtp_id',$data['smtp']);
        }
        // if only imap
        if(!empty($data['imap'])){
            $query->where('imap_id',$data['imap']);
        }
        // if only country
        if(!empty($data['country'])){
            $query->where('country_origin',$data['country']);
        }
        // if only status
        if(!empty($data['status'])){
            $query->where('status',$data['status']);
        }
        if(Session::get('role_title') == 'user') {
            $query->where('user_id',Auth::id());
        }
        $query->where('status','!=','cancel');
        $result=$query->paginate(10);
        return $result;
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
    public function auth_process(Request $request)
    {
        $input = $request->all();

        #print_r($input);exit;

        $smtp_h = Smtp::findOrNew($input['smtp_id']);
        $smtp_host = $smtp_h['host'];
        $email = $input['email'];
        Session::put('popping_input', $input);

        //if gmail then gmail validation using api-------------------------------
        if ($smtp_host == 'gmail.com' || $smtp_host == 'smtp.gmail.com') {
            define('SCOPES', implode(' ', array(
                    Google_Service_Gmail::MAIL_GOOGLE_COM,
                    Google_Service_Gmail::GMAIL_COMPOSE,
                    Google_Service_Gmail::GMAIL_READONLY,
                    Google_Service_Gmail::GMAIL_MODIFY,
                    "https://www.googleapis.com/auth/urlshortener"
                )
            ));
            $client = new Google_Client();
            $client->setAuthConfigFile(public_path().'/api/lead-man-api.json');
            $client->addScope(SCOPES);
            $client->setLoginHint($email);
            $client->setAccessType('offline');
            $client->setApprovalPrompt("force");
            $authUrl = $client->createAuthUrl();
            return redirect()->to($authUrl);
        } else {
            $imap = Imap::findOrNew($input['imap_id']);

            try {
                $hostname = '{' . $imap->host . ':993/imap/ssl/novalidate-cert}INBOX';
                $username = $input['email'];
                $password = $input['password'];
                $inbox = imap_open($hostname, $username, $password);

                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    $input['status'] = 'new';
                    // store / update / code here
                    PoppingEmail::create($input);
                    if(Session::has('popping_input')) {
                        Session::forget('popping_input');
                    }

                    DB::commit();
                    Session::flash('message', 'Successfully added!');
                } catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('error', "Invalid Request");
                }
            } catch (\Exception $e) {
                Session::flash('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }
    public function callback()
    {
        $client = new Google_Client();
        $client->setAuthConfigFile(public_path().'/api/lead-man-api.json');

        if (! isset($_GET['code']))
        {
            $auth_url = $client->createAuthUrl();
            return redirect()->to($auth_url);
        }
        else
        {
            $client->authenticate($_GET['code']);
            $data['code']=$_GET['code'];
            $data['token']=$client->getAccessToken();
            $input_data = Session::get('popping_input');
            $data = [
                'email'=>$input_data['email'],
                'password'=>$input_data['password'],
                'smtp_id'=>$input_data['smtp_id'],
                'imap_id'=>$input_data['imap_id'],
                'auth_email'=>$input_data['email'],
                'country_origin'=>$input_data['country_origin'],
                'auth_type'=>'google',
                'code'=>$_GET['code'],
                'token'=>$client->getAccessToken(),
                'user_id'=> Auth::user()->id,
                'status'=> 'new',
            ];

            $email_exists = PoppingEmail::where('email', $input_data['email'])->exists();
            if($email_exists){
                Session::flash('error', "This Email already exists." );
            }else{
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    $model = new PoppingEmail();
                    // store / update / code here
                    $model->create($data);

                    // clean session
                    //session()->forget('popping_input');

                    DB::commit();
                    Session::flash('message', 'Successfully added!');

                }catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    //Session::forget('popping_input');
                    DB::rollback();
                    Session::flash('error', "Invalid Request" );
                    //return redirect()->route('popping_email.index');
                }
                #$request->session()->forget('popping_input');
            }
            return redirect()->to('admin/popping-email');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Show the detail';
        $data['popping_email'] = PoppingEmail::with(['relUser'=>function($query){
            $query->addSelect('id','username');
        },'relSmtp'=>function($query){
            $query->addSelect('id','name');
        },'relimap'=>function($query){
            $query->addSelect('id','name');
        },'relCountry'=>function($query){
            $query->addSelect('id','title');
        }])->findOrFail($id);
        return view('admin::popping_email.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Show the detail';
        $data['country_id'] = [''=>'Select Country'] + Country::lists('title','id')->all();
        $data['smtp_id'] = [''=>'Select Smtp'] + Smtp::lists('name','id')->all();
        $data['imap_id'] = [''=>'Select Imap'] + Imap::lists('name','id')->all();
        /*$data['schedule_id'] = [''=>'Select Schedule'] + Schedule::lists('day','id')->all();*/

        $data['schedule_id'] = [''=>'Select Schedule'] + Schedule::select(
            DB::raw("CONCAT('Day ',day,',Time  ', time,'') AS full_name, id")
        )->lists('full_name', 'id')->all();


        $data['popping_email'] = PoppingEmail::with('relSmtp','relImap','relCountry')->findOrFail($id);
        return view('admin::popping_email.update', $data);
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
        $model = PoppingEmail::findOrFail($id);
        $input = $request->all();

        $popping_email_id = $input['popping_email_id'];
        $schedule_id = $input['schedule_id'];




        $role = Session::get('role_title');
        if($role == 'admin' || $role == 'super-admin')
        {
            if($input['schedule_id'] != null && $input['schedule_id'] != null )
            {
                //generate execution time and change the status active for the popping_email
                $execution_time = GenerateExecutionTime::run($popping_email_id, $schedule_id);

                if($execution_time){
                    $input['execution_time']=$execution_time;
                    $input['status']='active';
                }
            }
            else
            {
                Session::flash('message', 'Please add/update Schedule/Time and Price ! ');
                return redirect()->back();
            }
        }

        // Transaction Start Here
        DB::beginTransaction();
        try {
            if(empty($input['password']))
            {
                unset($input['password']);
            }
            $model->update($input);
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('error', "Invalid Request" );
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $invoices = InvoiceHead::select('id')->where('popping_email_id',$id)->get();
            foreach ($invoices as $invoice) {
                InvoiceDetail::where('invoice_head_id',$invoice->id)->delete();
            }
            InvoiceHead::Where('popping_email_id',$id)->delete();

            Lead::Where('popping_email_id',$id)->delete();
            PoppingEmail::findOrFail($id)->delete();
            DB::commit();
            Session::flash('message', 'Popping Email has been successfully deleted. ');
        }catch (Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());
        }
        return redirect()->back();
    }


    /**
     * @param $popping_email_id
     */
    public function active_inactive($popping_email_id)
    {

        if($popping_email_id)
        {
            $popping_email_data = PoppingEmail::findOrFail($popping_email_id);
            $status = $popping_email_data->status;

            if($status=='new')
            {
                /*$role = Session::get('role_title');
                if($role == 'admin' || $role == 'super-admin'){
                    $popping_email_data->status='active';
                    $popping_email_data->save();
                }else{
                    Session::flash('message', 'Contact with Administrator for this Action ! ');
                    return redirect()->back();
                }*/

                Session::flash('message', 'Please Add Schedule/Time and Price ! ');
                return redirect()->back();

            }
            elseif($status=='active')
            {
                $popping_email_data->status='inactive';
                $popping_email_data->save();
            }
            elseif($status=='inactive')
            {

                if($popping_email_data->price != null)
                {
                    if($popping_email_data->schedule_id != null)
                    {
                        $popping_email_data->status='active';
                        $popping_email_data->save();
                    }
                    else
                    {
                        Session::flash('message', 'Please add/update Schedule/Time! ');
                        return redirect()->back();
                    }
                }
                else
                {
                    Session::flash('message', 'Please add/update Price ! ');
                    return redirect()->back();
                }

            }

            Session::flash('message', 'Successfully Changed the status ! ');
            return redirect()->back();

        }else{
            Session::flash('message', 'Popping Email is missing ! ');
            return redirect()->back();
        }

    }


    /**
     * Create Invoice According to popping_email_id
     *
     */
    public function create_invoice_by_pop_email_id($popping_email_id)
    {
        $data['pageTitle'] = 'Create Invoice by Popping Email';

        /// create invoice and add comment
        $data['pop_email'] = PoppingEmail::findOrFail($popping_email_id);
        return view('admin::popping_email.create_invoice', $data );

    }

    public function proceed_create_invoice(Request $request)
    {
        //Input Data
        $input_data = $request->all();
        $popping_email_id = $input_data['popping_email_id'];
        $comments = $input_data['comments'];


        $data = PoppingEmail::with(['relLead' => function ($query) {
            $query->where('lead.status', 'open');
        }])
            ->where('id', '=', $popping_email_id)
            ->where('popping_email.status', '=', 'active')
            ->get();

        #print_r($data);exit();

        if (count($data) > 0) {
            foreach ($data as $pop_email) {
                if (count($pop_email->relLead) > 0) {
                    //convert object to an array
                    $lead_array = $pop_email->relLead->toArray();

                    // visualize data for storing
                    $popping_email_id = $pop_email->id;
                    $popping_keyword  = $pop_email->keyword?$pop_email->keyword:null;
                    $user_id          = $pop_email->user_id;
                    $price            = $pop_email->price;
                    $lead_count       = count($pop_email->relLead);
                    $total_cost       = $price*$lead_count;
                    $invoice_number   = GenerateNumber::run();

                    $array_data = [
                        'popping_email_id' => $popping_email_id,
                        'user_id'          => $user_id,
                        'invoice_number'   => $invoice_number['generated_number'],
                        'total_cost'       => $total_cost,
                        'comments'       => isset($comments)?$comments:null,
                        'status'           => "open",
                    ];

                    /* Transaction Start Here */
                    DB::beginTransaction();
                    try {

                        //model for invoice head
                        $model = new InvoiceHead();
                        if ($hd_inv = $model->create($array_data))
                        {
                            foreach ($pop_email->relLead as $lead)
                            {
                                $array_dt = [
                                    'invoice_head_id' => $hd_inv->id,
                                    'lead_id'         => $lead->id,
                                    'unit_price'      => $price,
                                    'inv_date'		  => date('Y-m-d')
                                ];

                                //store into invoice detail and updated status of lead
                                $model_dt = new InvoiceDetail();

                                if ($model_dt->create($array_dt)) {
                                    $lead_model         = Lead::findOrFail($lead->id);
                                    $lead_model->status = 'invoiced';
                                    $lead_model->save();
                                }
                            }

                            // success report
                            Session::flash('message', 'Invoice Stored Successfully ! '.$invoice_number['generated_number']);

                            //Keep lead data into txt file as per invoice and delete them all
                            $result = $this->lead_to_txt($invoice_number['generated_number'], $lead_array, $popping_keyword);

                            if ($result) {
                                Session::flash('message', ' Store new text file with lead data!'.$invoice_number['generated_number'].".txt");
                            }

                        }

                        //Generate Execution Time and Update in Popping_email Table
                        $generate_execution_time = GenerateExecutionTime::run($pop_email->id, $pop_email->schedule_id);
                        $model                   = PoppingEmail::findOrFail($pop_email->id);
                        $model->execution_time   = $generate_execution_time;
                        $model->save();

                        //Commit the changes
                        DB::commit();
                    } catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                        DB::rollback();
                        Session::flash('danger', $e->getMessage());
                    }
                } else {
                    Session::flash('danger', 'No data found from Lead to create Invoice !');
                }
            }
        } else {
            Session::flash('danger', 'No data found from Lead to create Invoice !');
        }

        return redirect()->back();
    }

    /**
     * @param $invoice_no
     * @param $array_data
     * @return bool
     */
    private function lead_to_txt($invoice_no, $array_data, $popping_keyword)
    {

        $invoice_no = $invoice_no;
        //file Path
        $path = public_path()."/lead_files/";
        $date = date('Y-m-d');

        //check permission from config
        $permissions = intval(config('permissions.directory'), 0);

        if (!File::Exists($path)) {
            //make folder with $path generate recursive with right 0775
           File::makeDirectory($path, $permissions, true);
        }

        //make data in string to store in txt file
        $string = '';
        foreach ($array_data as $val) {
            #$string .= $val['id']."-".$val['email']."\n";
            $string .= $val['email']."\n";
        }


        //make data in string to store in txt file
        $string_with_keyword = '';
        $string_without_keyword = '';
        foreach ($array_data as $val)
        {
            if($val['type'] == "keyword")
            {
                $string_with_keyword .= $val['email']."\n";
            }
            else
            {
                $string_without_keyword .= $val['email']."\n";
            }
        }

        //create array of lead id
        $lead_ids = array();
        foreach ($array_data as $value) {
            $lead_ids[] = array(
                'id' => $value['id'],
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //with Keyword
            $file_name = $path.$date."-".$invoice_no."-with-keyword-".$popping_keyword.".txt";
            $handle    = fopen($file_name, 'w');
            $a         = fwrite($handle, $string_with_keyword);
            fclose($handle);

            //without Keyword
            $file_name_key = $path.$date."-".$invoice_no."-without-keyword.txt";
            $handle_key    = fopen($file_name_key, 'w');
            $a         = fwrite($handle_key, $string_without_keyword);
            fclose($handle_key);

            /* data delete from Lead table by Lead_ID */
            #DB::table('lead')->whereIn('id', $lead_ids)->delete();

            //Commit the changes
            DB::commit();

            return true;

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());

            return false;
        }
    }




}