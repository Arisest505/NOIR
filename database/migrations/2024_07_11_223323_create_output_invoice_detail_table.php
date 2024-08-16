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
        Schema::create('output_invoice_detail', function (Blueprint $table) {
            $table->increments('output_invoice_detail_id');
            $table->unsignedInteger('id_output_invoice');
            $table->foreign('id_output_invoice')->references('output_invoice_id')->on('output_invoice')->onDelete('cascade');
            $table->unsignedInteger('id_product');
            $table->foreign('id_product')->references('product_id')->on('product')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('output_invoice_detail');
    }
};
