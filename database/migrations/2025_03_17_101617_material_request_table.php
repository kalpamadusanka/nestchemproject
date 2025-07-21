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
        Schema::create('material_request', function (Blueprint $table) {
            $table->id();
            $table->string('material_id');
            $table->integer('quantity')->nullable();
            $table->longText('description')->nullable();
            $table->string('uom');
            $table->string('req_code');
            $table->string('req_status');
            $table->unsignedBigInteger('transferred_by')->nullable();
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
