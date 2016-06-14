<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:09 PM
 */

namespace Modules\Admin;


use Illuminate\Database\Eloquent\Model;
use Auth;

class Country extends Model
{
    protected $table='country';
    protected $fillable=[
        'code',
        'title',
    ];
    public function relPoppingEmail()
    {
        return $this->hasOne('Modules\Admin\PoppingEmail','country_id','id');
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
}