<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:18 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Support\Facades\DB;
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

        // Get input data
        $input = $request->all();

        // TODO actually not todo as type has been identified by $input['domain']
        //$type = SenderEmail::EmailTypeIdentification($input['host'], 'type');

        // Prepare data
        try{
            $f = fsockopen($input['host'], $input['port'], $errno, $errstr, 30);
                //Smtp Validation only Cpanel Based :End

            if($f) {

                //Transaction Start Here
                DB::beginTransaction();

                $host=Smtp::where('host',$input['host'])->first();
//                dd($host);
                if(!isset($host)) {
                    try {
                        Smtp::create($input); // store / update / code here
                        DB::commit();
                        Session::flash('message', 'Successfully Added!');

                    } catch (\Exception $e) {
                        DB::rollback();
                        Session::flash('error', $e->getMessage());
                    }
                }else{
                    Session::flash('error', 'Sorry,Host is already exist !');

                }
            }
            fclose($f) ;
        }catch (\Exception $e){
            Session::flash('error', $e->getMessage() );
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
        $data['smtp_data'] = Smtp::findOrFail($id);
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

        $model = Smtp::findOrFail($id);
        // Get input data
        $input = $request->all();

        // TODO actually not todo as type has been identified by $input['domain']
        //$type = SenderEmail::EmailTypeIdentification($input['host'], 'type');

        // Prepare data
        try{
            $f = fsockopen($input['host'], $input['port'], $errno, $errstr, 30);
            //Smtp Validation only Cpanel Based :End

            if($f) {

                //Transaction Start Here
                DB::beginTransaction();
                try {
                    $model->fill($input); // store / update / code here
                    $model->save();
                    DB::commit();
                    Session::flash('message', 'Successfully Updated!');

                } catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', $e->getMessage());
                }
            }
            fclose($f) ;
        }catch (\Exception $e){
            Session::flash('error', $e->getMessage() );
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
        $smtp=Smtp::findOrFail($id);
        $smtp->delete();
        Session::flash('message', 'SMTP has been successfully deleted.');
        return redirect()->back();
    }
}