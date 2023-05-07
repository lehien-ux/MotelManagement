<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->truncate();
        DB::table('services')->insert([
            [
                'name' => 'Điện',
                'price' => '3500',
                'unit_price' => 'kw/h',
                'service_type' => 1
            ],
            [
                'name' => 'Nước',
                'price' => '8000',
                'unit_price' => '1m3',
                'service_type' => 1
            ],
            [
                'name' => 'Wifi',
                'price' => 150000,
                'unit_price' => '1 tháng',
                'service_type' => 2
            ],
        ]);
    }
}
