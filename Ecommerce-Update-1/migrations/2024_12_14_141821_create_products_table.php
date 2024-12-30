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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->longText('description');
            $table->decimal('product_price', 10, 2);
            $table->foreignId('category_id');
            $table->foreignId('brand_id');
            $table->foreignId('user_id');
            $table->integer('stock_quantity');
            $table->enum('stock_status', ['In Stock', 'Out of Stock'])->default('In Stock');
            $table->string('product_image');
            $table->timestamps();

             // Foreign key constraint
             
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
             $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
             

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
