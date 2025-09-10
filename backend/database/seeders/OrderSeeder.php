<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->take(3)->get();

        foreach ($users as $user) {
            // Tạo 1-2 đơn hàng cho mỗi user
            $orderCount = rand(1, 2);

            for ($i = 0; $i < $orderCount; $i++) {
                $status = ['pending', 'confirmed', 'shipped', 'delivered'][rand(0, 3)];
                $paymentStatus = $status === 'delivered' ? 'paid' : 'pending';

                Order::create([
                    'user_id' => $user->id,
                    'order_number' => Order::generateOrderNumber(),
                    'status' => $status,
                    'subtotal' => rand(50000, 200000),
                    'discount_amount' => rand(0, 10000),
                    'shipping_amount' => 30000,
                    'grand_total' => rand(80000, 220000),
                    'customer_email' => $user->email,
                    'customer_phone' => $user->phone ?? '0123456789',
                    'customer_name' => $user->name,
                    'shipping_name' => $user->name,
                    'shipping_phone' => $user->phone ?? '0123456789',
                    'shipping_address' => '123 Đường Example, Quận 1, TP.HCM',
                    'payment_method' => ['cod', 'bank_transfer', 'momo'][rand(0, 2)],
                    'payment_status' => $paymentStatus,
                    'paid_at' => $paymentStatus === 'paid' ? now()->subDays(rand(1, 10)) : null,
                    'shipped_at' => in_array($status, ['shipped', 'delivered']) ? now()->subDays(rand(1, 5)) : null,
                    'delivered_at' => $status === 'delivered' ? now()->subDays(rand(1, 3)) : null,
                ]);
            }
        }
    }
}
