<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ManPower extends Model
{
    use HasFactory;
    protected $table = "table_man_power";

    public $timestamps = false;


    public function get_total($p_code,$type)
    {
        if ($type) {
            $res = $this->selectRaw("SUM(man_hours) as worker_rate,SUM(worker_rate*man_hours) as total_man_cost")
                        ->join("table_worker","worker_id",'=','man_workerid')
                        ->where("p_code",$p_code)
                        ->get();
            $res = $res[0];
        }
        return $res;
    }

    public function get_all()
    {
        $res = DB::SELECT("SELECT * FROM table_man_power A
        LEFT JOIN table_worker B ON A.man_workerid = B.worker_id
        LEFT JOIN (SELECT p_code,p_name,company_name,p_date FROM table_projectsummary GROUP BY p_code) C ON A.p_code = C.p_code ORDER BY A.man_date DESC");
        return $res;
    }
}
