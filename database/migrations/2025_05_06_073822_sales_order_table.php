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
        Schema::create('sales_order', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->string('order_no');
            $table->string('do_no');
            $table->string('customer');
            $table->string('total_qty');
            $table->decimal('cantotal', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('due', 10, 2)->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('status');
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
