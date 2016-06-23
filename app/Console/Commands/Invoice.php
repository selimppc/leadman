<?php

namespace App\Console\Commands;

use App\Helpers\GenerateExecutionTime;
use App\Helpers\GenerateNumber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
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
        #date_default_timezone_set('Asia/Dacca');
        $current_date = date('Y-m-d h:i:s');

        $data = PoppingEmail::with(['relLead' => function($query) {
            #$query->where('lead.status', 'open');
        }])
            #->where('execution_time', '<=', $current_date)
            ->where('popping_email.status', '=', 'active')
            ->get();

        while(true)
        {
            try
            {
                if(count($data)>0){
                    foreach($data as $pop_email)
                    {
                        if(count($pop_email->relLead)>0){
                            //convert object to an array
                            $lead_array = $pop_email->relLead->toArray();

                            // visualize data for storing
                            $popping_email_id = $pop_email->id;
                            $user_id = $pop_email->user_id;
                            $price = $pop_email->price;
                            $lead_count = count($pop_email->relLead);
                            $total_cost = $price * $lead_count;
                            $invoice_number = GenerateNumber::run();

                            $array_data = [
                                #'popping_email_id' =>$popping_email_id,
                                'user_id' =>$user_id,
                                'invoice_number' =>$invoice_number['generated_number'],
                                'total_cost' =>$total_cost,
                                'status' =>"open",
                            ];


                            /* Transaction Start Here */
                            DB::beginTransaction();
                            try{

                                //model for invoice head
                                $model = new InvoiceHead();
                                if($hd_inv = $model->create($array_data))
                                {
                                    /*foreach($pop_email->relLead as $lead){

                                        $array_dt = [
                                            'invoice_head_id'=>$hd_inv->id,
                                            'lead_id'=>$lead->id,
                                            'unit_price'=>$price,
                                        ];

                                        //store into invoice detail and updated status of lead
                                        $model_dt = new InvoiceDetail();
                                        if($model_dt->create($array_dt)){
                                            $lead_model = Lead::findOrFail($lead->id);
                                            $lead_model->status = 'invoiced';
                                            $lead_model->save();
                                        }
                                    }*/

                                    // success report
                                    $this->info(' Invoice Stored Successfully !'. $invoice_number['generated_number']);

                                    //Keep lead data into txt file as per invoice and delete them all
                                    $result = $this->lead_to_txt($invoice_number['generated_number'], $lead_array);

                                    if($result){
                                        $this->info(' Store new text file with lead data!'. $invoice_number['generated_number'].".txt");
                                    }

                                }

                                //Generate Execution Time and Update in Popping_email Table
                                $generate_execution_time = GenerateExecutionTime::run($pop_email->id, $pop_email->schedule_id);
                                $model= PoppingEmail::findOrFail($pop_email->id);
                                $model->execution_time = $generate_execution_time;
                                $model->save();

                                $this->info('... Next Execution Time : '. $generate_execution_time);

                                //Commit the changes
                                DB::commit();
                            }catch(\Exception $e){
                                //If there are any exceptions, rollback the transaction`
                                DB::rollback();
                                $this->info($e->getMessage());
                            }
                        }else{
                            $this->info('No data found from Lead to create Invoice !');
                        }

                    }
                    break;
                }else{
                    $this->info('No data found from Lead to create Invoice !');
                    break;
                }
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
     * @param $invoice_no
     * @param $array_data
     * @return bool
     */
    private function lead_to_txt($invoice_no, $array_data){
        $invoice_no = $invoice_no;
        //file Path
        $path = public_path()."/lead_files/";

        //check permission from config
        $permissions = intval( config('permissions.directory'), 0);

        if(!File::Exists($path)){
            //make folder with $path generate recursive with right 0775
            File::makeDirectory($path, $permissions , true);
        }

        //make data in string to store in txt file
        $string = '';
        foreach($array_data as $val)
        {
            $string .= $val['id']."-".$val['email']."\n";
        }

        //create array of lead id
        $lead_ids = array();
        foreach($array_data as $value)
        {
            $lead_ids[] = array(
                'id'=>$value['id'],
            );
        }


        /* Transaction Start Here */
        DB::beginTransaction();
        try{
            $file_name = $path.$invoice_no.".txt";
            $handle = fopen($file_name, 'w');
            $a = fwrite($handle,$string);
            fclose($handle);

            /* data delete from Lead table by Lead_ID */
            DB::table('lead')->whereIn('id', $lead_ids)->delete();

            //Commit the changes
            DB::commit();

            return true;

        }catch(\Exception $e){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            $this->info($e->getMessage());
            return false;
        }
    }







}
