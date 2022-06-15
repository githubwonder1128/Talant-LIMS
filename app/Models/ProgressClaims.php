<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressClaims extends Model
{
    use HasFactory;
    protected $table = "table_progress_claims";

    public function get_total($p_code,$key)
    {
        $res = $this->selectRaw("SUM(progress_vo_done) + SUM(progress_gross_work_done) as total_work_done,SUM(progress_less_retention) as retention,SUM(progress_gross_work_done)+SUM(progress_vo_done)-SUM(progress_less_retention)-SUM(progress_less_payment) as amount_due_to_claim")
                    ->where($key,$p_code)
                    ->get();
        $res = $res[0];
    
        return $res;
    }
}
