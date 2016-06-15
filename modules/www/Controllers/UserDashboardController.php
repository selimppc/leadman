<?php

namespace Modules\Www\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        print $current_date."<br>";
        print $last_24."<br>";


        //last 24 data

        /*$data = $freshOffers = DB::select('
    (select `id`, `title`, `created_at` from `ppc_offers`)
    union all
    (select `id`, `title`, `created_at` from `survery_offers`)
    union all
    (select `id`, `title`, `created_at` from `find_offers`)
    order by `created_at` desc
    limit 3
    ');*/

        $results = DB::table('popping_email')
            #->distinct()
            ->select(DB::raw('popping_email.email as email, COUNT(lead.id) as no_lead, invoice_head.invoice_number, invoice_head.total_cost '))
            ->leftJoin('lead', function($join) use ($last_24) {
                $join->on('popping_email.id', '=', 'lead.popping_email_id')
                    ->where( 'lead.created_at','>', $last_24 );
            })
            ->leftJoin('invoice_head', function($join) use ($last_24) {
                $join->on('popping_email.id', '=', 'invoice_head.popping_email_id')
                    ->where( 'lead.created_at','>', $last_24 );
            })
            #->whereBetween('lead.created_at', array($current_date, $last_24))
            #->where('bookings.room_type_id', '=', NULL)
            #->groupBy('lead.popping_email_id')
            ->get();

        print_r($results);




        //-- 24 hours
        //-- Last 1 Week
        //-- Numbers of email -> link to list of email.
        //-- Show duplicate email stat -> link to list
        //-- Show filtered email stat -> link to list

        print_r("OK");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
