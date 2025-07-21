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
          Schema::create('do_fuel', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
            $table->string('date')->nullable();
            $table->double('amount')->nullable();
             $table->double('cost')->nullable();
            $table->double('odometer')->nullable();
            $table->longText('note')->nullable();
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
