<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:12 PM
 */

namespace Modules\Admin;


use Illuminate\Database\Eloquent\Model;
use Auth;

class InvoiceHead extends Model
{
    protected $table='invoice_head';
    protected $fillable=[
        'popping_email_id',
        'invoice_number',
        'total_cost',
        'status',
    ];
    public function relPoppingEmail()
    {
        return $this->belongsTo('Modules\Admin\PoppingEmail','popping_email_id','id');
    }



    public function relUser()
    {
        return $this->belongsTo('App\User','user_id','id');
    }


    public function relInvoiceDetail()
    {
        return $this->hasMany('Modules\Admin\InvoiceDetail','invoice_head_id','id');
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