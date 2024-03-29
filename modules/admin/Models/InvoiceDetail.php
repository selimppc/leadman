<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:10 PM
 */

namespace Modules\Admin;


use Illuminate\Database\Eloquent\Model;
use Auth;

class InvoiceDetail extends Model
{
    protected $table='invoice_detail';
    protected $fillable=[
        'invoice_head_id',
        'popping_email_id',
        'lead_id',
        'unit_price',
        'inv_date',
    ];
    public function relInvoiceHead()
    {
        return $this->belongsTo('Modules\Admin\InvoiceHead','invoice_head_id','id');
    }
    public function relLead()
    {
        return $this->belongsTo('Modules\Admin\Lead','lead_id','id');
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