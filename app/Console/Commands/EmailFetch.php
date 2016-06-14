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
use Modules\Admin\PoppingEmail;


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
        $popping_email = PoppingEmail::with('relImap')->where('status', 'active')->get();

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
                        exit("Google Area");

                    }
                    else
                    {

                        //TODO:: call ImapCall
                        exit("Imap Area ");

                    }
                }
                $this->info('All Popping Email Fetched ! ');
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






}
