<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateSupplyRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id'); // Cambiado a INT UNSIGNED
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            $table->integer('minimum_stock');
            $table->integer('maximum_stock');
            $table->integer('reorder_quantity');
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
        Schema::dropIfExists('supply_rules');
    }
}
