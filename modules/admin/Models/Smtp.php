<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:05 PM
 */

namespace Modules\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Smtp extends Model
{
    protected $table='smtp';
    protected $fillable=[
        'name',
        'server_username',
        'server_password',
        'host',
        'port',
        'smtp',
        'c_port',
    ];
    public function relPoppingEmail()
    {
        return $this->hasOne('Modules\Admin\PoppingEmail','smtp_id','id');
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