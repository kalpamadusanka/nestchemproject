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
        Schema::create('product_stock_adjustment', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->string('date')->nullable();
            $table->string('product_id')->nullable();
            $table->string('shelf_no')->nullable();
            $table->string('uom')->nullable();
            $table->string('type')->nullable();
            $table->double('adjustment_qty')->nullable();
            $table->double('newqty')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('in_stock')->nullable();
            $table->unsignedBigInteger('approved');
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
