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
    public function up(): void
    {
        Schema::create('product_movements', function (Blueprint $table) {
            $table->increments('movement_id');
            $table->unsignedInteger('product_id');
            $table->enum('movement_type', ['IN', 'OUT']);
            $table->integer('quantity');
            $table->double('price')->nullable();
            $table->timestamp('movement_date')->useCurrent();
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_movements');
    }
};
