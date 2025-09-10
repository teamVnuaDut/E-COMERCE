<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        $carts = Cart::active()->get();
        $products = Product::published()->inStock()->get();

        foreach ($carts as $cart) {
            // Thêm 2-3 sản phẩm vào mỗi giỏ hàng
            $itemsCount = rand(2, 3);

            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                $quantity = rand(1, 3);

                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'price' => $product->currentPrice,
                    'original_price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $product->currentPrice * $quantity,
                    'total' => $product->currentPrice * $quantity,
                    'image' => $product->mainImage->image_path ?? null,
                    'max_quantity' => $product->manage_stock ? $product->stock_quantity : null
                ]);
            }

            // Tính lại tổng tiền cho giỏ hàng
            $cart->calculateTotals();
        }
    }
}
