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
        Schema::create('table_invoice_billed', function (Blueprint $table) {
            $table->id("invoice_id");
            $table->string("p_code");
            $table->date("invoice_date");
            $table->string("invoice_no");
            $table->float("invoice_amount")->default(0);
            $table->string("invoice_uploadurl");
            $table->date("invoice_payment_date");
            $table->string("invoice_folio");
            $table->float("invoice_payment_made")->default(0);
            $table->string("invoice_payment_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__invoice_billed');
    }
};
