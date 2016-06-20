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
        $popping_emails=PoppingEmail::with(['relSchedule'])->get();

        while(true)
        {
            try
            {
                foreach($popping_emails as $popping_email){
                    $execution =true;
                    $current_time= date('Y-m-d H:m:s');
                    $execution_time= date('Y-m-d',strtotime('+ '.$popping_email->relSchedule->day.' day')).' '.$popping_email->relSchedule->time;
                    if($popping_email->execution_time!=null && $popping_email->execution_time >= $current_time)
                    {
                        $execution=false;
                    }
                    if($execution) {
                        $poppingEmail = PoppingEmail::findOrFail($popping_email->id);
                        $poppingEmail->execution_time = $execution_time;
                        $poppingEmail->save();
                    }
                }
                break;
            }catch(Exception $e)
            {
                $this->info($e->getMessage() . ' - failed. Retrying...');
                continue;
            }
        }
    }
}
