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
        $data['pageTitle'] = 'Dashboard';
        $data['result_24']= PoppingEmail::poppingDataByTime(date('Y-m-d h:i:s', strtotime("-1 day", time() )));

        $data['result_7_days']= PoppingEmail::poppingDataByTime(date('Y-m-d h:i:s', strtotime("-7 day", time() )));
        $data['user_leads']= PoppingEmail::userLead();
        $data['user_invoices_status']= PoppingEmail::userInvoiceStatus();
        $data['user_lead_status']= PoppingEmail::UserLeadStatus();

        //===== For Total Lead ***//
        $sql_lead = DB::table('lead')->where('status','!=', 'filtered')->get();
        $lead_qtt_1 = 0;
        $lead_qtt_7 = 0;
        if($sql_lead){
            foreach($sql_lead as $lead_qt){
                if($lead_qt->created_at > date('Y-m-d h:i:s', strtotime("-1 day", time() ))){
                    $lead_qtt_1 += 1;
                }
                if($lead_qt->created_at > date('Y-m-d h:i:s', strtotime("-7 day", time() ))){
                    $lead_qtt_7 += 1;
                }
                //$lead_qtt_7 += $qtt7;
            }
        }
        //print_r(count($sql_lead)); exit();
        $data['total_lead_1']= $lead_qtt_1;
        $data['total_lead_7']= $lead_qtt_7;



        //===== For Total Cost ***//
        $sql_popping_email = DB::table('popping_email')->get();
        $total = 0;
        //$total = array();
        $price_popping_email = 0;
        if($sql_popping_email)
        {
            foreach($sql_popping_email as $email)
            {
                $price = $email->price;
                $popping_email_id = $email->id;
                if($sql_lead)
                {
                    $lead_qty_1 = 0;
                    $lead_qty_7 = 0;
                    foreach($sql_lead as $lead)
                    {
                        if($lead->popping_email_id == $popping_email_id && $lead->created_at > date('Y-m-d h:i:s', strtotime("-1 day", time() )) ){
                            $lead_qty_1 += 1;
                        }
                        if($lead->popping_email_id == $popping_email_id && $lead->created_at > date('Y-m-d h:i:s', strtotime("-7 day", time() )) ){
                            $lead_qty_7 += 1;
                        }
                    }
                    //print_r($lead_qty); exit();
                    /*if($lead_qty_1){*/
                        $price_popping_email = $price * $lead_qty_1;
                   /* }*/

                }
                //print_r($price_popping_email); exit();
                $total += $price_popping_email;
                //$total[] = $price_popping_email;
            }
        }
        //print_r($total); exit();
        $data['total_cost']= $total;

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