<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 6/14/16
 * Time: 3:45 PM
 */

namespace App\Helpers;

use App\Setting;
use Modules\Admin\CentralSettings;

class GenerateNumber
{

    public static function run() {
        $settings = CentralSettings::where('title','=','invoice-number')->first();
        if($settings){
            $number = $settings['status'] + 1;
            $generate_voucher_number = 'INV-'.str_pad($number, 6, '0', STR_PAD_LEFT);
            $array = array('generated_number'=>$generate_voucher_number);
            GenerateNumber::update_row($settings->id,$number);
            return  $array;
        }else{
            return  false;
        }
    }

    /**
     * @param $row_id
     * @param $value
     * @return bool
     */
    public static function update_row($row_id,$value) {
        $settings = CentralSettings::findOrFail($row_id);
        if($settings){
            $settings->status=$value;
            $settings->save();
            return  true;
        }else{
            return  false;
        }
    }
}