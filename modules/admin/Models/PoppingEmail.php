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
use Illuminate\Support\Facades\DB;

class PoppingEmail extends Model
{
    protected $table='popping_email';
    protected $fillable=[
        'email',
        'password',
        'smtp_id',
        'imap_id',
        'country_origin',
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
        return $this->belongsTo('Modules\Admin\Country','country_origin','id');
    }
    public function relLead()
    {
        return $this->hasMany('Modules\Admin\Lead','popping_email_id','id');
    }
    public function relInvoiceHead()
    {
        return $this->hasMany('Modules\Admin\InvoiceHead','popping_email_id','id');
    }

    public static function poppingDataByTime($time,$user_id=false){
        if(isset($user_id) && !empty($user_id)) {
            $sql= "select popping_email.email, count( DISTINCT lead.id ) no_of_lead, count( DISTINCT invoice_head.id) no_of_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id and lead.created_at > '$time'
    LEFT JOIN invoice_head on invoice_head.popping_email_id = popping_email.id and invoice_head.created_at > '$time'
    WHERE popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        }else{
            $sql= "select popping_email.email, count( DISTINCT lead.id ) no_of_lead, count( DISTINCT invoice_head.id) no_of_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id and lead.created_at > '$time'
    LEFT JOIN invoice_head on invoice_head.popping_email_id = popping_email.id and invoice_head.created_at > '$time'
    GROUP BY popping_email.id ";
        }
        return DB::select(DB::raw($sql));
    }
    public static function userLead()
    {
        $sql= "select user.username, count( DISTINCT lead.id ) total_lead, count( DISTINCT popping_email.id) no_of_popping_email
    from user
    RIGHT JOIN popping_email on popping_email.user_id = user.id
    RIGHT JOIN lead on lead.popping_email_id = popping_email.id

    GROUP BY user.id ";
        return DB::select(DB::raw($sql));
    }
    public static function userInvoice($status)
    {
        $sql= "select user.username, count( DISTINCT invoice_head.id ) total_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from user
    RIGHT JOIN popping_email on popping_email.user_id = user.id
    RIGHT JOIN invoice_head on invoice_head.popping_email_id = popping_email.id where invoice_head.status = '$status'

    GROUP BY user.id ";
        return DB::select(DB::raw($sql));
    }
}