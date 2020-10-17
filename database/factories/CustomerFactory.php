<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
            'inn'=> $this->faker->unique()->randomNumber(7),
            'f_name' => $this->faker->firstName,
            'l_name' => $this->faker->lastName,
            'm_name' => $this->faker->domainName,
            'adress' => $this->faker->address,
            'phone' => $this->faker->unique()->phoneNumber,
        ];
    }
}
