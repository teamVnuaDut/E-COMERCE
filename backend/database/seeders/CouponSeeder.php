<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'name' => 'Giảm 10% cho đơn đầu tiên',
                'description' => 'Áp dụng cho tất cả đơn hàng, giảm tối đa 50,000đ',
                'type' => 'percentage',
                'discount_value' => 10,
                'min_order_amount' => 100000,
                'max_discount_amount' => 50000,
                'usage_limit' => 1000,
                'usage_per_user' => 1,
                'starts_at' => Carbon::now()->subDays(7),
                'ends_at' => Carbon::now()->addMonths(3),
                'is_active' => true,
                'is_public' => true
            ],
            [
                'code' => 'FREESHIP',
                'name' => 'Miễn phí vận chuyển',
                'description' => 'Miễn phí vận chuyển cho đơn từ 300,000đ',
                'type' => 'fixed_amount',
                'discount_value' => 30000, // Giả sử phí ship 30,000đ
                'min_order_amount' => 300000,
                'max_discount_amount' => 30000,
                'usage_limit' => 500,
                'usage_per_user' => 2,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addMonth(),
                'is_active' => true,
                'is_public' => true
            ],
            [
                'code' => 'MILKLOVER',
                'name' => 'Giảm 15% cho sữa',
                'description' => 'Giảm 15% cho các sản phẩm sữa',
                'type' => 'percentage',
                'discount_value' => 15,
                'min_order_amount' => 150000,
                'max_discount_amount' => 75000,
                'usage_limit' => 200,
                'usage_per_user' => 1,
                'starts_at' => Carbon::now()->subDays(1),
                'ends_at' => Carbon::now()->addWeeks(2),
                'is_active' => true,
                'is_public' => true,
                'applicable_categories' => [1, 2] // Áp dụng cho category ID 1, 2
            ],
            [
                'code' => 'SUMMER20',
                'name' => 'Giảm 20% mùa hè',
                'description' => 'Giảm 20% cho tất cả đơn hàng',
                'type' => 'percentage',
                'discount_value' => 20,
                'min_order_amount' => 200000,
                'max_discount_amount' => 100000,
                'usage_limit' => null, // Không giới hạn
                'usage_per_user' => 3,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addMonths(2),
                'is_active' => true,
                'is_public' => true
            ]
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
