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
        Schema::create('do_finalize', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('credit', 10, 2)->nullable();
            $table->decimal('cash', 10, 2)->nullable();
            $table->decimal('cheque', 10, 2)->nullable();
            $table->decimal('expenses', 10, 2)->nullable();
            $table->decimal('expected_cash', 10, 2)->nullable();
            $table->decimal('received_cash', 10, 2)->nullable();
            $table->decimal('expected_cheque', 10, 2)->nullable();
            $table->decimal('received_cheque', 10, 2)->nullable();
            $table->decimal('cash_difference', 10, 2)->nullable();
            $table->decimal('cheque_difference', 10, 2)->nullable();
            $table->unsignedBigInteger('approved')->default(0);
            $table->unsignedBigInteger('received_by')->default(0);
            $table->unsignedBigInteger('status')->default(0);
            $table->unsignedBigInteger('taken_by')->nullable();
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
