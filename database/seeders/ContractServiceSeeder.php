<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=0;$i<=20;$i++) {
            $data[] = [
                'contract_id' => rand(1, 20),
                'service_id' => rand(1, 3),
            ];
        }
        DB::table('contract_services')->insert($data);
    }
}
