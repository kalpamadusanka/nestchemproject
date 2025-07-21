<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('so_payment', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->string('order_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->unsignedBigInteger('received_id')->nullable();
            $table->unsignedBigInteger('customer')->nullable();
            $table->string('type')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('cheque_image')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('to_be_paid', 10, 2)->nullable();
             $table->string('chequedate')->nullable();
            $table->unsignedBigInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
