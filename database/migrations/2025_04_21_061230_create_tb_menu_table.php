<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_menu', function (Blueprint $table) {
            $table->increments('menu_id'); 
            $table->string('menu_nama', 100);
            $table->text('menu_deskripsi')->nullable();
            $table->integer('menu_harga')->unsigned(); // Harga dalam rupiah (tanpa koma)
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->unsignedInteger('stok')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_menu');
    }
};
