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
        Schema::create('sale_dispatch', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->string('area')->nullable();
            $table->string('date')->nullable();
            $table->string('sale_represntative')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('driver')->nullable();
            $table->string('loading_prepared_by')->nullable();
            $table->string('loading_received_by')->nullable();
            $table->string('loading_store_keeper')->nullable();
            $table->string('unloading_prepared_by')->nullable();
            $table->string('unloading_received_by')->nullable();
            $table->string('unloading_store_keeper')->nullable();
            $table->decimal('opening_amount', 10, 2)->nullable();
            $table->decimal('load_value', 10, 2)->nullable();
            $table->decimal('unload_value', 10, 2)->nullable();
            $table->decimal('can_total', 10, 2)->nullable();
            $table->string('checked_by')->nullable();
            $table->string('authorised')->nullable();
            $table->string('load_status')->nullable();
            $table->string('unload_status')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->longText('note')->nullable();
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
