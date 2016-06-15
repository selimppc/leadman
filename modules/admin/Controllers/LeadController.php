<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:22 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Admin\Lead;
use Modules\Admin\PoppingEmail;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input)
    {
        $per_page=10;
        $data['pageTitle'] = " Lead ";
        if(isset($input->email)){
            $per_page=10;
            if(!empty($input['email']) && $input['status'] =='select')
            {
                $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
                if(!empty($email)){
                    $result= Lead::where('popping_email_id',$email->id)->with('relPoppingEmail')->paginate($per_page);
                }
            }elseif(empty($input['email']) && $input['status'] !='select')
            {
                $result= Lead::where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
            }elseif(!empty($input['email']) && $input['status'] !='select')
            {
                $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
                if(!empty($email)){
                    $result= Lead::where('popping_email_id',$email->id)->where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
                }
            }else{
                $result= Lead::with('relPoppingEmail')->paginate($per_page);
            }
            $data['leads']=$result;
        }else{
            $data['leads']= Lead::with('relPoppingEmail')->paginate($per_page);
        }
        return view('admin::lead.index', $data);
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