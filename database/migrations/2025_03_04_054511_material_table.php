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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Raw material name
            $table->string('code')->unique();
            $table->double('qty')->nullable(); // Unique identifier
            $table->unsignedBigInteger('warehouse_id');
            $table->longText('shelf_no')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('material_category')->onDelete('cascade');
            $table->enum('unit', ['kg', 'liters', 'pieces']); // Unit of measurement
            $table->integer('min_stock')->default(0); // Minimum stock level// Expiry date (if applicable)
            $table->text('description')->nullable(); // Optional description
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
