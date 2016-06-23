<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/16/16
 * Time: 11:25 AM
 */

namespace Modules\Admin\Controllers;


use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Admin\PoppingEmail;
use Modules\Admin\Lead;

class DashboardController extends Controller
{


    public function admin_user_dashboard()
    {
        $user_login = Session::get('role_title');

        if($user_login == 'user'){

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
    LEFT JOIN invoice_head on invoice_head.user_id = popping_email.user_id and invoice_head.created_at > '$last_24'
    WHERE popping_email.user_id = '$user_id'
    GROUP BY popping_email.id ";
            $result_24 = DB::select(DB::raw($sql_24_sql));


            // In Last 7 days
            $result_7_days_sql = "select popping_email.email, count( DISTINCT lead.id ) no_of_lead, count( DISTINCT invoice_head.id) no_of_invoice, sum(DISTINCT invoice_head.total_cost) total_cost
    from popping_email
    left JOIN lead on lead.popping_email_id = popping_email.id and lead.created_at > '$last_7_days' and lead.status != 'filtered'
    LEFT JOIN invoice_head on invoice_head.user_id = popping_email.user_id and invoice_head.created_at > '$last_7_days'
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

        }else{
            return DashboardController::dashboard();
        }

    }


    public function dashboard()
    {
        $data['pageTitle'] = 'Dashboard';
        $data['result_24']= PoppingEmail::poppingDataByTime(date('Y-m-d h:i:s', strtotime("-1 day", time() )));
        $data['result_24_lead']= PoppingEmail::totalLead(date('Y-m-d h:i:s', strtotime("-1 day", time() )));
        $data['result_24_amount']= PoppingEmail::totalAmount(date('Y-m-d h:i:s', strtotime("-1 day", time() )));
        $data['result_7_days']= PoppingEmail::poppingDataByTime(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
        $data['result_7_days_lead']= PoppingEmail::totalLead(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
        $data['result_7_days_amount']= PoppingEmail::totalAmount(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
        $data['user_leads']= PoppingEmail::userLead();
        $data['user_invoices_status']= PoppingEmail::userInvoiceStatus();
        $data['user_lead_status']= PoppingEmail::UserLeadStatus();

        return view('admin::dashboard.index',$data);
    }

    private static function leadData($date)
    {
        // set the default timezone to use. Available since PHP 5.1
        date_default_timezone_set('Asia/Dacca');
        return DB::table('popping_email')
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_of_lead, no_of_invoice, total_cost'))
            ->leftJoin('lead', function($join) use ($date) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id')
                    ->where( 'lead.created_at','>', $date );
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
            ->addBinding($date, 'select')
            ->get();
    }

    public function all_routes_uri(){

        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {
            $routes_list[] = Str::lower($value->getPath());
        }
        echo '<pre>';
        print_r($routes_list);exit;
    }

    public function user_by_lead($user_id){

        $user_data = User::findOrFail($user_id);

        //sql query for all
        $sql = "select pe.email, pe.password, count( DISTINCT lead.id ) no_of_lead
            from popping_email as pe
            LEFT JOIN lead on lead.popping_email_id = pe.id and lead.status != 'filtered'
            WHERE pe.user_id = '$user_id'
            GROUP BY pe.id ";
        $result = DB::select(DB::raw($sql));


        return view('admin::dashboard.user_by_lead', [
            'result'=>$result,
            'user_data'=>$user_data
        ]);
    }

}