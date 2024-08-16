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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->char('code_product', 10);
            $table->string('name_product');
            $table->integer('stock_product');
            $table->double('price_product');
            $table->double('total_price_product');
            $table->double('averagePrice_product')->nullable();
            $table->unsignedInteger('unit_product');
            $table->unsignedInteger('warehouse_product');
            $table->unsignedInteger('currency_type_product');
            $table->unsignedInteger('goods_type_product');
            $table->unsignedInteger('category_product');
            $table->timestamps();

            $table->foreign('unit_product')->references('unit_id')->on('unit_measure')->onDelete('cascade');
            $table->foreign('warehouse_product')->references('warehouse_id')->on('warehouse')->onDelete('cascade');
            $table->foreign('currency_type_product')->references('currency_id')->on('currency_type')->onDelete('cascade');
            $table->foreign('goods_type_product')->references('goods_type_id')->on('goods_type')->onDelete('cascade');
            $table->foreign('category_product')->references('category_id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
