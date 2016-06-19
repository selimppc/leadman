<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:16 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Imap;

class ImapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = " IMAP ";
        $data['imaps']= Imap::all();
        return view('admin::imap.index', $data);
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
        $input=$request->all();
        $mail_server = $input['host'];
        $mail_port = $input['port'];

        $host=Imap::where('host',$input['host'])->first();
        if(isset($host) && empty($host)) {
            try {
                $i = @fsockopen($mail_server, $mail_port, $errno, $errstr, 30);
                if ($i) {
                    DB::beginTransaction();
                    try {
                        Imap::create($input); // store / update / code here
                        DB::commit();
                        Session::flash('message', 'IMAP has been successfully stored.');
                    } catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                        DB::rollback();
                        Session::flash('error', "Invalid Request. Please Try Again");
                    }
                } else {
                    Session::flash('error', "Imap and/or port may be incorrect.");
                }
            } catch (\Exception $e) {
                Session::flash('error', $e->getMessage());
            }
        }else{
            Session::flash('error', 'Sorry,Host is already exist !');
        }
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
        $data['imap'] = Imap::findOrFail($id);
        return view('admin::imap.update', $data);
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

        $model = Imap::findOrFail($id);
        $input = $request->all();
        $mail_server = $input['host'];
        $mail_port = $input['port'];

        try{
            $i = @fsockopen($mail_server, $mail_port, $errno, $errstr, 30);
            if($i){
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    $model->fill($input)->save(); // store / update / code here

                    DB::commit();
                    Session::flash('message', 'IMAP has been successfully updated.');
                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('error', "Invalid To insert" );
                }
            }else{
                Session::flash('error', "Host or port might be worng." );
            }
        }catch(Exception $e){
            Session::flash('error', $e->getMessage());
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
        $imap=Imap::findOrFail($id);
        $imap->delete();
        Session::flash('message', 'IMAP has been successfully deleted.');
        return redirect()->back();
    }
}