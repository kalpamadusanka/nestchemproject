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
        Schema::create('customer_receive_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('type')->nullable();
            $table->string('invoice_no')->unique()->nullable();
            $table->longText('description')->nullable();
            $table->string('doc')->nullable();
             $table->unsignedBigInteger('allocated')->nullable();
            $table->unsignedBigInteger('approved')->default(0);
            $table->unsignedBigInteger('added_by')->default(0);
            $table->unsignedBigInteger('status')->default(0);
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
