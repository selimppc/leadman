<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 6/20/16
 * Time: 2:43 PM
 */

namespace App\Helpers;


use Modules\Admin\PoppingEmail;
use Modules\Admin\Schedule;

class GenerateExecutionTime
{

    /**
     * @param $popping_email_id
     * @param $schedule_id
     */
    public static function run($popping_email_id, $schedule_id)
    {

        if($popping_email_id && $schedule_id)
        {
            $schedule_data = Schedule::findOrFail($schedule_id);
            $popping_data = PoppingEmail::findOrFail($popping_email_id);

            $execution_exists = isset($popping_data->execution_time)?$popping_data->execution_time:null;
            $current_time= date('Y-m-d H:m:s');
            $generate_execution_time= date('Y-m-d',strtotime('+ '.$schedule_data->day.' day')).' '.$schedule_data->time;

            $result = $generate_execution_time;

        }
        else
        {
            $result = null;
        }

        return $result;

    }

}