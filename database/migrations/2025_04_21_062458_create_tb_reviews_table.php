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
        Schema::create('tb_reviews', function (Blueprint $table) {
            $table->increments('reviews_id');
            $table->foreignId('users_id')->constrained('tb_users')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('tb_menu')->onDelete('cascade');
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_reviews');
    }
};
