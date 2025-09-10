<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::published()->get();

        foreach ($orders as $order) {
            // Thêm 2-4 items vào mỗi đơn hàng
            $itemsCount = rand(2, 4);

            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $price = $product->currentPrice;
                $discount = rand(0, $price * 0.2); // Giảm giá 0-20%

                $status = match ($order->status) {
                    'pending' => 'pending',
                    'confirmed' => 'pending',
                    'processing' => 'pending',
                    'shipped' => 'shipped',
                    'delivered' => 'delivered',
                    'cancelled' => 'cancelled',
                    default => 'pending'
                };

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'price' => $price,
                    'original_price' => $product->price,
                    'discount_amount' => $discount,
                    'quantity' => $quantity,
                    'subtotal' => $price * $quantity,
                    'total' => ($price - $discount) * $quantity,
                    'image' => $product->mainImage->image_path ?? null,
                    'status' => $status,
                    'attributes' => [
                        'dung_tich' => '180ml',
                        'huong_vi' => 'Không đường'
                    ]
                ]);
            }

            // Tính lại tổng tiền cho đơn hàng
            $order->calculateTotals();
        }
    }
}
