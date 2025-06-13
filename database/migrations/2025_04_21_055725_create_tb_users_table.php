<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_users', function (Blueprint $table) {
            $table->increments('users_id');
            $table->string('users_nama')->unique();
            $table->string('users_email')->unique();
            $table->string('users_password');
            $table->string('users_alamat');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tb_users');
    }
};
