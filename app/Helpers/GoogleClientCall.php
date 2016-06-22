<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 6/12/16
 * Time: 11:16 AM
 */

namespace App\Helpers;

use Google_Service_Gmail;
use Google_Service_Gmail_ModifyMessageRequest;
use Google_Client;
use Google_Service_Books;
use Google_Auth_AssertionCredentials;
use Google_Service_Datastore;
use Google_Service_Urlshortener;
use Google_Service_Urlshortener_Url;

class GoogleClientCall
{

    /**
     * @param $pop_email
     */
    public static function run($pop_email, $token){

        #session_start();
        /*define('SCOPES', implode(' ', array(
                Google_Service_Gmail::MAIL_GOOGLE_COM,
                Google_Service_Gmail::GMAIL_COMPOSE,
                Google_Service_Gmail::GMAIL_READONLY,
                Google_Service_Gmail::GMAIL_MODIFY,
                "https://www.googleapis.com/auth/urlshortener"
            )
        ));*/

        //client
        $client = new Google_Client();
        $client->setAuthConfigFile(public_path().'/api/lead-man-api.json');
        #$client->addScope(SCOPES);
        $client->setLoginHint($pop_email);
        $client->setAccessType('offline');
        $client->setApprovalPrompt("force");
        $json_token = $token;

        if ($json_token) {
            $client->setAccessToken($json_token);
            // If access token is not valid use refresh token
            if ($client->isAccessTokenExpired()) {
                $refresh_token = $client->getRefreshToken();
                $client->refreshToken($refresh_token);
                // TODO :: we got refresh token : we need to save to db for life time
            }

            // Gmail Service
            $gmail_service = new \Google_Service_Gmail($client);
            // Get List of messages
            $message_data = GmailListMessages::lists($gmail_service, $pop_email);

            $lead_email_data = [];
            if ($message_data) {
                foreach ($message_data as $msg) {

                    // sender email
                    if (strpos($msg['messageSender'], '<') !== false) {
                        $split = explode('<', $msg['messageSender']);
                        $from_email_name = $split[0];
                        $email = rtrim($split[1], '>');
                        $user_email = preg_replace('/<>*?/', '', $email); // final email
                    } else {
                        $user_email = $msg['messageSender'];
                        $from_email_name = $msg['messageSender'];
                    }

                    // to email   :: $to_email=> user send email here
                    if (strpos($msg['messageTo'], '<') !== false) {
                        $split = explode('<', $msg['messageTo']);
                        $name = $split[0];
                        $email = rtrim($split[1], '>');
                        $to_email = preg_replace('/<>*?/', '', $email); // final email
                    } else {
                        $to_email = $msg['messageTo'];
                    }

                    //
                    $lead_email_data []= [
                        'from_email'=>$user_email,
                        'to_email'=>$to_email,
                    ];
                }
            }
            return $lead_email_data;
        }else{
            return null;
        }

    }


}