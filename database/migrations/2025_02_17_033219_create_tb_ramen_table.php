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
        Schema::create('tb_ramen', function (Blueprint $table) {
            $table->increments('ramen_id'); 
            $table->string('ramen_nama');
            $table->string('ramen_deskripsi');
            $table->string('ramen_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ramen');
    }
};
