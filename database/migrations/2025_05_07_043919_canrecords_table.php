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
        Schema::create('can_record', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->string('do_no');
            $table->string('size');
            $table->string('purchased_qty');
            $table->string('exchanged_qty');
            $table->decimal('price_per_can', 10, 2)->nullable();
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
