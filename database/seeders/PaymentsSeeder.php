<?php

namespace Database\Seeders;

// database/seeders/PaymentsSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_payments')->insert([
            ['orders_id' => 1, 'metode_pembayaran' => 'gopay', 'status' => 'pending'],
            ['orders_id' => 2, 'metode_pembayaran' => 'cod', 'status' => 'paid'],
        ]);
    }
}

