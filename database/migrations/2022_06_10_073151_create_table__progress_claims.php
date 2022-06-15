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
        Schema::create('table_progress_claims', function (Blueprint $table) {
            $table->id("progress_id");
            $table->string("p_code");
            $table->date("progress_date");
            $table->string("progress_Ref");
            $table->float("progress_contract_value")->default(0);
            $table->float("progress_vo_value")->default(0);
            $table->float("progress_gross_work_done")->default(0);
            $table->float("progress_vo_done")->default(0);
            $table->float("progress_less_retention")->default(0);
            $table->float("progress_less_payment")->default(0);
            $table->string("progress_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__progress_claims');
    }
};
