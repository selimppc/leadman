<?php

namespace Modules\Www\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Lead;
use Modules\Admin\PoppingEmail;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // set the default timezone to use. Available since PHP 5.1
        #date_default_timezone_set('Asia/Dacca');
        $current_date = date('Y-m-d h:i:s');

        $last_24 = date('Y-m-d h:i:s', strtotime("-1 day", time() ));
        $last_7_days = date('Y-m-d h:i:s', strtotime("-7 day", time() ));

        $user_id = Auth::id();

        //24 data //DONE use v_result_24 by user_id
        $sql_24_sql = "select
p.email,
IFNULL(l.nol, 0) AS no_of_lead,
IFNULL(l.lc, 0) AS lead_cost,
IFNULL(i.noi, 0) AS no_of_invoice,
IFNULL(i.tc, 0) AS invoice_cost
from popping_email as p

LEFT JOIN (select lead.popping_email_id, count(lead.id) as nol, sum(popping_email.price) as lc from lead INNER JOIN popping_email on popping_email.id = lead.popping_email_id where lead.status != 'close' and lead.status != 'filtered' and lead.created_at > '$last_24' group by lead.popping_email_id ) l on (l.popping_email_id = p.id)

LEFT JOIN (select invoice_detail.popping_email_id , count(DISTINCT invoice_detail.invoice_head_id ) as noi, sum(invoice_detail.unit_price) as tc from invoice_detail join invoice_head  on invoice_head.id = invoice_detail.invoice_head_id where invoice_head.status != 'cancel' and invoice_head.created_at > '$last_24' group by popping_email_id ) i on (i.popping_email_id = p.id)

WHERE p.user_id = '$user_id' and p.status != 'cancel'
";
        $result_24 = DB::select(DB::raw($sql_24_sql));
        // working on sql_mode = ""
        /*$sql_24_sql = "select
p.email,
IFNULL(l.nol, 0) AS no_of_lead,
IFNULL(l.lc, 0) AS lead_cost,
IFNULL(i.noi, 0) AS no_of_invoice,
IFNULL(i.tc, 0) AS invoice_cost
from popping_email as p

LEFT JOIN (select lead.popping_email_id, count(lead.id) as nol, sum(popping_email.price) as lc from lead INNER JOIN popping_email on popping_email.id = lead.popping_email_id where lead.status != 'close' and lead.status != 'filtered' and lead.created_at > '$last_24' group by lead.popping_email_id ) l on (l.popping_email_id = p.id)

LEFT JOIN (select invoice_head.popping_email_id, sum(invoice_head.total_cost) as tc, count(invoice_head.id) as noi from invoice_head where invoice_head.status != 'cancel' and invoice_head.created_at > '$last_24' group by popping_email_id ) i on (i.popping_email_id = p.id)

WHERE p.user_id = '$user_id' and p.status != 'cancel'
";*/
        /*$sql_24_sql = "select
 p.email,
 IFNULL(l.nol, 0) AS no_of_lead,
 IFNULL(l.lc, 0) AS lead_cost,
 IFNULL(i.noi, 0) AS no_of_invoice,
 IFNULL(i.tc, 0) AS invoice_cost
from
popping_email as p

 LEFT JOIN (select lead.id, lead.popping_email_id, count(lead.id) as nol, sum(popping_email.price) as lc from lead INNER JOIN popping_email on popping_email.id = lead.popping_email_id where lead.status != 'close' and lead.status != 'filtered' and lead.created_at > '$last_24' group by lead.popping_email_id ) l on (l.popping_email_id = p.id)

LEFT JOIN (select invoice_head.id, invoice_head.user_id, invoice_head.popping_email_id,  sum(invoice_head.total_cost) as tc, count(invoice_head.id) as noi from invoice_head where invoice_head.status != 'cancel' and invoice_head.created_at > '$last_24' group by popping_email_id ) i on (i.popping_email_id = p.id)

WHERE p.user_id = '5' and p.status != 'cancel'
";*/
        //exit($sql_24_sql);
        /*$sql_24_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead, count( DISTINCT invoice_head.id) no_of_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id and lead.created_at > '$last_24' and lead.status != 'filtered'
    LEFT JOIN invoice_head on invoice_head.user_id = popping_email.user_id and invoice_head.created_at > '$last_24'
    WHERE popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        $result_24 = DB::select(DB::raw($sql_24_sql));*/


        // In Last 7 days //DONE user v_result_7_days by user_id
        $result_7_days_sql = "select
p.email,
IFNULL(l.nol, 0) AS no_of_lead,
IFNULL(l.lc, 0) AS lead_cost,
IFNULL(i.noi, 0) AS no_of_invoice,
IFNULL(i.tc, 0) AS invoice_cost
from popping_email as p

LEFT JOIN (select lead.popping_email_id, count(lead.id) as nol, sum(popping_email.price) as lc from lead INNER JOIN popping_email on popping_email.id = lead.popping_email_id where lead.status != 'close' and lead.status != 'filtered' and lead.created_at > '$last_7_days' group by lead.popping_email_id ) l on (l.popping_email_id = p.id)

LEFT JOIN (select invoice_detail.popping_email_id , count(DISTINCT invoice_detail.invoice_head_id ) as noi, sum(invoice_detail.unit_price) as tc from invoice_detail join invoice_head  on invoice_head.id = invoice_detail.invoice_head_id where invoice_head.status != 'cancel' and invoice_head.created_at > '$last_7_days' group by popping_email_id ) i on (i.popping_email_id = p.id)

WHERE p.user_id = '$user_id' and p.status != 'cancel'";
        $result_7_days = DB::select(DB::raw($result_7_days_sql));


        //-- Numbers of email -> link to list of email. // DONE use vu_no_of_email by user_id
        $no_of_email_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id
    WHERE popping_email.user_id = '$user_id'  and popping_email.status != 'cancel'
    GROUP BY popping_email.id ";
        $no_of_email = DB::select(DB::raw($no_of_email_sql));


        //-- Show no of duplicate email stat //DONE user v_user_lead_status by user_id
        $no_duplicate_email_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id
    WHERE lead.count > 1 and popping_email.user_id = '$user_id'  and popping_email.status != 'cancel'
    GROUP BY popping_email.id ";
        $no_duplicate_email = DB::select(DB::raw($no_duplicate_email_sql));


        //-- Show filtered  email stat //DONE user vu_no_filtered_email by user_id
        $no_filtered_email_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id
    WHERE lead.status='filtered' and popping_email.user_id = '$user_id' and popping_email.status != 'cancel'
    GROUP BY popping_email.id ";
        $no_filtered_email = DB::select(DB::raw($no_filtered_email_sql));

        //-- Show invoice Status //DONE user v_user_invoice_status by user
        $invoice_status_sql = "select
 IFNULL(ih1.oi, 0) AS open_invoice,
 IFNULL(ih2.ai, 0) AS approved_invoice,
 IFNULL(ih3.pi, 0) AS paid_invoice,
 IFNULL(i.tc, 0) AS total_cost
from invoice_head ih

LEFT JOIN (select id,user_id, count(id) as oi from invoice_head where status != 'cancel' and invoice_head.status = 'open' group by user_id ) ih1 on (ih.user_id = ih1.user_id)

LEFT JOIN (select id,user_id, count(id) as ai from invoice_head where status != 'cancel' and invoice_head.status = 'approved' group by user_id ) ih2 on (ih.user_id = ih2.user_id)

LEFT JOIN (select id,user_id, count(id) as pi from invoice_head where status != 'cancel' and invoice_head.status = 'paid' group by user_id ) ih3 on (ih.user_id = ih3.user_id)

LEFT JOIN (select id, user_id, sum(total_cost) as tc, count(id) as noi from invoice_head where status != 'cancel' group by user_id ) i on (ih.user_id = i.user_id)

where ih.user_id = '$user_id'
GROUP BY ih.user_id";
        $invoice_status = DB::select(DB::raw($invoice_status_sql));

        return view('www::user_dashboard.index', [
            'result_24' => $result_24,
            'result_7_days' => $result_7_days,
            'no_of_email' => $no_of_email,
            'no_duplicate_email' => $no_duplicate_email,
            'no_filtered_email' => $no_filtered_email,
            'invoice_status' => $invoice_status
        ]);

    }

    public function view_list_lead($popping_email_id){
        // all lead email goes here according to popping_email_id

        $user_id = Auth::user()->id;
        //check the popping_email_id exists or not for logged-in user
        $check_popping_email_user_id = PoppingEmail::where('id', $popping_email_id)->where('user_id', $user_id)->exists();

        if($check_popping_email_user_id){
            $lead_data = Lead::where('popping_email_id', $popping_email_id)->get();
        }else{
            $message = "You are not authorized to view this data(s) ! Please contact with support !";
        }

        return view('www::user_dashboard.lead_lists', [
            'lead_data' => $lead_data,
            'message' => $message,
        ]);

    }
}
