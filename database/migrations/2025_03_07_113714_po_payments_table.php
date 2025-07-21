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
        Schema::create('po_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_methodId');
            $table->foreign('payment_methodId')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->unsignedBigInteger('purchase_order_id');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_order')->onDelete('cascade');
            $table->string('transactionId')->nullable();
            $table->unsignedBigInteger('payment_account');
            $table->string('type')->nullable();
            $table->string('file')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->integer('total_paid');
            $table->unsignedBigInteger('added_by');
            $table->integer('status');
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
