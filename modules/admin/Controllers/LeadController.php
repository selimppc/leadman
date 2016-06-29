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
                return view('admin::lead.archive_lead_details', $data);
            }else {
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
        }else{
            return redirect()->back();
        }

    }
}