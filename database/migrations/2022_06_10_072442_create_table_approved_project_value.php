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
        Schema::create('table_approved_project_value', function (Blueprint $table) {
            $table->id("approved_id");
            $table->string("p_code");
            $table->date("approved_date");
            $table->string("approved_options")->default("");
            $table->float("approved_amount")->default(0);
            $table->string("approved_uploadurl")->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_approved_project_value');
    }
};
