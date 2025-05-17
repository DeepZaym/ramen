<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_users')->insert([
            [
                'users_nama' => 'Ankara Messi',
                'users_email' => 'Pessi@gmail.com',
                'users_password' => bcrypt('password123'),
                'users_alamat' => 'Jl. Pelajar Pejuang No. 66, Lubuklinggau'
            ],
            [
                'users_nama' => 'Ronaldo',
                'users_email' => 'siuuu@pt.id',
                'users_password' => bcrypt('password123'),
                'users_alamat' => 'Gang Bangka Raya No. 99, Palu'
            ],
            // Tambah data lainnya sesuai kebutuhan
        ]);
    }
}
