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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id('shipping_id');
            $table->foreignId('order_id');
            $table->string('shipping_method');
            $table->string('shipping_status');
            $table->string('tracking_number');
            $table->timestamps();
        });
    }
    //nullabl pd dari fk

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
