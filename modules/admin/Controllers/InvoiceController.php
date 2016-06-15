<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:23 PM
 */

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Admin\InvoiceDetail;
use Modules\Admin\InvoiceHead;
use Modules\Admin\PoppingEmail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['pageTitle'] = "Invoice";
        $request=$request->all();
        if(isset($request['email']))
        {
            $data['invoices']= $this->search($request);
        }else{
            $data['invoices'] = InvoiceHead::orderBy('id', 'DESC')->with('relPoppingEmail')->paginate(10);
        }
        return view('admin::invoice.index',$data);
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
        $data['invoice'] = InvoiceHead::where('id',$id)->with('relPoppingEmail','relInvoiceDetail')->first();
        return view('admin::invoice.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['invoice'] = InvoiceHead::findOrFail($id);
        return view('admin::invoice.change_status',$data);
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
        $model = InvoiceHead::findOrFail($id);

        $input = $request->only('status');
        $model->fill($input)->save(); // store / update / code here

        Session::flash('message', 'Successfully updated!');

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
        InvoiceDetail::where('invoice_head_id',$id)->delete();
        InvoiceHead::findOrFail($id)->delete();
        Session::flash('message', "Invoice has been Successfully Deleted.");
        return redirect()->back();
    }
    public function search($input)
    {
        $per_page=10;
        if(!empty($input['email']) && empty($input['invoice_number']) && $input['status'] =='select')
        {
            $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
            if(!empty($email)){
                $result= InvoiceHead::where('popping_email_id',$email->id)->with('relPoppingEmail')->paginate($per_page);
            }
        }elseif(empty($input['email']) && !empty($input['invoice_number']) && $input['status'] =='select')
        {
            $result= InvoiceHead::where('invoice_number','like','%'.$input['invoice_number'].'%')->with('relPoppingEmail')->paginate($per_page);
        }elseif(empty($input['email']) && empty($input['invoice_number']) && $input['status'] !='select')
        {
            $result= InvoiceHead::where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
        }elseif(!empty($input['email']) && !empty($input['invoice_number']) && $input['status'] =='select')
        {
            $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
            if(!empty($email)) {
                $result = InvoiceHead::where('popping_email_id', $email->id)->where('invoice_number', 'like', '%' . $input['invoice_number'] . '%')->with('relPoppingEmail')->paginate($per_page);
            }
        }elseif(!empty($input['email']) && empty($input['invoice_number']) && $input['status'] !='select')
        {
            $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
            if(!empty($email)) {
                $result = InvoiceHead::where('popping_email_id', $email->id)->where('status', $input['status'])->with('relPoppingEmail')->paginate($per_page);
            }
        }elseif(empty($input['email']) && !empty($input['invoice_number']) && $input['status'] !='select')
        {
            $result= InvoiceHead::where('invoice_number', 'like', '%' . $input['invoice_number'] . '%')->where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
        }elseif(!empty($input['email']) && !empty($input['invoice_number']) && $input['status'] !='select')
        {
            $email=PoppingEmail::select('id')->where('email',$input['email'])->first();
            if(!empty($email)) {
                $result= InvoiceHead::where('popping_email_id', $email->id)->where('invoice_number', 'like', '%' . $input['invoice_number'] . '%')->where('status',$input['status'])->with('relPoppingEmail')->paginate($per_page);
            }
        }elseif(empty($input['email']) && empty($input['invoice_number']) && $input['status'] =='select')
        {
            $result= $data['invoices'] = InvoiceHead::orderBy('id', 'DESC')->with('relPoppingEmail')->paginate(10);
        }

        return (isset($result)?$result:false);
    }
}