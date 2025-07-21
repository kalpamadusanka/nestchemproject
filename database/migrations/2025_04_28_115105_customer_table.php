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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phonetwo')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('vat')->nullable();
            $table->longText('note')->nullable();
            $table->longText('signature')->nullable();
            $table->string('area')->nullable();
            $table->string('sales_rep')->nullable();
            $table->integer('customer_acc_no')->nullable();
            $table->double('credit_limit')->nullable();
            $table->string('credit_period')->nullable();
             $table->decimal('to_be_paid', 10, 2)->nullable();
              $table->decimal('total_paid', 10, 2)->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->string('status')->nullable();
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
