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
        Schema::create('product_stock', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('barcode')->nullable();
            $table->double('qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->string('product_group')->nullable();
            $table->string('lot')->nullable();
            $table->string('exp_date')->nullable();
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
