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
        $projects = ProjectSummary::groupby("p_code")->get();
        $workers = DB::table("table_worker")->get();
        return view("manpower_readonly",["Projects"=>$projects,"Workers"=>$workers,'Man_power' => $man_res]);
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
            
            default:
                # code...
                break;
        }
    }
}
