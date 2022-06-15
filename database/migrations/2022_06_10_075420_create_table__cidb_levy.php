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
        Schema::create('table_cidb_levy', function (Blueprint $table) {
            $table->id('cidb_id');
            $table->string("p_code");
            $table->date("cidb_date");
            $table->string("cidb_invoice_no");
            $table->float("cidb_amount")->default(0);
            $table->string("cidb_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__cidb_levy');
    }
};
