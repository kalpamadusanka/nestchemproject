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
        Schema::create('customer_payment_schedule_notify', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_schedule_id')->nullable();
            $table->foreign('payment_schedule_id')->references('id')->on('customer_payment_schedule')->onDelete('cascade');
            $table->string('mark_as_received')->nullable();
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
