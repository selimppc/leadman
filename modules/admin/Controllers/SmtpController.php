<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:18 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Smtp;

class SmtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = " SMTP ";
        $data['smtp']= Smtp::all();
        return view('admin::smtp.index', $data);
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
        Smtp::create($request->except('_token'));
        Session::flash('message', 'SMTP has been successfully stored.');
        return redirect()->back();
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
        $data['smtp'] = Smtp::findOrFail($id);
        return view('admin::smtp.update', $data);
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
        $data=$request->all();
        $smtp=Smtp::findOrFail($id);
        $smtp->server_username= $data['server_username'];
        $smtp->server_password= $data['server_password'];
        $smtp->host= $data['host'];
        $smtp->port= $data['port'];
        $smtp->smtp= $data['smtp'];
        $smtp->c_port= $data['c_port'];
        $smtp->save();
        Session::flash('message', 'SMTP has been successfully updated.');
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
        $smtp=Smtp::findOrFail($id);
        $smtp->delete();
        Session::flash('message', 'SMTP has been successfully deleted.');
        return redirect()->back();
    }
}