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

        //last 24 data
        $result_24 = DB::table('popping_email')
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_of_lead, no_of_invoice, total_cost'))
            ->leftJoin('lead', function($join) use ($last_24) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id')
                    ->where( 'lead.created_at','>', $last_24 );
            })
            ->leftJoin(
                DB::raw("
                (select
                COUNT(`inv_hd`.`id`) as `no_of_invoice`, SUM(`inv_hd`.`total_cost`) as `total_cost`
                    from `invoice_head` as `inv_hd`
                    where `inv_hd`.`created_at` > ?
                    ) `invoice_head`
                "), 'popping_email.id', '=', 'popping_email_id'
            )
            ->addBinding($last_24, 'select')
            ->where('user_id', Auth::user()->id)
            ->get();

        // In Last 7 days
        $result_7_days = DB::table('popping_email')
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_of_lead, no_of_invoice, total_cost'))
            ->leftJoin('lead', function($join) use ($last_7_days) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id')
                    ->where( 'lead.created_at','>', $last_7_days );
            })
            ->leftJoin(
                DB::raw("
                (select
                COUNT(`inv_hd`.`id`) as `no_of_invoice`, SUM(`inv_hd`.`total_cost`) as `total_cost`
                    from `invoice_head` as `inv_hd`
                    where `inv_hd`.`created_at` > ?
                    ) `invoice_head`
                "), 'popping_email.id', '=', 'popping_email_id'
            )
            ->addBinding($last_7_days, 'select')
            ->where('user_id', Auth::user()->id)
            ->get();


        //-- Numbers of email -> link to list of email.
        $no_of_email = DB::table('popping_email')
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_of_lead'))
            ->leftJoin('lead', function($join) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id');
            })
            ->where('user_id', Auth::user()->id)
            ->get();


        //-- Show duplicate email stat -> link to list
        $no_duplicate_email = DB::table('popping_email')
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_of_lead'))
            ->leftJoin('lead', function($join) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id')
                    ->where( 'lead.count','>', 1 );
            })
            ->where('user_id', Auth::user()->id)
            ->get();


        //-- Show duplicate email stat -> link to list
        $no_filtered_email = DB::table('popping_email')
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_of_lead'))
            ->leftJoin('lead', function($join) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id')
                    ->where( 'lead.status','=', 'filtered' );
            })
            ->where('user_id', Auth::user()->id)
            ->get();


        return view('www::user_dashboard.index', [
            'result_24' => $result_24,
            'result_7_days' => $result_7_days,
            'no_of_email' => $no_of_email,
            'no_duplicate_email' => $no_duplicate_email,
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
