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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ticket_no'); // Document column
            $table->integer('t_category');
            $table->string('subject');
            $table->integer('assign_to');
            $table->text('description')->nullable();
            $table->string('priority');
            $table->string('t_status');
            $table->integer('added_by');
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
