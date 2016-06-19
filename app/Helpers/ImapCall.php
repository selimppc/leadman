<?php

/**
 * Created by PhpStorm.
 * User: selim
 * Date: 6/12/16
 * Time: 11:03 AM
 */

namespace App\Helpers;

class ImapCall
{

    public static function run($hostname, $username, $password){

        /* connect to gmail */
        $hostname = $hostname; //'{imap.gmail.com:993/imap/ssl}INBOX';
        $username = $username; //'yourusername@gmail.com';
        $password = $password; //'yourpassword';

        /* try to connect */
        #$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Email : ' . imap_last_error());
        $inbox = @imap_open($hostname,$username,$password);
        if(imap_errors()){
            print_r(imap_errors());
            return true;
        }

        /* grab emails */
        #$emails = imap_search($inbox,'ALL');
        $emails = imap_search($inbox,'UNSEEN');

        /* if emails are returned, cycle through each... */
        if($emails) {

            /* begin output var */
            $output = '';
            /* put the newest emails on top */
            rsort($emails);
            #print_r($emails);

            /* for every email... */
            $lead_email_data = [];
            foreach($emails as $email_number) {

                $headerInfo = imap_headerinfo($inbox,$email_number);
                $structure = imap_fetchstructure($inbox, $email_number);

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
                #$email_filter = ImapCall::check_keyword_exists_in_email_subject($user_email);
                #$subject_filter = ImapCall::check_keyword_exists_in_email_subject($subject);

                // if not exists in filter then continue
                #if($email_filter==0 && $subject_filter==0)
                #{
                    //TODO:: store to
                #}

                $lead_email_data []= [
                    'from_email'=>$user_email,
                    'to_email'=>$to_email,
                ];

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

        //return
        if($lead_email_data){
            return $lead_email_data;
        }else{
            return null;
        }

    }


    /**
     * @param $email
     * @return int
     */
    protected static function check_keyword_exists_in_email_subject($email){
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