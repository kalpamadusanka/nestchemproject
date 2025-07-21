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
        Schema::create('customer_payment_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('date', 10, 2)->nullable();
            $table->longText('payment_method')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
             $table->unsignedBigInteger('taken_by')->nullable();
            $table->unsignedBigInteger('status')->default(1);
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
