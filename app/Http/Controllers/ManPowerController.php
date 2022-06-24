<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManPower;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectSummary;

class ManPowerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ManPower = new ManPower;
        $man_res = $ManPower->get_all();
        $projects = ProjectSummary::where('p_completion','!=','100%')->groupby("p_code")->get();
        $workers = DB::table("table_worker")->get();
        return view("manpower_readonly",["Projects"=>$projects,"Workers"=>$workers,'Man_power' => $man_res]);
    }

    public function fabricaion()
    {
        $ManPower = new ManPower;
        $man_res = $ManPower->get_all();
        $projects = ProjectSummary::where("f_completion","!=","100%")->orderby("p_code",'desc')->get();
        $workers = DB::table("table_worker")->get();
        return view("fabrication_readonly",["Projects"=>$projects,"Workers"=>$workers,'Man_power' => $man_res]);
    }

    public function response(Request $request,$method)
    {
        $ManPower = new ManPower;
        switch ($method) {
            case 'insert_worker':
                $insertdata = $request->data;
                $res = DB::table('table_worker')->insert($insertdata);
                return 'success';

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
            
            default:
                # code...
                break;
        }
    }
}
