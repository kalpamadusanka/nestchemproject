<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('advance_deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advance_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('deduction_date');
            $table->string('payroll_period');
            $table->enum('status', ['pending', 'processed', 'failed'])->default('pending');
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            // Indexes
            $table->index(['advance_id', 'status']);

            $table->index('deduction_date');
            $table->index('processed_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advance_deductions');
    }
};
