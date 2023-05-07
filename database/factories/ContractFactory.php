<?php

namespace Database\Factories;

use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id' => rand(0,10),
            'customer_id' => rand(0,30),
            'deposited' => 500000,
            'description' => Str::random(32),
            'start_date' => Carbon::now()->subDays(rand(60, 300)),
            'end_date' => Carbon::now()->addDays(rand(0, 150)),
            'status' => rand(0,1),
            'return_room' => rand(0,1),
        ];
    }
}
