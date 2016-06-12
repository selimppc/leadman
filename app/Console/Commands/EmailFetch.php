<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
    }
}
