<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_reviews')->insert([
            ['users_id' => 1, 'menu_id' => 1, 'rating' => 4, 'comment' => 'terlalu banyak enaknya'],
            ['users_id' => 2, 'menu_id' => 3, 'rating' => 3, 'comment' => 'kurang nendang'],
        ]);
    }
}

