<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Ảnh chính
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => "{$product->slug}-main.jpg",
                'alt_text' => $product->name,
                'title' => $product->name,
                'type' => 'main',
                'sort_order' => 0
            ]);

            // Ảnh gallery
            for ($i = 1; $i <= 3; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => "{$product->slug}-gallery-{$i}.jpg",
                    'alt_text' => "{$product->name} - Ảnh {$i}",
                    'title' => "{$product->name} - Góc nhìn {$i}",
                    'type' => 'gallery',
                    'sort_order' => $i
                ]);
            }

            // Ảnh thumbnail
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => "{$product->slug}-thumbnail.jpg",
                'alt_text' => $product->name,
                'title' => $product->name,
                'type' => 'thumbnail',
                'sort_order' => 4
            ]);
        }
    }
}
