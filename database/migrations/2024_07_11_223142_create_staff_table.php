<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->string('name_staff', 40);
            $table->string('apat_staff', 30);
            $table->string('apmat_staff', 30);
            $table->char('dni_staff', 8);
            $table->date('birthdate_staff')->nullable();
            $table->char('phone_staff', 9)->nullable();
            $table->string('email_staff', 150)->nullable()->unique();
            $table->string('bank_account_staff', 40)->unique();;
            $table->unsignedInteger('id_occupation_staff');
            $table->foreign('id_occupation_staff')->references('occupation_id')->on('occupation')->onDelete('cascade');
            $table->enum('status_staff', ['Contract Ongoing', 'Contract Ended'])->default('Contract Ongoing');
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
        Schema::dropIfExists('staff');
    }
};
