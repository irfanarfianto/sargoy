<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Buat instance Faker dengan lokal Indonesia
        $faker = FakerFactory::create('id_ID');

        return [
            'category_name' => $faker->word(),
            'meta_keyword' => $faker->words(3, true),
            'images' => $faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            // Tambahkan tindakan tambahan setelah pembuatan kategori jika diperlukan
        });
    }
}
