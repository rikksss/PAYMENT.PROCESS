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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('order_id');
        $table->string('payment_method');
        $table->string('payment_status');
        $table->string('transaction_id')->nullable();
        $table->decimal('amount', 10, 2);
        $table->timestamps();
    });
}
    //nullable

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
