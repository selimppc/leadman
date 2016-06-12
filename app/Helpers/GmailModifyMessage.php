<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 6/12/16
 * Time: 11:12 AM
 */

namespace App\Helpers;


class GmailModifyMessage
{

    /**
     * @param $gmail_service :: gmail Service
     * @param $message_data_obj :: message data object
     * @return string
     */

    public static function modify($gmail_service, $message_id){
        $labelsToAdd =  ["UNREAD"];
        $labelsToRemove = ["INBOX"];
        $mods = new \Google_Service_Gmail_ModifyMessageRequest();
        $mods->setAddLabelIds($labelsToAdd);
        $mods->setRemoveLabelIds($labelsToRemove);
        try {
            $message = $gmail_service->users_messages->modify("me", $message_id, $mods);
            return $message;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}