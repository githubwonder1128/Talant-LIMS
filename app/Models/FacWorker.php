<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class FacWorker extends Model
{
    use HasFactory;

    protected $table = "table_facworker";

    public $timestamps = false;

    public function get_reports($year = 0,$month = 0,$date = 0)
    {   
        if ($date != 0) {
            $res = DB::table("table_report")
                ->join("table_facworker","table_report.report_worker","=","table_facworker.fac_id")
                ->where("table_report.report_date",$date)
                ->orderBy("table_facworker.fac_workername")
                ->get();
        }else{
            $res = DB::table("table_report")
                    ->join("table_facworker","table_report.report_worker","=","table_facworker.fac_id")
                    ->whereYear("table_report.report_date",$year)
                    ->whereMonth("table_report.report_date",$month)
                    ->get();
        }
        
        return $res;
    }
}
