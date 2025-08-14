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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key to the orders table
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->string('size');
            $table->string('color'); // Product ID
            $table->integer('quantity'); // Quantity ordered
            $table->decimal('price', 10, 2); // Price of the product at the time of the order
            $table->timestamps();
        
            // Foreign key
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
