<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:29 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\CentralSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

//use Illuminate\Session;

class CentralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Central Settings';
        if(session()->has('user_id'))
        {
            $data['ses_user_id'] = session()->get('user_id');
            $model = new CentralSettings();
            if(Auth::user()->role_id=='1' && $data['ses_user_id']=='1'){
                $data['settings_data'] = $model->all();
            }
            else{
                $data['settings_data'] = $model->where('user_type','user')->get();
            }
            return view('admin::settings.central_settings.index',$data);
        }
        else
        {
            return redirect()->back();
        }
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
        $data['data'] = CentralSettings::where('id',$id)->first();
        return view('admin::settings.central_settings.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = CentralSettings::where('id',$id)->first();
        return view('admin::settings.central_settings.update',$data);
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
        $model = CentralSettings::findOrFail($id);
        $input = $request->all();
        //print_r($input);exit;

        // Transaction Start Here
        DB::beginTransaction();
        try {
            $model->update($input);
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('error', "Invalid Request" );
        }
        return redirect()->back();
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