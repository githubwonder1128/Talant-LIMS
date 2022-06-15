<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_projectsummary', function (Blueprint $table) {
            $table->id('p_id');
            $table->string("p_code");
            $table->date("p_date");
            $table->string("p_name");
            $table->string("company_name");
            $table->integer("company_value")->default(1);
            $table->string("p_status")->default("active");
            $table->string("p_type")->default("Sub-con");
            $table->string("p_work")->default("Fbarication Only");
            $table->string("p_ic")->default("WYF");
            $table->string("include_materials")->default("YES");
            $table->date("date_startWork");
            $table->date("date_completion");
            $table->string("p_award")->default("Letter of Award");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_projectsummary');
    }
};
