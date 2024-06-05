<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'product_name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(5),
            'price' => $this->faker->numberBetween(10000, 100000),
            'slug' => $this->faker->slug(),
            // Add more columns and their default values if needed
        ];
    }
}
