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
        Schema::create('payment_account', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->unsignedBigInteger('account_type');
            $table->foreign('account_type')->references('id')->on('payment_account_type')->onDelete('cascade');
            $table->decimal('balance', 10, 2)->nullable();
            $table->string('code');
            $table->longText('description');
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
