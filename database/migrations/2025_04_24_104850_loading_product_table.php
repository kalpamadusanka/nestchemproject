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
        Schema::create('loading_product', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_stock_id')->nullable();
            $table->string('shelf')->nullable();
            $table->string('qty')->nullable();
            $table->string('in_loading_stock')->nullable();

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
