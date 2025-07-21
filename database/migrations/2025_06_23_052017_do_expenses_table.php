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
         Schema::create('do_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('do_no')->nullable();
             $table->decimal('amount', 10, 2)->nullable();
            $table->longText('note')->nullable();
             $table->string('date')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->unsignedBigInteger('reported_by')->nullable();
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
