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
        Schema::create('payment_account_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('payment_account')->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->integer('payment_method')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->string('transaction_type')->nullable();
            $table->string('type')->nullable();
            $table->string('flow_type')->nullable();
            $table->string('refNo')->nullable();
            $table->longText('description')->nullable();
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
