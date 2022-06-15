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
        Schema::create('table_man_power', function (Blueprint $table) {
            $table->id("man_id");
            $table->date("man_date");
            $table->integer("man_workerid");
            $table->float("man_hours")->default(0);
            $table->string("p_code");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__man_power');
    }
};
