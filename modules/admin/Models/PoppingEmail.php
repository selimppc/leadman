<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/12/16
 * Time: 4:19 PM
 */

namespace Modules\Admin;


use Illuminate\Database\Eloquent\Model;
use Auth;

class PoppingEmail extends Model
{
    protected $table='popping_email';
    protected $fillable=[
        'email',
        'password',
        'smtp_id',
        'imap_id',
        'country_orgin',
        'price',
        'schedule_id',
        'execution_time',
        'token',
        'code',
        'auth_id',
        'auth_type',
        'status',
        'user_id',
    ];
    public function relImap()
    {
        return $this->belongsTo('Modules\Admin\Imap','imap_id','id');
    }
    public function relSmtp()
    {
        return $this->belongsTo('Modules\Admin\Smtp','smtp_id','id');
    }
    public function relSchedule()
    {
        return $this->belongsTo('Modules\Admin\Schedule','schedule_id','id');
    }
    public function relCountry()
    {
        return $this->belongsTo('Modules\Admin\Country','country_id','id');
    }
    public function relLead()
    {
        return $this->hasMany('Modules\Admin\Lead','popping_email_id','id');
    }
    public function relInvoiceHead()
    {
        return $this->hasMany('Modules\Admin\InvoiceHead','popping_email_id','id');
    }
}