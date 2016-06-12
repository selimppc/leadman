<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Service_Gmail;
use Google_Service_Gmail_ModifyMessageRequest;
use Google_Client;
use Google_Service_Books;
use Google_Auth_AssertionCredentials;
use Google_Service_Datastore;
use Google_Service_Urlshortener;
use Google_Service_Urlshortener_Url;


class EmailFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leadman:email-fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feth/Crawl Email from a GMAIL or other emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $campaign = Campaign::with('relPoppingEmail.relImap')->where('status', 'active')->get() ;
        $sender_email = SenderEmail::with('relImap')->where('popping_status', 'true')
            ->where('status','=', 'domain')->get();

        if(isset($campaign)){

            foreach($campaign as $camp){

                $pop_email = $camp->relPoppingEmail;
                $imap = $pop_email->relImap;

                #for($i=0; $i < count($camp); $i++){
                if($imap->host =='imap.gmail.com')
                {
                    // call GoogleClientCall.php
                    
                }else{
                    $hostname = '{'.$imap->host.':993/imap/ssl/novalidate-cert}INBOX';
                    $username = $pop_email->email;
                    $password = $pop_email->password;

                    // imap open
                    $inbox = @imap_open($hostname,$username,$password);
                    if(imap_errors()){
                        print_r(imap_errors());
                        return true;
                    }
                    /* grab emails */
                    $emails = imap_search($inbox,'UNSEEN');
                    /* if email_template are returned, cycle through each... */
                    if($emails) {

                        /* begin output var */
                        $output = '';
                        /* put the newest email_template on top */
                        rsort($emails);
                        /* for every email... */
                        foreach($emails as $email_number) {

                            /* get information specific to this email */
                            $overview = imap_fetch_overview($inbox,$email_number,0);
                            #$message =imap_fetchbody($inbox,$email_number,"2");//fetch body message
                            $message = imap_fetchbody($inbox,$email_number,1.1);
                            if($message == '')
                            {
                                $message = imap_fetchbody($inbox,$email_number,1.2);

                            }
                            if($message == ''){
                                $message = imap_base64(imap_fetchbody($inbox,$email_number,2));
                            }
                            if($message == ''){
                                $message = imap_body($inbox,$email_number);
                            }

                            $from_email = $overview[0]->from;
                            $to_in_email = $overview[0]->to;

                            // make from email in better shape
                            if(strpos($from_email, '<') !== false) {
                                $split = explode('<', $overview[0]->from);
                                $from_email_name = $split[0];
                                $email = rtrim($split[1], '>');
                                $user_email = preg_replace('/<>*?/', '', $email); // final email
                            } else {
                                $user_email = $from_email;
                                $from_email_name = $from_email;
                            }

                            // make to email in better shape
                            if(strpos($to_in_email, '<') !== false) {
                                $split = explode('<', $to_in_email);
                                $to_email_name = $split[0];
                                $email = rtrim($split[1], '>');
                                $to_email = preg_replace('/<>*?/', '', $email); // final email
                            } else {
                                $to_email = $to_in_email;
                                $to_email_name = $to_in_email;
                            }

                            $subject = isset($overview[0]->subject)?($overview[0]->subject):''; // user subject
                            /** Filter Email and Subject :: eg-> ignore if no-reply **/
                            $email_filter = $this->check_keyword_exists_in_email_subject($user_email);
                            $subject_filter = $this->check_keyword_exists_in_email_subject($subject);

                            // if not exists in filter then continue
                            if($email_filter==0 && $subject_filter==0)
                            {
                                /* Check campaign and user_email exists or not */
                                $exists_email = PoppedMessageHeader::where('campaign_id', $camp->id)->where('user_email', $user_email)->exists();
                                if($exists_email)
                                {
                                    /* Store all Emails into database */
                                    $popped_msg_hd = PoppedMessageHeader::where('campaign_id', $camp->id)->where('user_email', $user_email)->first();
                                    $popped_msg_hd_msg_order = $popped_msg_hd->message_order;
                                    // Message Order
                                    $msg_order = Message::where('campaign_id', $camp->id)->max('order');
                                    //->orderBy('order', 'desc')->first();
                                    $msg_order_no =$msg_order; //$msg_order->order;

                                    // Central Settings :: resume or stop
                                    #$resume_stop = CentralSettings::where('title','=', 'resume-or-stop-if-msg-order-no-exceed')->first();
                                    #$resume_stop_status = $resume_stop->status;
                                    if($popped_msg_hd_msg_order > $msg_order_no )
                                    {
                                        /*if($resume_stop_status=='resume'){
                                            $model->message_order = 1;
                                        }elseif($resume_stop_status=='stop'){
                                            $model->message_order = 0;
                                        }*/
                                        $msg_hd_status = 'msg-ord-exceeded';
                                    }else{
                                        $msg_hd_status = 'not-queued';
                                    }

                                    $model = PoppedMessageHeader::findOrNew($popped_msg_hd->id);
                                    $model->message_order = $popped_msg_hd->message_order + 1;
                                    $model->status = $msg_hd_status;

                                    // check to email and set as sender email
                                    $to_email_check = SenderEmail::where('email', $to_email)->exists();
                                    if($to_email_check){
                                        $sender_email_stat = SenderEmail::where('email', $to_email)->first();
                                        if($sender_email_stat->status == "public"){
                                            $sender_email_id = null;
                                        }else{
                                            $sender_email_id = $sender_email_stat->id;
                                        }
                                    }else{
                                        $sender_email_id = null;
                                    }
                                    $model->sender_email_id = $sender_email_id;
                                    //save model
                                    if($model->save())
                                    {
                                        $model_dt = new PoppedMessageDetail();
                                        $model_dt->popped_message_header_id = $model->id;
                                        $model_dt->sender_email = $to_email;
                                        $model_dt->d_status = 'mail-read';
                                        $model_dt->user_message_body = $message;
                                        $model_dt->sender_email = SenderEmail::findOrNew($sender_email_id) ? SenderEmail::findOrNew($sender_email_id)->email : null;
                                        $model_dt->save();
                                    }
                                }
                                else
                                {
                                    /* Set sender email :: $host =$imap->host  , $camp_id= $camp->id */
                                    $se = $this->get_sender_email($imap->host, $camp->id);
                                    if($se) {
                                        /* Store all Emails into database */
                                        $model = new PoppedMessageHeader();
                                        $model->campaign_id = $camp->id;
                                        $model->user_email = $user_email;
                                        //$model->user_name = $pop_email->name;
                                        $model->user_name = $from_email_name;
                                        $model->subject = isset($overview[0]->subject) ? ($overview[0]->subject) : '';
                                        $model->status = 'not-queued';
                                        $model->message_order = 1;
                                        $model->followup_message_order = 1;
                                        $model->sender_email_id = $se->id;
                                        //save
                                        if ($model->save()) {
                                            $model_dt = new PoppedMessageDetail();
                                            $model_dt->popped_message_header_id = $model->id;
                                            $model_dt->sender_email = $to_email;
                                            $model_dt->d_status = 'mail-read';
                                            $model_dt->user_message_body = $message;
                                            $model_dt->sender_email = $se->email;
                                            $model_dt->save();
                                        }
                                    }
                                    else{
                                        echo "No Sender email in Active Campaign !";
                                    }
                                }
                            }
                        }
                        // for every email...
                        foreach($emails as $email_number)
                        {
                            // TESTING BOTH METHODS
                            imap_delete($inbox,$email_number);
                            $result = "success";
                        }

                        /*delete all messages you marked for removal*/
                        imap_expunge($inbox);
                        /* close the connection */
                        imap_close($inbox);
                        echo 'Fetched Successfully !';
                    }
                }
                #}
            }
        }
        /*Sender Email */
        if((count($sender_email)>0)){

            foreach($sender_email as $values){
                $se = $values;
                $imap = $values->relImap;
                for($i=0; $i < count($values); $i++){
                    if($imap->host =='gmail.com' || $imap->host =='imap.gmail.com'){
                        $hostname = '{imap.googlemail.com:993/imap/ssl/novalidate-cert}INBOX';
                        $username = $values->email;
                        $password = $values->password;
                    }else{
                        $hostname = '{'.$imap->host.':993/imap/ssl/novalidate-cert}INBOX';
                        $username = $values->email;
                        $password = $values->password;
                    }

                    $inbox = @imap_open($hostname,$username,$password);
                    if(imap_errors()){
                        print_r(imap_errors());
                        return true;
                    }

                    /* grab email_template */
                    $emails = imap_search($inbox,'UNSEEN');
                    /* if email_template are returned, cycle through each... */
                    if($emails) {

                        /* begin output var */
                        $output = '';
                        /* put the newest email_template on top */
                        rsort($emails);
                        /* for every email... */
                        foreach($emails as $email_number) {
                            /* get information specific to this email */
                            $overview = imap_fetch_overview($inbox,$email_number,0);
                            #$message = imap_fetchbody($inbox,$email_number,2);
                            $message = imap_fetchbody($inbox,$email_number,1.1);
                            if($message == '')
                            {
                                $message = imap_fetchbody($inbox,$email_number,1.2);

                            }
                            if($message == ''){
                                $message = imap_base64(imap_fetchbody($inbox,$email_number,2));
                            }
                            if($message == ''){
                                $message = imap_body($inbox,$email_number);
                            }
                            //remove header information from message body
                            if (strpos($message, 'quoted-printable') !== false) {
                                $split = explode('quoted-printable', $message);
                                $message = rtrim($split[1]);
                            }
                            // In case missed the header information then
                            if (strpos($message, 'charset=UTF-8') !== false) {
                                $split = explode('charset=UTF-8', $message);
                                $message = rtrim($split[1]);
                            }




                            $from_email = $overview[0]->from;
                            $to_in_email = $overview[0]->to;

                            if(strpos($from_email, '<') !== false) {
                                $split = explode('<', $overview[0]->from);
                                $from_email_name = $split[0];
                                $email = rtrim($split[1], '>');
                                $user_email = preg_replace('/<>*?/', '', $email); // final email
                            } else {
                                $user_email = $from_email;
                                $from_email_name = $from_email;
                            }

                            // make to email in better shape
                            if(strpos($to_in_email, '<') !== false) {
                                $split = explode('<', $to_in_email);
                                $to_email_name = $split[0];
                                $email = rtrim($split[1], '>');
                                $to_email = preg_replace('/<>*?/', '', $email); // final email
                            } else {
                                $to_email = $to_in_email;
                                $to_email_name = $to_in_email;
                            }

                            $subject = isset($overview[0]->subject)?($overview[0]->subject):'';// user subject

                            /** Filter Email and Subject :: eg-> ignore if no-reply **/
                            $email_filter = $this->check_keyword_exists_in_email_subject($user_email);
                            $subject_filter = $this->check_keyword_exists_in_email_subject($subject);

                            // if not exists in filter then continue
                            if($email_filter==0 && $subject_filter==0){
                                /* Check campaign and user_email exists or not */
                                $exists_email = PoppedMessageHeader::where('campaign_id', $values->campaign_id)->where('user_email', $user_email)->exists();
                                if($exists_email){
                                    echo "Exists GMAIL Sender";
                                    /* Store all Emails into database */
                                    $popped_msg_hd = PoppedMessageHeader::where('campaign_id', $values->campaign_id)->where('user_email', $user_email)->first();
                                    $popped_msg_hd_msg_order = $popped_msg_hd->message_order;
                                    // Message Order
                                    $msg_order = Message::where('campaign_id', $values->campaign_id)->max('order');
                                    //->orderBy('order', 'desc')->first();
                                    $msg_order_no =$msg_order; //$msg_order->order;
                                    // Central Settings :: resume or stop
                                    #$resume_stop = CentralSettings::where('title','=', 'resume-or-stop-if-msg-order-no-exceed')->first();
                                    #$resume_stop_status = $resume_stop->status;

                                    if($popped_msg_hd_msg_order > $msg_order_no ){
                                        /*if($resume_stop_status=='resume'){
                                            $model->message_order = 1;
                                        }elseif($resume_stop_status=='stop'){
                                            $model->message_order = 0;
                                        }*/
                                        $msg_hd_status = 'msg-ord-exceeded';
                                    }else{
                                        $msg_hd_status = 'not-queued';
                                    }
                                    $model = PoppedMessageHeader::findOrNew($popped_msg_hd->id);
                                    $model->message_order = $popped_msg_hd->message_order + 1;
                                    $model->status = $msg_hd_status;

                                    // check to email and set as sender email
                                    $to_email_check = SenderEmail::where('email', $to_email)->exists();
                                    if($to_email_check){
                                        $sender_email_stat = SenderEmail::where('email', $to_email)->first();
                                        if($sender_email_stat->status == "public"){
                                            $sender_email_id = null;
                                        }else{
                                            $sender_email_id = $sender_email_stat->id;
                                        }
                                    }else{
                                        $sender_email_id = null;
                                    }
                                    $model->sender_email_id = $sender_email_id;
                                    $model->status = 'not-queued';
                                    // Save
                                    if($model->save()){
                                        $model_dt = new PoppedMessageDetail();
                                        $model_dt->popped_message_header_id = $model->id;
                                        $model_dt->sender_email = $to_email;
                                        $model_dt->d_status = 'mail-read';
                                        $model_dt->user_message_body = $message;
                                        $model_dt->sender_email = SenderEmail::findOrNew($sender_email_id)? SenderEmail::findOrNew($sender_email_id)->email : null;
                                        $model_dt->save();
                                    }
                                }else{

                                    /* Set sender email */
                                    $se = $this->get_sender_email($imap->host, $values->campaign_id); // $host =$imap->host  , $camp_id= $camp->id
                                    /* Store all Emails into database */
                                    $model = new PoppedMessageHeader();
                                    $model->campaign_id = $values->campaign_id;
                                    $model->user_email =  $user_email;
                                    $model->user_name = $values->name;
                                    $model->subject = isset($overview[0]->subject)?($overview[0]->subject):'';
                                    $model->status = 'not-queued';
                                    $model->message_order = 1;
                                    $model->sender_email_id = $se->id;

                                    //Save
                                    if($model->save()){
                                        $model_dt = new PoppedMessageDetail();
                                        $model_dt->popped_message_header_id = $model->id;
                                        $model_dt->sender_email = $to_email;
                                        $model_dt->d_status = 'mail-read';
                                        $model_dt->user_message_body = $message;
                                        $model_dt->sender_email = $se->email;
                                        $model_dt->save();
                                    }
                                }
                            }
                        }
                        // for every email...
                        foreach($emails as $email_number)
                        {
                            // TESTING BOTH METHODS
                            imap_delete($inbox,$email_number);
                            $result = "success";
                        }
                        /*delete all messages you marked for removal*/
                        imap_expunge($inbox);
                        /* close the connection */
                        imap_close($inbox);
                        echo 'Fetched Successfully !';
                    }
                }
            }
        }
        return true;
    }


    protected function check_keyword_exists_in_email_subject($email){
        $filter_list= DB::table('filter')->select('name')->get();

        foreach($filter_list as $filter){
            $list[] = ['name' => $filter->name,];
        }

        $match = 0;
        if(isset($list)) {
            foreach ($list as $word) {
                // This pattern takes care of word boundaries, and is case insensitive

                $name = $word['name'];

                $pattern = "/\b$name\b/i";
                $match += preg_match($pattern, $email);
            }
        }

        return $match;
    }











}
