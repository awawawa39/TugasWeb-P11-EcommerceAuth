<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address_id' => Address::factory(),
            'status' => $this->faker->randomElement([
                'pending', 'paid', 'shipped', 'completed', 'cancelled',
            ]),
            'total_amount' => $this->faker->numberBetween(50000, 10000000),
        ];
    }
}