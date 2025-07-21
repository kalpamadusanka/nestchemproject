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
        Schema::create('employeedoc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for user_id
            $table->string('doc'); // Document column
            $table->unsignedBigInteger('added_by');
            $table->integer('status');
            $table->foreign('user_id')->references('id')->on('employee')->onDelete('cascade'); // Reference 'id' from employee table
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
