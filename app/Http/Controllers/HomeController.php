<?php

namespace App\Http\Controllers;

use App\Helpers\GenerateExecutionTime;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


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
        $data = GenerateExecutionTime::run(1, 1);
        print_r($data);exit();
    }
}
