<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'category_label' => fake()->word(),
            'description' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 10, 1000),
            'version' => fake()->numerify('#.#.#'),
            'release_date' => fake()->date(),
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => true,
            'demo_link' => fake()->url(),
            'features' => [fake()->sentence(), fake()->sentence()],
        ];
    }
}
