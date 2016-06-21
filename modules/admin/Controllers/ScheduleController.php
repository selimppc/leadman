<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:19 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
use Modules\Admin\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = "Schedule";


        $data['schedules'] = Schedule::orderBy('id', 'DESC')->get();

        return view('admin::schedule.index',$data);
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
        DB::begintransaction();
        try {
            $values = $request->only('day');
            $values['time'] = $request['timee'];
            $unique_check = Schedule::where('day', $values['day'])->where('time', $values['time'])->first();
            if (!isset($unique_check)) {
                Schedule::create($values); // store / update / code here
                DB::commit();
                Session::flash('message', 'Successfully added!');
            } else {
                Session::flash('error', 'Sorry,This schedule is already exist.Please enter unique schedule.');
            }
        }catch (Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());

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
        $data = Schedule::findOrFail($id);
        $data->timee=$data->time;
        return view('admin::schedule.update', ['data'=>$data]);
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
        $model = Schedule::findOrFail($id);
        $input = $request->only('day');
        $input['time']=$request['timee'];
        $unique_check= Schedule::where('day',$input['day'])->where('time',$input['time'])->where('id','!=',$id)->first();
        if(!isset($unique_check)) {
            $model->fill($input)->save(); // store / update / code here

            Session::flash('message', 'Successfully updated!');
        }else{
            Session::flash('error', 'Sorry,This schedule is already exist.Please enter unique schedule.');
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
        DB::beginTransaction();
        try {
            Schedule::findOrFail($id)->delete();
            DB::commit();
            Session::flash('message', "Schedule Successfully Deleted.");
        }catch(\Exception $e) {
            DB::rollback();
            Session::flash('error',"Schedule already used");
        }
        return redirect()->back();
    }
}