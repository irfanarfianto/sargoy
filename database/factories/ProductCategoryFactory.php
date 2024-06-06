<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => function () {
                return \App\Models\Product::factory()->create()->id;
            },
            'category_id' =>
            function () {
                return \App\Models\Category::factory()->create()->id;
            },
        ];
    }
}
