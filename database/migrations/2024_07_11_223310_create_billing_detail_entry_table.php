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
        Schema::create('billing_detail_entry', function (Blueprint $table) {
            $table->id('id_billing_detail');
            $table->unsignedBigInteger('id_billing');
            $table->unsignedInteger('id_product_detail');
            $table->double('quantity_detail');
            $table->double('unit_price_detail');
            $table->double('subtotal_detail');
            $table->foreign('id_billing')->references('id_billing')->on('billing_entry')->onDelete('cascade');
            $table->foreign('id_product_detail')->references('product_id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_detail_entry');
    }
};
