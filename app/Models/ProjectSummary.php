<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectSummary extends Model
{
    use HasFactory;
    protected $table = 'table_projectsummary';
    public $timestamps = false;

    public function get_p_code($p_id)
    {
        $p_code = $this->where("p_id",$p_id)->pluck('p_code');
        return $p_code;
    }

    
}
