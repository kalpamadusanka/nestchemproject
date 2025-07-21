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
        Schema::create('emp_attendence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->foreign('employee')->references('user_id')->on('employee')->onDelete('cascade');
            $table->string('timein');
            $table->string('timeout');
            $table->double('worked_hours')->nullable();
            $table->longText('note')->nullable();
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
