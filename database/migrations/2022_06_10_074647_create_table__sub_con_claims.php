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
        Schema::create('table_sub_con_claims', function (Blueprint $table) {
            $table->id("sub_con_id");
            $table->string("p_code");
            $table->date("sub_con_date");
            $table->string("sub_con_invoice_no");
            $table->string("sub_description");
            $table->float("sub_con_amount")->default(0);
            $table->string("sub_con_uploadurl");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__sub_con_claims');
    }
};
