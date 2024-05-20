<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'images' => "https://source.unsplash.com/2500x1000/?product,fashion",
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(3, 1000, 100000),
        ];
    }
}
