<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id_request');
            $table->timestamp('fech')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('for_request', 100);
            $table->unsignedInteger('id_user_requester');
            $table->unsignedInteger('id_state')->default(1);
            $table->foreign('id_state')->references('state_id')->on('state');
            $table->foreign('id_user_requester')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
};

