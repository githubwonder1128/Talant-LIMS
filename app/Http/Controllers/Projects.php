<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectSummary;
use App\Models\ProgressClaims;
use App\Models\ManPower;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Projects extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($viewname)
    {
        
        $ManPower = new ManPower;
        switch ($viewname) {
            case 'home':
                $res = ProjectSummary::get();
                $total = DB::select("SELECT SUM(B.approved_amount) + SUM(vo_amount) - D.total_work_done AS active_p_value,SUM(B.approved_amount) + SUM(vo_amount) - E.collections AS active_collections,A.p_code FROM (SELECT * FROM table_projectsummary WHERE p_status = 'active' GROUP BY p_code) A
                LEFT JOIN (SELECT SUM(approved_amount) AS approved_amount,p_code FROM table_approved_project_value GROUP BY p_code) B ON A.p_code = B.p_code
                LEFT JOIN (SELECT SUM(vo_amount) AS vo_amount,p_code FROM table_approved_vo_value GROUP BY p_code) C ON A.p_code = C.p_code
                LEFT JOIN (SELECT SUM(progress_gross_work_done) + SUM(progress_vo_done) AS total_work_done,p_code FROM table_progress_claims GROUP BY p_code) D ON A.p_code = D.p_code
                LEFT JOIN (SELECT  SUM(invoice_payment_made) AS collections,p_code FROM table_invoice_billed GROUP BY p_code) E ON A.p_code = E.p_code
                GROUP BY A.p_code");
                $totalpvalue = 0;
                $totalcollection = 0;
                for ($i=0; $i < count($total); $i++) { 
                    $totalpvalue += $total[$i]->active_p_value;
                    $totalcollection += $total[$i]->active_collections;
                }
                return view('home',["Projects" => $res,"Total"=>[$totalpvalue,$totalcollection]]);
            case 'details':
                $res = ProjectSummary::get();
                return view('details',["Projects" => $res]);
            case 'download':
                $filename = $viewname;

                return Storage::download('files/'.$filename);
            case 'manpower':
                $man_res = $ManPower->get_all();
                $workers = DB::table("table_worker")->get();
                $Projects = ProjectSummary::groupby("p_code")->get();
                return view('manpower',['Man_power'=>$man_res,"Worker"=>$workers,"Projects"=>$Projects]);
            case 'drawing':
                $projects = ProjectSummary::groupby("p_code")->get();
                $drawings = DB::table("table_drawing")->get();
                return view("drawing",["Projects" => $projects,"Drawing"=>$drawings]);
            case 'gallery':
                $projects = ProjectSummary::groupby("p_code")->get();
                $gallery = DB::table("table_projectphoto")->get();
                return view("gallery",["Projects" => $projects,"Gallery"=>$gallery]);
            case 'project_progress':
                $p_completion = [];
                $f_completion = [];
                $res = ProjectSummary::where("f_completion","!=",'100%')->orderby('p_code','desc')->get();
                $complete = ProjectSummary::where("f_completion","=","100%")->orderby('p_code','desc')->get();
                return view('project_progress',['Projects'=>$res,"Complete"=>$complete]);
            case 'report':
                $res = ProjectSummary::get();
                $approved_project = DB::table("table_approved_project_value")
                                        ->selectRaw("SUM(approved_amount) AS approved_amount,approved_date")
                                        ->whereYear("approved_date",date("Y"))
                                        ->whereMonth("approved_date",date("m"))
                                        ->groupBy("approved_date")
                                        ->get();
                $approved_vo = DB::table("table_approved_vo_value")
                                    ->selectRaw("SUM(vo_amount) AS vo_amount,vo_date")
                                    ->whereYear("vo_date",date("Y"))
                                    ->whereMonth("vo_date",date("m"))
                                    ->groupBy("vo_date")
                                    ->get();
                return view('report',['Projects'=>$res,'Approved_value'=>$approved_project,"Approved_vo"=>$approved_vo]);
            
            default:
                $res = ProjectSummary::get();
                return view('home',["Projects" => $res]);
        }
    }

    public function response(Request $request,$method)
    {
        $ProjectSummary = new ProjectSummary;
        switch ($method) {
            case 'get_detail_total':
                $p_id = $request->p_id;
                $p_code =  $ProjectSummary->get_p_code($p_id);
                return $this->get_total($p_code);
            case 'get_detail':
                $p_id = $request->p_id;
                $p_code = $ProjectSummary->get_p_code($p_id);
                return $this->get_detail($p_code);
            case 'edit':
                $editType = $request->editType;
                $data = $request->data;
                $summary_Id = $request->summary_id;
                $present_table = $request->present_table;
                return $this->edit_project($editType,$data,$summary_Id,$present_table);
            case 'upload':
                return $this->uploadfile($request);
            case 'uploaddrawing':
                $uploadedFile = $request->file('file');
                $option = $request->option;
                $filename = time().$uploadedFile->getClientOriginalName();
                Storage::disk('local')->putFileAs(
                    'files/',
                    $uploadedFile,
                    $filename
                );

                $res = DB::table("table_drawing")
                                    ->insert([
                                        "p_code"=>$option,
                                        "drawing_uploadurl"=>$filename
                                    ]);
                return $filename;
            case 'uploadgallery':
                    $uploadedFile = $request->file('file');
                    $option = $request->option;
                    $filename = time().$uploadedFile->getClientOriginalName();
                    Storage::disk('local')->putFileAs(
                        'files/',
                        $uploadedFile,
                        $filename
                    );
    
                    $res = DB::table("table_projectphoto")
                                        ->insert([
                                            "p_code"=>$option,
                                            "photo_uploadurl"=>$filename
                                        ]);
                    return $filename;
            
            case 'getdrawing':
                $p_code = $request->p_code;
                $drawings = DB::table("table_drawing")
                                ->where("p_code",$p_code)
                                ->get();
                return $drawings;
            case 'getgallery':
                $p_code = $request->p_code;
                $drawings = DB::table("table_projectphoto")
                                ->where("p_code",$p_code)
                                ->get();
                return $drawings;
            case 'deletedrawing':
                $Id = $request->id;
                $del = DB::table("table_drawing")->where("drawing_id",$Id)->delete();
                return $del;
            case 'deletegallery':
                $Id = $request->id;
                $del = DB::table("table_projectphoto")->where("photo_id",$Id)->delete();
                return $del;
            case 'get_all_datas':
                break;
            case 'get_chart_data':
                $year = $request->year;
                $month = $request->month;
                $approved_project = DB::table("table_approved_project_value")
                                        ->selectRaw("SUM(approved_amount) AS approved_amount,approved_date")
                                        ->whereYear("approved_date",$year)
                                        ->whereMonth("approved_date",$month)
                                        ->groupBy("approved_date")
                                        ->get();
                $approved_vo = DB::table("table_approved_vo_value")
                                    ->selectRaw("SUM(vo_amount) AS vo_amount,vo_date")
                                    ->whereYear("vo_date",$year)
                                    ->whereMonth("vo_date",$month)
                                    ->groupBy("vo_date")
                                    ->get();
                return [$approved_project,$approved_vo];
            

            default:
                # code...
                break;
        }
    }

    public function get_total($p_code,$key_val = "p_code")
    {
        // $type 1 => total,0=>individual
        $ProgressClaims = new ProgressClaims;
        $ManPower = new ManPower;
        
        $result = [];
        $tables = [
            'table_approved_project_value'=>['approved_amount'],
            'table_approved_vo_value'=>['vo_amount'],
            // 'table_progress_claims'=>['progress_amount'],
            'table_payment_certificate'=>['payment_amount'],
            'table_invoice_billed'=>['invoice_amount','invoice_payment_made'],
            'table_sub_con_claims'=>['sub_con_amount'],
            'table_cidb_levy'=>['cidb_amount'],
            'table_car_insurance'=>['insurance_amount']
        ];
        foreach ($tables as $key => $value) {
            for ($i=0; $i < count($tables[$key]); $i++) { 
                if ($key_val == "p_status") {
                    $res = DB::table($key)
                            ->sum($tables[$key][$i]);
                }else{
                    $res = DB::table($key)
                            ->where($key_val,$p_code)
                            ->sum($tables[$key][$i]);
                }
                
                $result[$tables[$key][$i]] = $res;
            }
            
        }

        $progress = $ProgressClaims->get_total($p_code,$key_val);
        $result['progress'] = $progress;

        $manpower = $ManPower->get_total($p_code,1);
        $result['manpower'] = $manpower;

        $remarks = DB::table("table_remarks")
                        ->where("p_code",$p_code)
                        ->pluck("remark_content");
        $result['remarks'] = $remarks;

        return $result;
    }

    public function get_detail($p_code)
    {
        $ProgressClaims = new ProgressClaims;
        $ManPower = new ManPower;
        
        $result = [];
        $tables = [
            'table_approved_project_value'=>['approved_amount'],
            'table_approved_vo_value'=>['vo_amount'],
            'table_progress_claims'=>['progress_amount'],
            'table_payment_certificate'=>['payment_amount'],
            'table_invoice_billed'=>['invoice_amount','invoice_payment_made'],
            'table_sub_con_claims'=>['sub_con_amount'],
            'table_cidb_levy'=>['cidb_amount'],
            'table_car_insurance'=>['insurance_amount'],
            'table_remarks'=>['remark_content']
        ];

        foreach ($tables as $key => $value) {
            $res = DB::table($key)
                        ->where("p_code",$p_code)
                        ->get();
            $result[$key] = $res;
        }
        return $result;
    }

    public function edit_project($editType,$data,$summary_Id,$present_table)
    {
        $ProjectSummary = new ProjectSummary;
        $identify = [
            'table_projectsummary'=>'p_id',
            'table_approved_project_value'=>'approved_id',
            'table_approved_vo_value'=>"vo_id",
            'table_progress_claims'=>"progress_id",
            'table_payment_certificate'=>"payment_id",
            'table_invoice_billed' => "invoice_id",
            'table_sub_con_claims'=>"sub_con_id",
            'table_cidb_levy'=>"cidb_id",
            'table_car_insurance' => "insurance_id",
            'table_remarks'=>"remark_id"
        ];
        switch ($editType) {
            case 'insert':
                $res = DB::table($present_table)->insertGetId($data);
                return $res;
            case 'update':
                $res = DB::table($present_table)->where($identify[$present_table],$summary_Id)
                                    ->update($data);
                return 0;
            case 'delete':
                $res = DB::table($present_table)->where($identify[$present_table],$summary_Id)
                                    ->delete();
                return 0;
        }
        return;
    }

    public function uploadfile($request)
    {

        $identify = [
            'table_projectsummary'=>['id' => 'p_id','uploadbtn'=>''],
            'table_approved_project_value'=>['id' =>'approved_id','uploadbtn'=>'approved_uploadurl'],
            'table_approved_vo_value'=>['id'=>"vo_id",'uploadbtn'=>'vo_uploadurl'],
            'table_progress_claims'=>['id'=>"progress_id",'uploadbtn'=>'progress_uploadurl'],
            'table_payment_certificate'=>['id'=>"payment_id",'uploadbtn'=>'payment_uploadurl'],
            'table_sub_con_claims'=>["id"=>"sub_con_id",'uploadbtn'=>'sub_con_uploadurl'],
            'table_cidb_levy'=>["id"=>"cidb_id","uploadbtn"=>"cidb_uploadurl"],
            'table_car_insurance' => ["id"=>"insurance_id","uploadbtn"=>"insurance_uploadurl"],
            'table_invoice_billed'=>["id"=>"invoice_id","uploadbtn_invoice"=>"invoice_uploadurl","uploadbtn_invoice_payment"=>"invoice_payment_uploadurl"]
        ];
        $uploadedFile = $request->file('file');
        $option = $request->option;
        $arr_tmp = explode("-",$option);
        $tablename = $arr_tmp[0];
        $id = $arr_tmp[2];
        $attr = $arr_tmp[1];
        $filename = time().$uploadedFile->getClientOriginalName();
        
        // move_uploaded_file($uploadedFile, '/public/uploads/' . $filename);
        Storage::disk('local')->putFileAs(
          'files/',
          $uploadedFile,
          $filename
        );
        // $uploadedFile->move("/upload",$filename);

        $res = DB::table($tablename)->where($identify[$tablename]['id'],$id)
                                    ->update([$identify[$tablename][$attr]=> $filename]);
        return $filename;

    }

    
    

    public function get_all_datas($present_table)
    {
       
    }
}
