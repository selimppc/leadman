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
            $number = $settings['last_number'] + $settings['increment'];
            $settings_code = $settings['code'];
            $settings_id = $settings['id'];
            $generate_voucher_number = $settings_code.'-'.str_pad($number, 6, '0', STR_PAD_LEFT);
            $array = array('generated_number'=>$generate_voucher_number, 'setting_id'=>$settings_id, 'number' => $number );
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
        $settings = Setting::findOrFail($row_id);
        if($settings){
            $settings->last_number=$value;
            $settings->save();
            return  true;
        }else{
            return  false;
        }
    }
}