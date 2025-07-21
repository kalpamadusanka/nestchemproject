<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_xx_xx_create_purchase_order_items_table.php
public function up()
{
    Schema::create('purchase_order_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('purchase_order_id');
        $table->foreign('purchase_order_id')->references('id')->on('purchase_order')->onDelete('cascade');
        $table->string('item');
        $table->string('description')->nullable();
        $table->integer('quantity');
        $table->decimal('unit_price', 10, 2);
        $table->decimal('discount', 5, 2)->nullable();
        $table->unsignedBigInteger('account_id');
        $table->foreign('account_id')->references('id')->on('payment_account')->onDelete('cascade');
        $table->decimal('tax_rate', 5, 2)->nullable();
        $table->string('lot')->nullable();
        $table->string('batch')->nullable();
        $table->string('exp_date')->nullable();
        $table->decimal('amount', 10, 2);
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
