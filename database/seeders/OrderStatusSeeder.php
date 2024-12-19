<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('enum_order_status')->insert([
            ['cod' => 'awaiting_payment'],
            ['cod' => 'paid'],
            ['cod' => 'in_transit'],
            ['cod' => 'delivered'],
            ['cod' => 'cancelled']
        ]);
    }
}
