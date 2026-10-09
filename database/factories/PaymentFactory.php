<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_method' => $this->faker->randomElement([
                'transfer', 'cod', 'e-wallet',
            ]),
            'status' => $this->faker->randomElement([
                'pending', 'success', 'failed',
            ]),
            'transaction_id' => strtoupper($this->faker->bothify('TRX-####-????')),
        ];
    }
}