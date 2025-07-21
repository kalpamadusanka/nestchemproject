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
        Schema::create('sales_order_item', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->string('do_no');
            $table->string('product_id');
            $table->string('loading_id');
            $table->string('stock_id');
            $table->string('quantity');
            $table->string('product_name');
            $table->decimal('total', 10, 2)->nullable();
            $table->unsignedBigInteger('added_by'); // Example field
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
