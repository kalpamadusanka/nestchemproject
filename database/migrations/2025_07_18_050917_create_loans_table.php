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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('loan_request_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('type');
            $table->text('purpose');
            $table->integer('repayment_months');
            $table->decimal('monthly_payment', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->enum('status', ['active', 'completed', 'defaulted','rejected'])->default('active');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'status']);
            $table->index('status');
            $table->index('loan_request_id');
            $table->index('approved_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
