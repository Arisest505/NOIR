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
        Schema::create('farm_shed', function (Blueprint $table) {
            $table->unsignedInteger('id_farm');
            $table->unsignedInteger('id_shed');
            $table->primary(['id_farm', 'id_shed']);
            $table->foreign('id_farm')->references('farm_id')->on('farm')->onDelete('cascade');
            $table->foreign('id_shed')->references('shed_id')->on('shed')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_shed');
    }
};
