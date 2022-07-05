<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManPower;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectSummary;
use App\Models\FacWorker;

class ManPowerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function worker()
    {
        $ManPower = new ManPower;
        $man_res = $ManPower->get_all();
        $projects = ProjectSummary::where('p_completion','!=','100%')->groupby("p_code")->get();
        $workers = DB::table("table_worker")->get();
        return view("readonly.manpower_readonly",["Projects"=>$projects,"Workers"=>$workers,'Man_power' => $man_res]);
    }

    public function fabricaion()
    {
        $ManPower = new ManPower;
        $man_res = $ManPower->get_all();
        $projects = ProjectSummary::where("f_completion","!=","100%")->orderby("p_code",'desc')->get();
        $workers = DB::table("table_worker")->get();
        return view("readonly.fabrication_readonly",["Projects"=>$projects,"Workers"=>$workers,'Man_power' => $man_res]);
    }

    public function facworker($view_name)
    {
        $FacWorker = new FacWorker;

        switch($view_name)
        {
            case 'home':
                $facworkers = FacWorker::where('fac_active',"YES")->get();
                return view("readonly.facworker.facworker_readonly",['facworkers' => $facworkers]);
            case 'saverecords':
                $reports = $FacWorker->get_reports(0,0,date("Y-m-d"));
                return view("readonly.facworker.facworker_record",["reports"=>$reports]);
            case 'report':
                $reports = $FacWorker->get_reports(date("Y"),date("m"),0);
                $facworkers = FacWorker::get();
                return view("readonly.facworker.facworker_report",["reports"=>$reports,"facworkers"=>$facworkers]);
        }
        
    }

    public function material($view_name)
    {
        switch($view_name){
            case 'addmaterial':
                $records = DB::table("table_material")->get();
                return view("readonly.material.addmaterial",['material' => $records]);
            case 'records':
                $projects = ProjectSummary::orderby("p_code","desc")->get();
                $material = DB::table("table_material")->get();
                return view("readonly.material.records",['material' => $material,'projects'=>$projects]);
            case 'reports':
                $projects = ProjectSummary::orderby("p_code","desc")->get();
                $material = DB::table("table_material")->get();
                $reports = DB::SELECT("SELECT A.material_recordid,C.mat_id, A.material_recorddate,B.p_code,B.p_name,C.mat_type,A.material_recordnote,A.material_recordquantity FROM table_materialrecords A
                LEFT JOIN table_projectsummary B ON A.p_code = B.p_code
                LEFT JOIN table_material C ON A.material_recordtype = C.mat_id ORDER BY A.material_recorddate DESC");
                return view("readonly.material.reports",['reports'=>$reports,"projects"=>$projects, "material"=>$material]);

        }
    }

    public function response(Request $request,$method)
    {
        $ManPower = new ManPower;
        $FacWorker = new FacWorker;

        switch ($method) {
            case 'insert_worker':
                $insertdata = $request->data;
                $res = DB::table('table_worker')->insert($insertdata);
                return 'success';
            case 'insert_facworker':
                $insertdata = $request->data;
                $res = DB::table('table_facworker')->insertGetId($insertdata);
                return $res;

            case "save_man":
                $insertdata = $request->insert_data;
                $p_code = $request->p_code;
                $p_completion = $request->p_completion;
                $flag_supervisor = $request->flag_supervisor;
                if ($flag_supervisor == 1) {
                    $up = DB::table('table_projectsummary')
                                ->where("p_code",$p_code)
                                ->update([
                                    'p_completion' => $p_completion,
                                    'p_completion_date' => $insertdata['man_date']
                                ]);
                    $in = DB::table("table_p_completion")
                                ->insert([
                                    'p_code'=>$p_code,
                                    'p_completion_date'=>$insertdata['man_date'],
                                    'p_completion' => $p_completion
                                ]);
                }
                $res  = ManPower::insert($insertdata);
                return $res;
            case 'edit':
                $editType = $request->editType;
                $editData = $request->editData;
                $present_Id = $request->present_Id;
                switch ($editType) {
                    case 'update':
                        $res = ManPower::where("man_id",$present_Id)->update($editData);
                        break;
                    case 'delete':
                        $res = ManPower::where("man_id",$present_Id)->delete();
                        break;
                }
                return 'ok';
            case 'editfacworker':
                $editType = $request->editType;
                $editData = $request->editData;
                $present_Id = $request->present_Id;
                switch ($editType) {
                    case 'update':
                        $res = FacWorker::where("fac_id",$present_Id)->update($editData);
                        break;
                    case 'delete':
                        $res = FacWorker::where("fac_id",$present_Id)->delete();
                        break;
                }
                return 'ok';
            case 'editworker':
                $editType = $request->editType;
                $editData = $request->editData;
                $present_Id = $request->present_Id;
                switch ($editType) {
                    case 'update':
                        $res = DB::table('table_worker')->where("worker_id",$present_Id)->update($editData);
                        break;
                    case 'delete':
                        $res = DB::table('table_worker')->where("worker_id",$present_Id)->delete();
                        break;
                }
                return 'ok';
            case 'getmans':
                $man_res = $ManPower->get_all();
                return $man_res;
            case 'getfacs':
                $facworkers = FacWorker::get();
                return $facworkers;
            case 'getworkers':
                $worker_res = DB::table("table_worker")->get();
                return $worker_res;
            case 'getvisor':
                $p_code = $request->p_code;
                $worker_id = $request->worker_id;
                $supervisor = DB::table('table_worker')
                                    ->where('worker_id',$worker_id)
                                    ->pluck('worker_supervisor');
                $p_completion = DB::table("table_projectsummary")->where("p_code",$p_code)
                                        ->pluck('p_completion');
                return ['supervisor'=> $supervisor,'p_completion'=> $p_completion];
            
            case 'savefcompletion':
                $p_code = $request->p_code;
                $f_completion = $request->f_completion;
                $f_date = $request->f_date;
                $up = DB::table('table_projectsummary')
                            ->where('p_code',$p_code)
                            ->update([
                                'f_completion'=>$f_completion,
                                'f_completion_date'=>$f_date
                            ]);
                $in = DB::table("table_fabrication")
                            ->insert([
                                'p_code'=>$p_code,
                                'fab_date'=>$f_date,
                                'fab_completion' => $f_completion
                            ]);
                return $up;
            case 'savereport':
                $saveData = $request->saveData;
                for ($i=0; $i < count($saveData); $i++) { 
                    $report_worker = $saveData[$i]['report_worker'];
                    $report_date = $saveData[$i]['report_date'];
                    $report_hour = $saveData[$i]['report_hour'];
                    $cnt = DB::table("table_report")
                                ->where("report_worker",$report_worker)
                                ->where("report_date",$report_date)
                                ->count();
                    if ($cnt != 0) {
                        $up = DB::table("table_report")
                                ->where("report_worker",$report_worker)
                                ->where("report_date",$report_date)
                                ->update([
                                    'report_hour' => $report_hour
                                ]);
                    }else{
                        $in = DB::table("table_report")
                                    ->insert($saveData[$i]);
                    }
                }
                return "ok";
            case 'get_records':
                $date = $request->date;
                $reports = $FacWorker->get_reports(0,0,$date);
                return $reports;
            case 'get_reports':
                $year = $request->year;
                $month = $request->month;
                $reports = $FacWorker->get_reports($year,$month,0);
                $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
                $workers = DB::table("table_worker")->get();
                return [$reports,$days,$workers];
            case 'updatereport':
                $report_id = $request->report_id;
                $report_hour = $request->report_hour;

                $up = DB::table("table_report")
                            ->where("report_id",$report_id)
                            ->update([
                                'report_hour'=>$report_hour
                            ]);
                return $up;
            case 'getfacworkers':
                $facworkers = FacWorker::get();
                return $facworkers;
            case 'addmaterial':
                $material_type = $request->material_type;
                $cnt = DB::table("table_material")->where("mat_type",$material_type)->count();
                $in = 0;
                if ($cnt == 0) {
                    $in = DB::table("table_material")->insertGetId(['mat_type' => $material_type]); 
                }
                return $in;
            case 'editmaterial':
                $presentId = $request->presentId;
                $data = $request->data;
                $type = $request->type;
                switch($type){
                    case 'update':
                        $up = DB::table("table_material")
                                    ->where("mat_id",$presentId)
                                    ->update([
                                        'mat_type'=>$data
                                    ]);
                        break;
                    case 'delete':
                        $del = DB::table("table_material")
                                    ->where("mat_id",$presentId)
                                    ->delete();
                        break;
                }
                return 'ok';
            case 'savematerialrecord':
                $insertData = $request->total;
                $in = DB::table("table_materialrecords")
                            ->insert($insertData);
                return 'ok';

            case "editrecord":
                $editType = $request->editType;
                $record_id = $request->record_id;
                $editData = $request->editData;
                switch ($editType) {
                    case 'update':
                        $up = DB::table("table_report")
                                    ->where("report_id",$record_id)
                                    ->update($editData);
                        $name = DB::table("table_facworker")
                                        ->where("fac_id",$editData['report_worker'])
                                        ->pluck("fac_workername");
                        return $name;
                    case "delete":
                        $del =  DB::table("table_report")
                                    ->where("report_id",$record_id)
                                    ->delete();
                }
                return "ok";
            case "editmaterialrecord":
                $editType = $request->editType;
                $record_id = $request->record_id;
                $editData = $request->editData;
                switch ($editType) {
                    case 'update':
                        $up = DB::table("table_materialrecords")
                                    ->where("material_recordid",$record_id)
                                    ->update($editData);
                        $name = DB::table("table_material")
                                        ->where("mat_id",$editData['material_recordtype'])
                                        ->pluck("mat_type");
                        return $name;
                    case "delete":
                        $del =  DB::table("table_materialrecords")
                                    ->where("material_recordid",$record_id)
                                    ->delete();
                }
                return "ok";
            default:
                # code...
                break;
        }
    }
}
