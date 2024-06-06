<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Buat instance Faker dengan lokal Indonesia
        $faker = FakerFactory::create('id_ID');

        return [
            'product_name' => $faker->sentence(3),
            'description' => $faker->paragraph(5),
            'price' => $faker->numberBetween(10000, 100000),
            'slug' => $faker->slug(),
            // Tambahkan lebih banyak kolom dan nilai default jika diperlukan
        ];
    }
}
