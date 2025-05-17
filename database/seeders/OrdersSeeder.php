<?php

namespace Database\Seeders;

// database/seeders/OrdersSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_orders')->insert([
            [
                'users_id' => 1,
                'total_price' => 127383.26,
                'status' => 'preparing',
                'delivery_address' => 'Bandar Lampung, BE 47891'
            ],
            [
                'users_id' => 2,
                'total_price' => 37024.16,
                'status' => 'delivered',
                'delivery_address' => 'Subulussalam, Kalimantan Barat 72819'
            ],
        ]);
    }
}
