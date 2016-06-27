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
    public function index(Request $request,$user_id=false)
    {

        $data['pageTitle'] = "Invoice";
        $input=$request->all();

        $per_page=30;

        if(Session::get('role_title') == 'user') {
            $email=PoppingEmail::select('id')->where('user_id',Auth::id())->where('user_id',$user_id)->first();

            #print_r($email);exit;


            if(!empty($email)){
                $data['invoices']=$this->search($input,$per_page,$user_id);
            }else{
                return redirect()->back();
            }
        }else{
            $data['invoices']=$this->search($input,$per_page,$user_id);
            #print_r($data);exit;
        }
        if(isset($user_id))
        {
            $data['user_id']=$user_id;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['invoice'] = InvoiceHead::where('id',$id)->with(['relUser','relInvoiceDetail'=>function($query){
            $query->with('relLead');
        }])->first();
        return view('admin::invoice.view',$data);
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
        InvoiceHead::findOrFail($id)->delete();
        Session::flash('message', "Invoice has been Successfully Deleted.");
        return redirect()->back();
    }
    public function search($data,$per_page,$id)
    {
        $query= InvoiceHead::with('relUser');
        if(!empty($data['user_name']))
        {
            $user=User::select('id')->where('username',$data['user_name'])->first();
            if(!empty($user) && $user!=null){
                $query->where('user_id',$user->id);
            }else{
                $query->where('user_id',0);
            }
        }
        if(!empty($data['invoice_number'])){
            $query->where('invoice_number','like','%'.$data['invoice_number'].'%');
        }
        if(isset($data['status']) && $data['status']!='select'){
            $query->where('status',$data['status']);
        }
        if(!empty($id)){
            $query->where('user_id',$id);
        }
        $query->where('status','!=','cancel');
        $result=$query->paginate($per_page);
        return (isset($result)?$result:false);

    }
}