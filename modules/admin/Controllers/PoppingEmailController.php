<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:21 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Country;
use Modules\Admin\Imap;
use Modules\Admin\PoppingEmail;
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
    public function index()
    {
        $data['pageTitle'] = " Popping Email ";
        $data['country_id'] = Country::lists('title','id');
        $data['smtp_id'] = Smtp::lists('name','id');
        $data['imap_id'] = Imap::lists('name','id');
        $data['popping_emails']=PoppingEmail::with(['relSmtp','relimap'])->paginate(10);
        return view('admin::popping_email.index', $data);
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
            // Identify the status
            $status = SenderEmail::EmailTypeIdentification($input['email'], 'status');
            // do the validation
            if ($status == 'domain')
                $pre_text = 'mail.';
            else
                $pre_text = '';

            try {
                $hostname = '{' . $pre_text . $imap->host . ':993/imap/ssl/novalidate-cert}INBOX';
                $username = $input['email'];
                $password = $input['password'];
                $inbox = imap_open($hostname, $username, $password);

                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // store / update / code here
                    PoppingEmail::create($input);
                    if(Session::has('popping_input')) {
                        Session::forget('popping_input');
                    }

                    DB::commit();
                    Session::flash('flash_message', 'Successfully added!');
                } catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('flash_message_error', "Invalid Request");
                }
            } catch (\Exception $e) {
                Session::flash('flash_message_error', $e->getMessage());
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
            $data['token']=$client->getRefreshToken();
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
                'token'=>$client->getRefreshToken()
            ];

            $email_exists = PoppingEmail::where('email', $input_data['email'])->exists();
            if($email_exists){
                Session::flash('error', "This Email Name already exists." );
            }else{
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    $model = new PoppingEmail();
                    // store / update / code here
                    $model->create($data);

                    // clean session
                    Session::forget('popping_input');

                    DB::commit();
                    Session::flash('message', 'Successfully added!');

                }catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    Session::forget('popping_input');
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