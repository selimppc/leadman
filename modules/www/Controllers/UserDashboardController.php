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
        date_default_timezone_set('Asia/Dacca');
        $current_date = date('Y-m-d h:i:s');

        $last_24 = date('Y-m-d h:i:s', strtotime("-1 day", time() ));
        $last_7_days = date('Y-m-d h:i:s', strtotime("-7 day", time() ));

        $user_id = Auth::id();

        //24 data
        $sql_24_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead, count( DISTINCT invoice_head.id) no_of_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id and lead.created_at > '$last_24' and lead.status != 'filtered'
    LEFT JOIN invoice_head on invoice_head.popping_email_id = popping_email.id and invoice_head.created_at > '$last_24'
    WHERE popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        $result_24 = DB::select(DB::raw($sql_24_sql));


        // In Last 7 days
        $result_7_days_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead, count( DISTINCT invoice_head.id) no_of_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id and lead.created_at > '$last_7_days' and lead.status != 'filtered'
    LEFT JOIN invoice_head on invoice_head.popping_email_id = popping_email.id and invoice_head.created_at > '$last_7_days'
    WHERE popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        $result_7_days = DB::select(DB::raw($result_7_days_sql));


        //-- Numbers of email -> link to list of email.
        $no_of_email_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id
    WHERE popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        $no_of_email = DB::select(DB::raw($no_of_email_sql));


        //-- Show no of duplicate email stat
        $no_duplicate_email_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id
    WHERE lead.count > 1 and popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        $no_duplicate_email = DB::select(DB::raw($no_duplicate_email_sql));


        //-- Show filtered  email stat
        $no_filtered_email_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id
    WHERE lead.status='filtered' and popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
        $no_filtered_email = DB::select(DB::raw($no_filtered_email_sql));


        return view('www::user_dashboard.index', [
            'result_24' => $result_24,
            'result_7_days' => $result_7_days,
            'no_of_email' => $no_of_email,
            'no_duplicate_email' => $no_duplicate_email,
            'no_filtered_email' => $no_filtered_email,
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
