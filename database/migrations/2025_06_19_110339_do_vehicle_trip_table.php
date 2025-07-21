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
        Schema::create('do_vehicle_trip', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->double('start_km')->nullable();
             $table->double('distance')->nullable();
            $table->double('end_km')->nullable();
            $table->string('initial_fuel')->nullable();
            $table->string('final_fuel')->nullable();
            $table->unsignedBigInteger('status');
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
