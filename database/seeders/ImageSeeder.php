<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory()->count(50)->create();

        // For each product, create 1 to 5 images
        foreach ($products as $product) {
            $imageCount = rand(1, 5); // Random number of images per product
            ProductImage::factory()->count($imageCount)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
