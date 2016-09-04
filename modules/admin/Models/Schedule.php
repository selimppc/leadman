<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:07 PM
 */

namespace Modules\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Schedule extends Model
{
    protected $table='schedule';
    protected $fillable=[
        'day',
        'time',
    ];
    public function relPoppingEmail()
    {
        return $this->hasOne('Modules\Admin\PoppingEmail','schedule_id','id');
    }

    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }


    /**
     * @return array
     */
    public function scopeWeekDays(){
        $arr = array(
            'saturday'=>'saturday',
            'sunday'=>'sunday',
            'monday'=>'monday',
            'tuesday'=>'tuesday',
            'wednesday'=>'wednesday',
            'thursday'=>'thursday',
            'friday'=>'friday',
        );

        return $arr;
    }

    public function scopeTodayByDay(){
        //date
        $current_date = date("Y-m-d");
        $date1 = strtotime($current_date);
        $date2 = date("l", $date1);
        $today = strtolower($date2);

        return $today;
    }
}