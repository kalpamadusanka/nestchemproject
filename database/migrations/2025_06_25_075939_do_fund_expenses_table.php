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
        Schema::create('do_fund_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->integer('payment_account')->nullable();
            $table->string('type', 10, 2)->nullable();
            $table->longText('description')->nullable();
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
