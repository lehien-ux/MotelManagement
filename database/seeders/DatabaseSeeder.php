<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
           "name"=>"Lê Thị Hiền",
           "email"=>"hienle25102001@gmail.com",
           "password"=>bcrypt("hienle2510")
        ]);
        $this->call([
            ServiceSeeder::class,
            CustomerSeeder::class,
//            ContractSeeder::class,
//            ContractServiceSeeder::class,
//            RoomSeeder::class
        ]);
    }
}
