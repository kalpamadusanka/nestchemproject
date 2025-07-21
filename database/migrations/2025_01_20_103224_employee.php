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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthday'); // Change to date
            $table->string('gender');
            $table->longText('address');
            $table->bigInteger('contact'); // Change to bigInteger
            $table->unsignedBigInteger('user_id')->unique(); // Remove unique if not needed
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
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
