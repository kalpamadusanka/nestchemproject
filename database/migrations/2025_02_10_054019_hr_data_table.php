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
        Schema::create('hr_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')->references('id')->on('data_collection')->onDelete('cascade');
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
