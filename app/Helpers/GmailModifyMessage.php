<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 6/12/16
 * Time: 11:12 AM
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

class GmailModifyMessage
{

    /**
     * @param $gmail_service :: gmail Service
     * @param $message_data_obj :: message data object
     * @return string
     */

    public static function modify($gmail_service, $message_id)
    {

        $labelsToAdd =  null; // ["UNREAD"];
        $labelsToRemove = ["UNREAD"];

        $mods = new \Google_Service_Gmail_ModifyMessageRequest();

        $mods->setAddLabelIds($labelsToAdd);
        $mods->setRemoveLabelIds($labelsToRemove);

        try
        {
            $message = $gmail_service->users_messages->modify("me", $message_id, $mods);
            print 'Message with ID: ' . $message_id . ' successfully modified.';

            return $message;

        }
        catch (Exception $e)
        {
            print 'An error occurred: ' . $e->getMessage();
            
            return $e->getMessage();

        }
    }

}