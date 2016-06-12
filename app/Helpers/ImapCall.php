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
        $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Email : ' . imap_last_error());

        /* grab emails */
        $emails = imap_search($inbox,'ALL');

        /* if emails are returned, cycle through each... */
        if($emails) {

            /* begin output var */
            $output = '';
            /* put the newest emails on top */
            rsort($emails);
            print_r($emails);

            /* for every email... */
            foreach($emails as $email_number) {

                $headerInfo = imap_headerinfo($inbox,$email_number);
                $structure = imap_fetchstructure($inbox, $email_number);

                /* get information specific to this email */
                $overview = imap_fetch_overview($inbox,$email_number,0);
                $message = imap_fetchbody($inbox,$email_number,2);

                /* output the email header information */
                $output.= ' seen ? "read" : "unread" ';
                $output.= ''.$overview[0]->subject.' ';
                $output.= ''.$overview[0]->from.'';
                $output.= 'on '.$overview[0]->date.'';
                $output.= '';
                /* output the email body */
                $output.= ''.$message.'';
            }
            echo $output;
        }
        /* close the connection */
        imap_close($inbox);
    }




}