<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = [2200000, 2500000, 2800000, 3200000, 3500000];
        return [
            'number' => 'A' . rand(0, 20),
            'price' => $price[rand(0, 4)],
            'size' => rand(20, 35) . 'm2',
            'status' => 0
        ];
    }
}
