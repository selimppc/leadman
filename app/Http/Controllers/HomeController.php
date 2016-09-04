<?php

namespace App\Http\Controllers;

use App\Helpers\GenerateExecutionTime;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Admin\Lead;
use Modules\Admin\Schedule;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {


        $pageTitle = 'Dashboard';

          return view('admin::layouts.dashboard',['pageTitle'=>$pageTitle]);
    }

    public function all_routes_uri(){

        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {
            $routes_list[] = Str::lower($value->getPath());
        }
        echo '<pre>';
        print_r($routes_list);exit;
    }


    public function home_test(){

        $today = Schedule::TodayByDay();
        $array_of = Schedule::WeekDays();

        $exists = in_array($today, $array_of);

        $mydate=getdate(date("U"));

        $nextTuesday = strtotime('next tuesday');
        $weekNo = date('W');
        $weekNoNextTuesday = date('W', $nextTuesday);

        /*if ($weekNoNextTuesday != $weekNo) {
            //past tuesday
        }*/
        $d = date('Y-m-d', strtotime('next sunday'));;
        print_r($d);
        exit("");

        $data = GenerateExecutionTime::run(1, 1);
        print_r($data);exit();
    }

    public function arrayToString($array) {
        $string = '';
        foreach($array as $key => $value) {
            $string .= "{$key} => {$value}\n";
        }

        print_r($string);exit();
        return $string;
    }
}
