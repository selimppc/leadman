<?php

namespace App\Console\Commands;

use App\Helpers\GoogleClientCall;
use App\Helpers\ImapCall;
use Illuminate\Console\Command;
use Google_Service_Gmail;
use Google_Service_Gmail_ModifyMessageRequest;
use Google_Client;
use Google_Service_Books;
use Google_Auth_AssertionCredentials;
use Google_Service_Datastore;
use Google_Service_Urlshortener;
use Google_Service_Urlshortener_Url;
use Modules\Admin\CentralSettings;
use Modules\Admin\Lead;
use Modules\Admin\PoppingEmail;
use Illuminate\Support\Facades\DB;


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
    protected $description = 'Fetch/Crawl Email from a GMAIL or other emails';

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


        //Popping Email List
        $popping_email = PoppingEmail::with('relSmtp', 'relImap')->where('status', 'active')->get();

        while(true)
        {
            try
            {
                foreach ($popping_email as $pop_email)
                {
                    $imap = $pop_email->relImap;
                    if($imap->host =='imap.gmail.com')
                    {
                        //TODO:: call GoogleClientCall
                        $result = GoogleClientCall::run($pop_email->email, $pop_email->token);
                    }
                    else
                    {
                        $hostname = $pop_email->relImap->host;
                        $username = $pop_email->relImap->server_username;
                        $password = $pop_email->relImap->server_password;

                        //TODO:: call ImapCall
                        $result = ImapCall::run($hostname, $username, $password);

                    }
                    if($result){
                        // loop
                        foreach($result as $val){

                            //from Email
                            $from_email = $val['from_email'];
                            $subject = $val['subject'];

                            // check constraint from Central Settings Table
                            $check_settings = CentralSettings::where('title', 'email-subject-check')->first();
                            $check_settings_value = $check_settings->status;
                            
                            //Check email exists
                            if($check_settings_value == 'yes')
                            {
                                $check_lead = Lead::where('email', $val['from_email'])->where('subject', $val['subject'])->where('popping_email_id', $pop_email->id)->exists();
                            }else{
                                $check_lead = Lead::where('email', $val['from_email'])->where('popping_email_id', $pop_email->id)->exists();
                            }


                            if($pop_email->keyword){
                                if(strpos($val['from_email'], $pop_email->keyword) !== false){
                                    if(!$check_lead){
                                        $model = new Lead();
                                        try{
                                            $model->email = $from_email;
                                            $model->subject = $subject;

                                            $model->popping_email_id = $pop_email->id;
                                            $model->status = 'open';
                                            $model->count = 1;
                                            $model->save();
                                            $this->info('Stored Lead : '.$model->email);
                                        }catch(\Exception $e){
                                            $this->info('Failed : '.$e->getMessage());
                                        }
                                    }else{
                                        $model = Lead::where('email', $from_email)->first();
                                        try{
                                            $model->count = $model->count + 1;
                                            $model->save();
                                            $this->info('Updated Count for the Lead : '.$model->email);
                                        }catch(\Exception $e){
                                            $this->info('Failed : '.$e->getMessage());
                                        }
                                    }
                                }
                            }else{
                                //Filter Email
                                $filtered = EmailFetch::filtering($val['from_email']);
                                $lead_status = $filtered==0?'open':'filtered';

                                if(!$check_lead){
                                    $model = new Lead();
                                    try{
                                        $model->email = $from_email;
                                        $model->subject = $subject;
                                        $model->popping_email_id = $pop_email->id;
                                        $model->status = $lead_status;
                                        $model->count = 1;
                                        $model->save();
                                        $this->info('Stored Lead : '.$model->email);
                                    }catch(\Exception $e){
                                        $this->info('Failed : '.$e->getMessage());
                                    }
                                }else{
                                    $model = Lead::where('email', $from_email)->first();
                                    try{
                                        $model->count = $model->count + 1;
                                        $model->save();
                                        $this->info('Updated Count for the Lead : '.$model->email);
                                    }catch(\Exception $e){
                                        $this->info('Failed : '.$e->getMessage());
                                    }
                                }

                            }


                            /*$sql = "INSERT INTO lead (email,popping_email_id,status,count)
                                        VALUES ('$from_email','$pop_email->id','$lead_status', 1)
                                        ON DUPLICATE KEY UPDATE count=count+1
                                        ";
                            DB::statement($sql);
                            $this->info('Stored or updated the Lead : '.$from_email);*/


                        }

                    }else{
                        $this->info('No Data Found ! ');
                    }
                }
                break;
            }
            catch(Exception $e)
            {
                $this->info($e->getMessage() . ' - failed. Retrying...');
                continue;
            }
        }

        return true;
    }




    /**
     * @param $email
     * @return int
     */
    protected static function filtering($email){
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

                /*if (strpos($email, $name) !== false) {
                    echo 'true';
                }*/
            }
        }

        return $match;
    }



    /**
     * @param $email
     * @return int
     */
    protected static function check_by_keyword($email){


        $match = 0;
        if(isset($list)) {
            foreach ($list as $word) {
                // This pattern takes care of word boundaries, and is case insensitive
                $name = $word['name'];

                $pattern = "/\b$name\b/i";
                $match += preg_match($pattern, $email);

                /*if (strpos($email, $name) !== false) {
                    echo 'true';
                }*/
            }
        }

        return $match;
    }







}
