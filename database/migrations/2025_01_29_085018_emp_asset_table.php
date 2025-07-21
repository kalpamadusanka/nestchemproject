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
        Schema::create('empasset', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'empid');
            $table->foreign('empid')->references('user_id')->on('employee')->onDelete('cascade');
            $table->string('code');
            $table->string('item');
            $table->string('assigned_date');
            $table->string('assigned_by');
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
