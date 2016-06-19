<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Admin\PoppingEmail;

class ExecuationTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leadman:execute-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count execution time for popping email.';

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
        $popping_emails=PoppingEmail::with('relSchedule')->get();
        print_r($popping_emails);exit;
        foreach($popping_emails as $popping_email){

        }
    }
}
