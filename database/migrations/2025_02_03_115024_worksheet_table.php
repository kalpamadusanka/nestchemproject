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
        Schema::create('worksheet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee');
            $table->foreign('employee')->references('user_id')->on('employee')->onDelete('cascade');
            $table->string('task')->nullable();
            $table->string('deadline')->nullable();
            $table->integer('worked_hours');
            $table->string('date');
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
