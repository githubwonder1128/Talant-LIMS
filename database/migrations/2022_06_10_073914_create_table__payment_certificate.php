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
        Schema::create('table_payment_certificate', function (Blueprint $table) {
            $table->id("payment_id");
            $table->string("p_code");
            $table->date("payment_date");
            $table->string("payment_certificate");
            $table->float("payment_amount")->default(0);
            $table->string("payment_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__payment_certificate');
    }
};
