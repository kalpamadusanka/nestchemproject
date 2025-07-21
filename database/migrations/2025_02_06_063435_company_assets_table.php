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
        Schema::create('company_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'empid');
            $table->foreign('empid')->references('user_id')->on('employee')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('item');
            $table->integer('type');
            $table->integer('department');
            $table->longText('description')->nullable();
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
