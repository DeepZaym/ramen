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
        Schema::create('tb_orders_item', function (Blueprint $table) {
            $table->increments('orders_item_id');
            $table->foreignId('orders_id')->constrained('tb_orders')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('tb_menu')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_orders_item');
    }
};
