<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_ramen')->insert([
            [
                'ramen_id' => '001',
                'ramen_nama' => 'Ramen Abura Soba',
                'ramen_deskripsi' => 'Ramen abura soba tanpa kuah dengan mie bercampur minyak, bumbu, saus kecap, daging, dan seaweed',
                'ramen_harga' => 'Rp. 15.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ramen_id' => '12345678',
                'ramen_nama' => 'Ramen Curry',
                'ramen_deskripsi' => 'Ramen curry berkuah kental dengan aroma kuat, bumbu kari, daging, bawang, dan kentang.',
                'ramen_harga' => 'Rp. 20.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ramen_id' => '12345678',
                'ramen_nama' => 'Ramen Tantanmen',
                'ramen_deskripsi' => 'Ramen tantanmen berkuah pedas dengan saus wijen, pasta cabai, kecap, daging, dan sayuran.',
                'ramen_harga' => 'Rp. 30.000',   
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}