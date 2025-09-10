<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\User;

class ShippingSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::with('user')->get();

        foreach ($orders as $order) {
            $shippingStatus = match ($order->status) {
                'pending' => 'pending',
                'confirmed' => 'pending',
                'processing' => 'processing',
                'shipped' => 'shipped',
                'delivered' => 'delivered',
                'cancelled' => 'cancelled',
                default => 'pending'
            };

            $shippingMethod = ['standard', 'express', 'fast'][rand(0, 2)];
            $shippingCost = match ($shippingMethod) {
                'express' => 50000,
                'fast' => 35000,
                'standard' => 25000,
                default => 25000
            };

            $shipping = Shipping::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'shipping_number' => Shipping::generateShippingNumber(),
                'shipping_method' => $shippingMethod,
                'shipping_status' => $shippingStatus,
                'shipping_cost' => $shippingCost,
                'shipping_weight' => rand(500, 2000) / 1000, // 0.5 - 2.0 kg
                'receiver_name' => $order->customer_name,
                'receiver_phone' => $order->customer_phone,
                'receiver_address' => $order->shipping_address,
                'receiver_city' => $order->shipping_city,
                'receiver_district' => $order->shipping_district,
                'receiver_ward' => $order->shipping_ward,
            ]);

            // Tính ngày dự kiến giao
            $shipping->calculateEstimatedDelivery();

            // Cập nhật thông tin vận chuyển nếu đã shipped
            if (in_array($shippingStatus, ['shipped', 'delivered'])) {
                $carriers = [
                    ['name' => 'Giao Hàng Nhanh', 'code' => 'GHN'],
                    ['name' => 'Giao Hàng Tiết Kiệm', 'code' => 'GHTK'],
                    ['name' => 'Viettel Post', 'code' => 'VT']
                ];

                $carrier = $carriers[rand(0, 2)];

                $shipping->update([
                    'carrier_name' => $carrier['name'],
                    'carrier_code' => $carrier['code'],
                    'tracking_number' => strtoupper($carrier['code']) . rand(100000000, 999999999),
                    'tracking_url' => "https://tracking.{$carrier['code']}.com/" . strtoupper($carrier['code']) . rand(100000000, 999999999),
                    'shipped_at' => now()->subDays(rand(1, 5))
                ]);

                if ($shippingStatus === 'delivered') {
                    $shipping->update([
                        'delivered_at' => now()->subDays(rand(1, 3))
                    ]);
                }
            }
        }
    }
}
