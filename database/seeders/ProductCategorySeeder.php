<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create('id_ID');

        // Create categories
        $categories = Category::factory()->count(10)->create();

        // Create products
        $products = Product::factory()->count(50)->create();

        // Attach categories to products
        foreach ($products as $product) {
            // Assign one random category to each product
            $product->categories()->attach(
                $categories->random()->pluck('id')->toArray()
            );

            // Generate between 1 to 4 product images
            $imageCount = rand(1, 4);
            ProductImage::factory()->count($imageCount)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
