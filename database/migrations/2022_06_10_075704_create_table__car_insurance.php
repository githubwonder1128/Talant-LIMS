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
        Schema::create('table_car_insurance', function (Blueprint $table) {
            $table->id("insurance_id");
            $table->string("p_code");
            $table->date("insurance_date");
            $table->string("insurance_policy_no");
            $table->date("insurance_date_due");
            $table->float("insurance_amount")->default(0);
            $table->string("insurance_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__car_insurance');
    }
};
