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
        Schema::create('table_approved_vo_value', function (Blueprint $table) {
            $table->id("vo_id");
            $table->string("p_code");
            $table->date("vo_date");
            $table->string("vo_options");
            $table->float("vo_amount")->default(0);
            $table->string("vo_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_approved_vo_value');
    }
};
