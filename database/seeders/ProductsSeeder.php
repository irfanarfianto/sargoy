<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory()->count(50)->create();
        $categories = Category::factory()->count(5)->create();

        foreach ($products as $product) {
            $category = $categories->random();

            $product->categories()->attach($category);

            
            $imageCount = rand(1, 4);
            ProductImage::factory()->count($imageCount)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
