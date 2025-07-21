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
        Schema::create('empbankdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empid');
            $table->foreign('empid')->references('user_id')->on('employee')->onDelete('cascade');
            $table->string('bank_name');
            $table->bigInteger('acc_no');
            $table->string('branch');
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
