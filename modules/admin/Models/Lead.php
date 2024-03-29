<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:13 PM
 */

namespace Modules\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Lead extends Model
{
    protected $table='lead';
    protected $fillable=[
        'email',
        'popping_email_id',
        'status',
        'count',
    ];

    public function relPoppingEmail()
    {
        return $this->belongsTo('Modules\Admin\PoppingEmail','popping_email_id','id');
    }
    public function relInvoiceDetail()
    {
        return $this->hasMany('Modules\Admin\InvoiceDetail','lead_id','id');
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