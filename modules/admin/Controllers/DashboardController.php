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
    public function dashboard()
    {
        $last_24 = date('Y-m-d h:i:s', strtotime("-1 day", time() ));
        $last_7_days = date('Y-m-d h:i:s', strtotime("-7 day", time() ));


        $user_login = Session::get('role_title');
        if($user_login == 'user'){
            return redirect()->to('dashboard/user');
        }else{
            $data['pageTitle'] = 'Dashboard';

            /*$data['pageTitle'] = 'Dashboard';
            $data['result_24']= PoppingEmail::poppingDataByTime(date('Y-m-d h:i:s', strtotime("-1 day", time() )));
            $data['result_24_lead']= PoppingEmail::totalLead(date('Y-m-d h:i:s', strtotime("-1 day", time() )));
            $data['result_24_amount']= PoppingEmail::totalAmount(date('Y-m-d h:i:s', strtotime("-1 day", time() )));
            $data['result_7_days']= PoppingEmail::poppingDataByTime(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
            $data['result_7_days_lead']= PoppingEmail::totalLead(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
            $data['result_7_days_amount']= PoppingEmail::totalAmount(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
            $data['user_leads']= PoppingEmail::userLead();
            $data['user_invoices_status']= PoppingEmail::userInvoiceStatus();*/
            //$data['user_lead_status']= PoppingEmail::UserLeadStatus();

            //Mysql View
            $data['result_24']= PoppingEmail::last24hours();
            $data['result_24_lead']= PoppingEmail::last24hours_lead();
            $data['result_24_amount']= PoppingEmail::last24hours_amount();
            $data['result_7_days']= PoppingEmail::last7days();
            $data['result_7_days_lead']= PoppingEmail::last7days_lead();
            $data['result_7_days_amount']= PoppingEmail::last7days_amount();
            $data['user_leads']= PoppingEmail::userLeadView();
            $data['user_invoices_status']= PoppingEmail::userInvoiceStatusView();
            $data['user_lead_status_duplicate']= PoppingEmail::UserLeadStatusDuplicateView();
            $data['user_lead_status_filtered']= PoppingEmail::UserLeadStatusFilteredView();

            //date
            $data['last_24'] = $last_24;
            $data['last_7_days'] = $last_7_days;

            return view('admin::dashboard.index',$data);
        }

    }

    private static function leadData($date)
    {
        // set the default timezone to use. Available since PHP 5.1
        #date_default_timezone_set('Asia/Dacca');
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

    public function user_by_lead($user_id, $time=null)
    {

        $user_data = User::findOrFail($user_id);
        $time = isset($time) ? $time : null;
        $last_24 = date('Y-m-d h:i:s', strtotime("-1 day", time() ));
        $last_7_days = date('Y-m-d h:i:s', strtotime("-7 day", time() ));

        if($time == 24)
        {
            //sql query for all
            $sql = "select pe.email, pe.password, count( DISTINCT lead.id ) no_of_lead, v_dpc.duplicate_leads
            from popping_email as pe
            LEFT JOIN lead on lead.popping_email_id = pe.id and lead.status != 'filtered' and lead.created_at > '$last_24'
            LEFT JOIN v_user_lead_status_duplicate_24hours v_dpc on v_dpc.email = pe.email
            WHERE pe.user_id = '$user_id'
            GROUP BY pe.id ";
        }
        else if($time == 7)
        {
            //sql query for all
            $sql = "select pe.email, pe.password, count( DISTINCT lead.id ) no_of_lead, v_dpc.duplicate_leads
            from popping_email as pe
            LEFT JOIN lead on lead.popping_email_id = pe.id and lead.status != 'filtered' and lead.created_at > '$last_24'
            LEFT JOIN v_user_lead_status_duplicate_7days v_dpc on v_dpc.email = pe.email
            WHERE pe.user_id = '$user_id'
            GROUP BY pe.id ";
        }
        else
        {
            //sql query for all
            $sql = "select pe.email, pe.password, count( DISTINCT lead.id ) no_of_lead, v_dpc.duplicate_leads
            from popping_email as pe
            LEFT JOIN lead on lead.popping_email_id = pe.id and lead.status != 'filtered'
            LEFT JOIN v_user_lead_status_duplicate v_dpc on v_dpc.email = pe.email
            WHERE pe.user_id = '$user_id'
            GROUP BY pe.id ";
        }

        $result = DB::select(DB::raw($sql));


        return view('admin::dashboard.user_by_lead', [
            'result'=>$result,
            'user_data'=>$user_data
        ]);
    }

}