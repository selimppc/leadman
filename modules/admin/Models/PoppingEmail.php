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
        'keyword',
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
    public function relUser()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function relLead()
    {
        return $this->hasMany('Modules\Admin\Lead','popping_email_id');
    }
    public function relInvoiceHead()
    {
        return $this->hasMany('Modules\Admin\InvoiceHead','popping_email_id','id');
    }

    // View related function start
    public static function last24hours(){
        $sql = "select * from v_result_24";
        return DB::select(DB::raw($sql));
    }
    public static function last24hours_lead(){
        $sql = "select * from v_result_24_lead";
        return DB::select(DB::raw($sql));
    }
    public static function last24hours_amount(){
        $sql = "select * from v_result_24_amount";
        return DB::select(DB::raw($sql));
    }

    public static function last7days(){
        $sql = "select * from v_result_7_days";
        return DB::select(DB::raw($sql));
    }
    public static function last7days_lead(){
        $sql = "select * from v_result_7_days_lead";
        return DB::select(DB::raw($sql));
    }
    public static function last7days_amount(){
        $sql = "select * from v_result_7_days_amount";
        return DB::select(DB::raw($sql));
    }
    public static function userLeadView()
    {
        $sql = "select * from v_user_leads";
        return DB::select(DB::raw($sql));
    }

    public static function userInvoiceStatusView()
    {
        $sql = "select * from v_user_invoice_status";
        return DB::select(DB::raw($sql));
    }

    public static function UserLeadStatusDuplicateView()
    {
        $sql = "select * from v_user_lead_status_duplicate";
        return DB::select(DB::raw($sql));
    }

    public static function UserLeadStatusFilteredView()
    {
        $sql = "select * from v_user_lead_status_filtered";
        return DB::select(DB::raw($sql));
    }
    // View related function End


    public static function poppingDataByTime($time){
        $sql= "select
 user.id as user_id,
 user.username,
 IFNULL(p.nope, 0) AS no_of_popping_email,
 IFNULL(l.nol, 0) AS no_of_lead,
 IFNULL(i.noi, 0) AS no_of_invoice,
 IFNULL(i.tc, 0) AS invoice_cost,
 IFNULL(l.lc, 0) AS lead_cost
from user
INNER JOIN ( select id, user_id, count(id) as nope from popping_email where status != 'cancel' group by user_id ) p on (p.user_id = user.id)

LEFT JOIN (select lead.id, lead.popping_email_id, count(lead.id) as nol, sum(popping_email.price) as lc from lead inner join popping_email on popping_email.id = lead.popping_email_id inner join user on user.id  = popping_email.user_id where lead.status != 'close' and lead.status != 'filtered' and lead.created_at > '$time' group by user.id) l on (l.popping_email_id = p.id)

LEFT JOIN (select id, user_id, sum(total_cost) as tc, count(id) as noi from invoice_head where status != 'cancel' and invoice_head.created_at > '$time' group by user_id ) i on (i.user_id = p.user_id)

GROUP BY user.id";
        return DB::select(DB::raw($sql));
    }

    public static function totalAmount($time){
        $sql= "SELECT sum(popping_email.price) total_cost
FROM lead
LEFT JOIN popping_email on lead.popping_email_id=popping_email.id
WHERE lead.created_at > '$time'
    ";
        return DB::select(DB::raw($sql));
    }
    public static function totalLead($time){
        $sql= "select count( DISTINCT lead.id ) total_lead
    from lead
    where created_at > '$time'
    ";
        return DB::select(DB::raw($sql));
    }
    public static function userLead()
    {
        $sql= "select user.id as user_id, user.username, count( DISTINCT lead.id ) total_lead, count( DISTINCT popping_email.id) no_of_popping_email
    from user
    INNER JOIN popping_email on popping_email.user_id = user.id and popping_email.status != 'cancel'
    LEFT JOIN lead on lead.popping_email_id = popping_email.id

    GROUP BY user.id ";
        return DB::select(DB::raw($sql));
    }

    public static function userInvoiceStatus()
    {
        $sql= "select
 user.username,
 IFNULL(ih1.oi, 0) AS open_invoice,
 IFNULL(ih2.ai, 0) AS approved_invoice,
 IFNULL(ih3.pi, 0) AS paid_invoice,
 IFNULL(i.tc, 0) AS total_cost
from user

 INNER JOIN ( select id, user_id, count(id) as nope from popping_email where status != 'cancel' group by user_id ) p on (p.user_id = user.id)

 LEFT JOIN (select id,user_id, count(id) as oi from invoice_head where status != 'cancel' and invoice_head.status = 'open' group by user_id ) ih1 on (user.id = ih1.user_id)
 LEFT JOIN (select id,user_id, count(id) as ai from invoice_head where status != 'cancel' and invoice_head.status = 'approved' group by user_id ) ih2 on (user.id = ih2.user_id)
 LEFT JOIN (select id,user_id, count(id) as pi from invoice_head where status != 'cancel' and invoice_head.status = 'paid' group by user_id ) ih3 on (user.id = ih3.user_id)

 LEFT JOIN (select id, user_id, sum(total_cost) as tc, count(id) as noi from invoice_head where status != 'cancel' group by user_id ) i on (i.user_id = p.user_id)
 GROUP BY user.id";

        return DB::select(DB::raw($sql));
    }
    public static function userInvoice($status)
    {
        $sql= "select user.username, count( DISTINCT invoice_head.id ) total_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from user
    INNER JOIN popping_email on popping_email.user_id = user.id and popping_email.status != 'cancel'
    LEFT JOIN invoice_head on invoice_head.popping_email_id = popping_email.id and invoice_head.status != 'cancel' and invoice_head.status = '$status'

    GROUP BY user.id ";
        return DB::select(DB::raw($sql));
    }
    public static function UserLeadStatus()
    {
        $sql = "select user.username,popping_email.email, count( DISTINCT lead.id ) duplicate_leads, count( DISTINCT lead1.id ) filtered_leads
    from popping_email
    INNER JOIN user on popping_email.user_id = user.id and popping_email.status != 'cancel'
    LEFT JOIN lead on lead.popping_email_id = popping_email.id and lead.count > 1
    LEFT JOIN lead as lead1 on lead1.popping_email_id = popping_email.id and lead1.status='filtered'
    GROUP BY popping_email.id ";
        return DB::select(DB::raw($sql));
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