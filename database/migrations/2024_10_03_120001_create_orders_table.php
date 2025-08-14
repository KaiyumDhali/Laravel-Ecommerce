<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('user_name');
            $table->string('City');
            $table->string('full_address');
            $table->decimal('total_amount', 10, 2); // Total amount of the order
            $table->string('status')->default('pending'); // Order status
            $table->timestamps();
            
            // Foreign key
            $table->foreign('user_id')->references('id')->on('user_migration1')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
