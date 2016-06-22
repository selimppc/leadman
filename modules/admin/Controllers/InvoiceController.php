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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Admin\InvoiceDetail;
use Modules\Admin\InvoiceHead;
use Modules\Admin\PoppingEmail;
use App\User;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=false)
    {
        $data['pageTitle'] = "Invoice";
        $input=$request->all();

        $per_page=30;

        if(Session::get('role_title') == 'user') {
            $email=PoppingEmail::select('id')->where('user_id',Auth::id())->where('id',$id)->first();

            #print_r($email);exit;


            if(!empty($email)){
                $data['invoices']=$this->search($input,$per_page,$id);
            }else{
                return redirect()->back();
            }
        }else{
            $data['invoices']=$this->search($input,$per_page,$id);
            #print_r($data);exit;
        }
        if(isset($id))
        {
            $data['popping_email_id']=$id;
        }






        /*$request=$request->all();
        if(isset($request['email']))
        {
            $data['invoices']= $this->search($request);
        }else{
            if(!empty($id))
            {
                $data['invoices'] = InvoiceHead::orderBy('id', 'DESC')->with('relPoppingEmail')->where('popping_email_id',$id)->paginate(10);
            }else{
                $data['invoices'] = InvoiceHead::orderBy('id', 'DESC')->with('relPoppingEmail')->paginate(10);
            }
        }*/
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
        $data['invoice'] = InvoiceHead::where('id',$id)->with(['relPoppingEmail','relInvoiceDetail'=>function($query){
            $query->with('relLead');
        }])->first();
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }
    public function change_status($status,$id)
    {
        $model = InvoiceHead::findOrFail($id);
        $model->status=$status; // store / update / code here
        $model->save(); // store / update / code here

        Session::flash('message', 'Successfully updated status!');

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
        $invoice=InvoiceHead::findOrFail($id);
        $invoice->status='cancel';
        $invoice->save();
        Session::flash('message', "Invoice has been Successfully Deleted.");
        return redirect()->back();
    }
    public function search($data,$per_page,$id)
    {
        $query= InvoiceHead::with('relPoppingEmail');
        if(!empty($data['popping_email']))
        {
            $email=PoppingEmail::select('id')->where('email',$data['popping_email'])->first();
            if(!empty($email) && $email!=null){
                $query->where('popping_email_id',$email->id);
            }else{
                $query->where('popping_email_id',0);
            }
        }
        if(!empty($data['invoice_number'])){
            $query->where('invoice_number','like','%'.$data['invoice_number'].'%');
        }
        if(isset($data['status']) && $data['status']!='select'){
            $query->where('status',$data['status']);
        }
        if(!empty($id)){
            $query->where('popping_email_id',$id);
        }
        $query->where('status','!=','cancel');
        $result=$query->paginate($per_page);
        return (isset($result)?$result:false);

    }
}