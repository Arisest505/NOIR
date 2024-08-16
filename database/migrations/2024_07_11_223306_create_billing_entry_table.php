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
        Schema::create('billing_entry', function (Blueprint $table) {
            $table->id('id_billing');
            $table->boolean('igv_data_billing')->nullable()->default(false);
            $table->unsignedInteger('id_warehouse_billing');
            $table->unsignedInteger('id_operation_type_billing');
            $table->unsignedInteger('id_supplier_billing');
            $table->unsignedInteger('id_currency_billing');
            $table->date('issue_date_billing');
            $table->date('accounting_date_billing');
            $table->char('period_billing', 10);
            $table->unsignedInteger('id_voucher_billing');
            $table->char('document_number_billing', 10);
            $table->char('second_number_billing', 10);
            $table->char('gloss_billing', 30);
            $table->double('total_billing')->default(0);  // Nuevo campo para el total
            $table->double('effective_total_billing')->default(0);  // Nuevo campo para el total efectivo

            $table->foreign('id_warehouse_billing')->references('warehouse_id')->on('warehouse');
            $table->foreign('id_operation_type_billing')->references('operation_type_id')->on('operation_type');
            $table->foreign('id_supplier_billing')->references('id_supplier')->on('supplier');
            $table->foreign('id_currency_billing')->references('currency_id')->on('currency_type');
            $table->foreign('id_voucher_billing')->references('voucher_id')->on('payment_voucher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_entry');
    }
};
