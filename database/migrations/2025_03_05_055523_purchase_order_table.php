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
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_person_id'); // Raw material name
            $table->foreign('contact_person_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('received_date')->nullable();
            $table->integer('received_status')->nullable();
            $table->string('order_no')->nullable();
            $table->string('reference')->nullable();  // Unique identifier
            $table->string('currency')->nullable();
            $table->string('amount_tax_status')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('total')->nullable();
            $table->double('due_amount')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('po_status')->nullable();
            $table->unsignedBigInteger('attention');
            $table->foreign('attention')->references('id')->on('users')->onDelete('cascade');
            $table->integer('telephone')->nullable();
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('recived_mark_by')->nullable();
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
