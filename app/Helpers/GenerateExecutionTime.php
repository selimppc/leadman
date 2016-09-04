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
        //pick data
        $popping_data = PoppingEmail::findOrFail($popping_email_id);
        $schedule_data = Schedule::findOrFail($schedule_id);

        //week day and check in array ;
        $week_day = $schedule_data->day;

        $week_day_lists = Schedule::WeekDays();
        $exists_in_day = in_array($week_day, $week_day_lists);

        //check execution time
        $execution_exists = isset($popping_data->execution_time)?$popping_data->execution_time:null;
        $current_time= date('Y-m-d H:m:s');


        //generate execution time
        if($execution_exists!=null && $execution_exists >= $current_time)
        {
            $result = $execution_exists;
        }
        else
        {
            if($exists_in_day != null)
            {
                $nextDate = date('Y-m-d', strtotime('next '. $week_day));
                $generate_execution_time= $nextDate.' '.$schedule_data->time;
                $result = $generate_execution_time;
            }
            else
            {
                $generate_execution_time= date('Y-m-d',strtotime('+ '.$schedule_data->day.' day')).' '.$schedule_data->time;
                $result = $generate_execution_time;
            }

        }

        return $result;

    }

}