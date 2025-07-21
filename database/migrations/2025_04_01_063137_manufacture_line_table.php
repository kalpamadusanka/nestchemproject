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
        Schema::create('manufacture_line', function (Blueprint $table) {
            $table->id();
            $table->string('mo_no')->nullable();
            $table->unsignedBigInteger('product_group');
            $table->unsignedBigInteger('product');
            $table->string('barcode')->nullable();
            $table->string('barcode_type')->nullable();
            $table->string('files')->nullable();
            $table->double('qty')->nullable();
            $table->string('st_date')->nullable();
            $table->string('ed_date')->nullable();
            $table->string('assigned')->nullable();
            $table->string('mo_status');
            $table->longText('description')->nullable();
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
