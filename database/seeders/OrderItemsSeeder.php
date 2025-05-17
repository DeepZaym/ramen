<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_orders_item')->insert([
            ['orders_id' => 1, 'menu_id' => 1, 'quantity' => 2],
            ['orders_id' => 2, 'menu_id' => 3, 'quantity' => 1],
        ]);
    }
}


