<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(fake()->bothify('????')),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'order_type' => fake()->randomElement(['Produk', 'Layanan']),
            'item_name' => fake()->words(3, true),
            'total_price' => fake()->randomFloat(2, 100, 10000),
            'notes' => fake()->sentence(),
            'status' => 'pending',
        ];
    }
}
