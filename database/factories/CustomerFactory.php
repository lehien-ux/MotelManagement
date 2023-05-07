<?php

namespace Database\Factories;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'date_of_birth' => Carbon::now()->subDays(rand(3000, 5000)),
            'id_card' => '001800679895',
            'sex' => rand(0,1),
            'address' => $this->faker->address,
            'job' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'password' => bcrypt(12345678)
        ];
    }
}
