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
        Schema::create('emp_leave', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'empid');
            $table->foreign('empid')->references('user_id')->on('employee')->onDelete('cascade');
            $table->string('leave_type');
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->integer('no_of_date')->nullable();
            $table->integer('remaining_leave');
            $table->longText('reason')->nullable();
            $table->string('leave_status')->nullable();
            $table->integer('added_by');
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
