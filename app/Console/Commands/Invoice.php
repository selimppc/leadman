<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Admin\InvoiceDetail;
use Modules\Admin\InvoiceHead;
use Modules\Admin\Lead;
use Illuminate\Support\Facades\DB;
use Modules\Admin\PoppingEmail;

class Invoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leadman:create-invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create invoice for lead email according to execution time ';

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

        // set the default timezone to use. Available since PHP 5.1
        date_default_timezone_set('Asia/Dacca');
        $current_date = date('Y-m-d h:i:s');

        $data = PoppingEmail::with(['relLead' => function($query) {
            $query->where('status', 'open');
        }])
            ->where('execution_time', '<=', $current_date)
            ->get();

        while(true)
        {
            try
            {
                foreach($data as $pop_email)
                {
                    $popping_email_id = $pop_email->id;
                    $price = $pop_email->price;
                    $lead_count = count($pop_email->relLead);
                    $total_cost = $price * $lead_count;
                    $invoice_number = "1212121";

                    $array_data = [
                        'popping_email_id' =>$popping_email_id,
                        'invoice_number' =>$invoice_number,
                        'total_cost' =>$total_cost,
                        'status' =>"open",
                    ];

                    try{
                        $model = new InvoiceHead();
                        if($model->create($array_data))
                        {
                            foreach($pop_email->relLead as $lead){
                                $array_dt = [
                                    'invoice_head_id'=>$model->id,
                                    'lead_id'=>$lead->id,
                                    'unit_price'=>$price,
                                ];

                                $model_dt = new InvoiceDetail();
                                $model_dt->create($array_dt);
                            }

                            $this->info(' Invoice Stored Successfully !'. $model->invoice_number);
                        }
                    }catch(\Exception $e){
                        $this->info($e->getMessage());
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
}
