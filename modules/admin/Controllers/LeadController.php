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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use League\Flysystem\File;
use Modules\Admin\Lead;
use Modules\Admin\PoppingEmail;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input,$id=false)
    {
        $per_page=30;
        $data['pageTitle'] = " Lead ";
        if(Session::get('role_title') == 'user') {
            $email=PoppingEmail::select('id')->where('status','!=','cancel')->where('user_id',Auth::id())->where('id',$id)->first();
            if(!empty($email)){
                $data['leads']=$this->search($input,$per_page,$id);
            }else{
                return redirect()->back();
            }
        }else{
            $data['leads']=$this->search($input,$per_page,$id);
        }
        if(isset($id))
        {
            $data['popping_email_id']=$id;
        }
        return view('admin::lead.index', $data);
    }
    private static function search($data,$per_page,$id=false)
    {
        $query= Lead::with(['relPoppingEmail']);


        if(!empty($data['popping_email']))
        {
            $email=PoppingEmail::select('id')->where('status','!=','cancel')->where('email',$data['popping_email'])->first();
            if(!empty($email) && $email!=null){
                $query->where('popping_email_id',$email->id);
            }else{
                $query->where('popping_email_id',0);
            }
        }else{
            $emails=PoppingEmail::select('id')->where('status','!=','cancel')->get();

            if(count($emails)>=1) {
                $d=[];
                foreach ($emails as $email) {
                    $d[]=$email->id;
                }
                $query->whereIn('popping_email_id',$d);
            }else{
                $query->where('popping_email_id',0);
            }
        }
        if(!empty($data['lead_email'])){
            $query->where('email','like','%'.$data['lead_email'].'%');
        }
        /*if(isset($data['status']) && $data['status']!='select'){

            $query->where('status',$data['status']);
        }*/

        if(!empty($data['status'])){
            if($data['status']=='duplicate')
            {
                $query->where('count','>',1);
            }else{
                $query->where('status',$data['status']);
            }
        }
        if(!empty($id)){
            $query->where('popping_email_id',$id);
        }
        $result=$query->paginate($per_page);
        return $result;
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
    public function lead_archive(Request $request)
    {
        if(Session::has('archiveLead'))
        {
            return redirect('admin/lead-archive');
        }else {
            if ($request->isMethod('post')) {
                $leadPassword = Config::get('custom.lead-archive-password');
                $password = $request->only('password');
                if ($leadPassword == $password['password']) {
                    Session::put('archiveLead', true);
                    return redirect('admin/lead-archive');
                } else {
                    Session::flash('error', 'Sorry,Wrong Password !!!');
                }
            } else {
                Session::flash('leadArchive', 'yes');
            }
            return redirect('dashboard');
        }
    }
    public function archive_leads($file_name=false)
    {
        if(Session::has('archiveLead'))
        {
            if(isset($file_name) && !empty($file_name))
            {
                $data['pageTitle'] = 'Archive Lead Details for '.$file_name;
                $data['file_content']=file_get_contents(public_path('lead_files/'.$file_name));
                $data['file_name']= $file_name;

                return view('admin::lead.archive_lead_details', $data);
            }
            else
            {
                $data['pageTitle'] = 'Archive Leads';
                $data['archive_leads'] = scandir(public_path('lead_files'));
                if($data['archive_leads'][0]=='.')
                {
                    unset($data['archive_leads'][0]);
                }
                if($data['archive_leads'][1]=='..')
                {
                    unset($data['archive_leads'][1]);
                }
                if($data['archive_leads'][2]=='.gitignore')
                {
                    unset($data['archive_leads'][2]);
                }
                unset($data['archive_leads'][1]);
                return view('admin::lead.archive_leads', $data);
            }
        }
        else
        {
            return redirect()->back();
        }

    }

    /**
     * @param $file_name
     * @return mixed
     */
    public function get_download($file_name)
    {

        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/lead_files/".$file_name;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, $file_name, $headers);
    }

    /**
     * @param $invoice_no
     */
    public function get_lead_by_keyword_type($invoice_no)
    {
        $sql = "select pe.email, pe.password, count( DISTINCT lead.id ) no_of_lead
            from invoice_head as inv_hd
            LEFT JOIN invoice_detail as inv_dt on inv_dt.invoice_head_id = inv_hd.id 
            LEFT JOIN lead as lead on lead.id = inv_dt.id and lead.type = 'keyword'
            WHERE inv_hd.invoice_number = '$invoice_no'
            GROUP BY inv_hd.id ";
        $result = DB::select(DB::raw($sql));

        print_r($result);
        exit();



    }

    /**
     * @param $invoice_no
     */
    public function get_lead_without_keyword($invoice_no){

    }





    /**
     * @param $invoice_no
     * @param $array_data
     * @return bool
     */
    private function lead_to_txt($invoice_no, $array_data) {
        $invoice_no = $invoice_no;
        //file Path
        $path = public_path()."/lead_files/";

        //check permission from config
        $permissions = intval(config('permissions.directory'), 0);

        if (!File::Exists($path)) {
            //make folder with $path generate recursive with right 0775
            File::makeDirectory($path, $permissions, true);
        }

        //make data in string to store in txt file
        $string = '';
        foreach ($array_data as $val) {
            #$string .= $val['id']."-".$val['email']."\n";
            $string .= $val['email']."\n";
        }

        //create array of lead id
        $lead_ids = array();
        foreach ($array_data as $value) {
            $lead_ids[] = array(
                'id' => $value['id'],
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            $file_name = $path.$invoice_no.".txt";
            $handle    = fopen($file_name, 'w');
            $a         = fwrite($handle, $string);
            fclose($handle);

            /* data delete from Lead table by Lead_ID */
            #DB::table('lead')->whereIn('id', $lead_ids)->delete();

            //Commit the changes
            DB::commit();

            return true;

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            $this->info($e->getMessage());
            return false;
        }
    }

}