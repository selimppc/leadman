<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:27 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
use Modules\Admin\Filter;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = "Filter";


        $data['filters'] = Filter::orderBy('id', 'DESC')->get();

        return view('admin::filter.index',$data);
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
            Filter::create($request->only('name', 'filtercol')); // store / update / code here
            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch (Exception $e)
        {
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
        $data = Filter::findOrFail($id);
        return view('admin::filter.update', ['data'=>$data]);
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
        DB::begintransaction();
        try {
            $model = Filter::findOrFail($id);

            $input = $request->only('name', 'filtercol');
            $model->fill($input)->save(); // store / update / code here

            DB::commit();
            Session::flash('message', 'Successfully updated!');
        }catch (Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());
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
        Filter::findOrFail($id)->delete();
        Session::flash('message', "Filter Successfully Deleted.");
        return redirect()->back();
    }
}