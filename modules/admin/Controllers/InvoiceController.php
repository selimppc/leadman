<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/13/16
 * Time: 12:23 PM
 */

namespace Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Admin\InvoiceDetail;
use Modules\Admin\InvoiceHead;
use Modules\Admin\PoppingEmail;

class InvoiceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $user_id = false) {

		$data['pageTitle'] = "Invoice";
		$input             = $request->all();
		$per_page = 30;

		if (Session::get('role_title') == 'user') {
			$email = PoppingEmail::select('id')->where('user_id', Auth::id())->where('user_id', $user_id)->first();

			if (!empty($email)) {
				$data['invoices'] = $this->search($input, $per_page, $user_id);
			} else {
				return redirect()->back();
			}
		} else {
			$data['invoices'] = $this->search($input, $per_page, $user_id);

		}
		if (isset($user_id)) {
			$data['user_id'] = $user_id;
		}

		return view('admin::invoice.index', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$invoice_head = InvoiceHead::with('relUser')->findOrFail($id);

		//-- sql query
		$sql = "select inv_dt.created_at, count( DISTINCT inv_dt.lead_id ) as no_of_lead, sum( inv_c.unit_price ) as cost
				from invoice_detail as inv_dt
				left JOIN lead on lead.id = inv_dt.lead_id
				left JOIN invoice_detail as inv_c  on inv_c.id = inv_dt.id
				WHERE inv_dt.invoice_head_id = '$id'
				GROUP BY inv_dt.inv_date 
				";
		$date_wise = DB::select(DB::raw($sql));


		return view('admin::invoice.view', array(
			'invoice_head'=>$invoice_head,
			'date_wise'=>$date_wise,
		));
	}

	/**
	 * @param $status
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function change_status($status, $id) {
		$model         = InvoiceHead::findOrFail($id);
		$model->status = $status;// store / update / code here
		$model->save();// store / update / code here

		Session::flash('message', 'Successfully updated status!');

		return redirect()->back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		InvoiceDetail::where('invoice_head_id',$id)->delete();
		InvoiceHead::findOrFail($id)->delete();
		Session::flash('message', "Invoice has been Successfully Deleted.");
		return redirect()->back();
	}

	/**
	 * @param $data
	 * @param $per_page
	 * @param $id
	 * @return bool|\Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function search($data, $per_page, $id) {
		$query = InvoiceHead::with('relUser');
		if (!empty($data['user_name'])) {
			$user = User::select('id')->where('username', $data['user_name'])->first();
			if (!empty($user) && $user != null) {
				$query->where('user_id', $user->id);
			} else {
				$query->where('user_id', 0);
			}
		}
		if (!empty($data['invoice_number'])) {
			$query->where('invoice_number', 'like', '%'.$data['invoice_number'].'%');
		}
		if (isset($data['status']) && $data['status'] != 'select') {
			$query->where('status', $data['status']);
		}
		if (!empty($id)) {
			$query->where('user_id', $id);
		}
		$query->where('status', '!=', 'cancel');
		$result = $query->paginate($per_page);
		return (isset($result)?$result:false);

	}
	public function user_invoices($user_id)
    {
        $data['pageTitle']='User Active Invoices';
        #$data['invoices']= InvoiceHead::with(['relPoppingEmail','relInvoiceDetail'])->where('user_id',$user_id)->where('status','open')->orWhere('status','approved')->get();
        /*$invoices=DB::table('invoice_head as ih');
        $invoices=$invoices->select('ih.invoice_number','ih.total_cost','ih.status','pe.email','pe.price',DB::raw('count("ind.id") as total_lead'));
        $invoices=$invoices->leftJoin('popping_email as pe','ih.popping_email_id','=','pe.id');
        $invoices=$invoices->leftJoin('invoice_detail as ind','ih.id','=','ind.invoice_head_id');
        $invoices=$invoices->where('ih.status','=','open');
        $invoices=$invoices->orWhere('ih.status','=','approved');
        $invoices=$invoices->groupBy('ih.id');
        $data['invoices']=$invoices->get();*/

		$invoices=DB::table('invoice_detail as ind');
		$invoices=$invoices->select('ih.invoice_number','ih.total_cost','ih.status','pe.email','pe.price',DB::raw('count("ind.id") as total_lead'));
		$invoices=$invoices->leftJoin('popping_email as pe','ind.popping_email_id','=','pe.id');
		$invoices=$invoices->leftJoin('invoice_head as ih','ih.id','=','ind.invoice_head_id');
		$invoices=$invoices->where('ih.status','=','open');
		$invoices=$invoices->where('ih.user_id','=',$user_id);
		$invoices=$invoices->orWhere('ih.status','=','approved');
		$invoices=$invoices->groupBy('ih.id');
		$data['invoices']=$invoices->get();
        return view('admin::invoice.user_invoices',$data);
    }





}