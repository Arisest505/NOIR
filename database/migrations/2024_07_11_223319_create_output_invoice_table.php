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
        Schema::create('output_invoice', function (Blueprint $table) {
            $table->increments('output_invoice_id');
            $table->timestamp('date')->useCurrent();
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('user_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_warehouse');
            $table->foreign('id_warehouse')->references('warehouse_id')->on('warehouse')->onDelete('cascade');
            $table->string('for_usage', 255);
            $table->unsignedInteger('id_request');
            $table->foreign('id_request')->references('id_request')->on('request')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('output_invoice');
    }
};
