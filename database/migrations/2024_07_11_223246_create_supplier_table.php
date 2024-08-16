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
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id_supplier');
            $table->char('code_supplier', 10);
            $table->char('ruc_supplier', 11);
            $table->char('business_name_supplier',100);
            $table->string('address_supplier_business');
            $table->char('contact_name_supplier', 100);
            $table->char('phone_supplier', 9)->nullable();
            $table->string('email_supplier', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier');
    }
};
