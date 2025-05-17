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
        Schema::create('tb_payments', function (Blueprint $table) {
            $table->increments('payments_id');
            $table->foreignId('orders_id')->constrained('tb_orders')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['gopay', 'ovo', 'dana', 'bank_transfer', 'cod']);
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_payments');
    }
};
