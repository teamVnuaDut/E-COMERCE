<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Vinamilk',
                'slug' => 'vinamilk',
                'description' => 'Thương hiệu sữa hàng đầu Việt Nam',
                'logo' => 'vinamilk-logo.png',
                'website' => 'https://vinamilk.com.vn',
                'status' => 'active',
                'sort_order' => 1
            ],
            [
                'name' => 'TH true MILK',
                'slug' => 'th-true-milk',
                'description' => 'Sữa tươi sạch từ trang trại TH',
                'logo' => 'th-true-milk-logo.png',
                'website' => 'https://thmilk.vn',
                'status' => 'active',
                'sort_order' => 2
            ],
            [
                'name' => 'Nutifood',
                'slug' => 'nutifood',
                'description' => 'Dinh dưỡng và sức khỏe từ Nutifood',
                'logo' => 'nutifood-logo.png',
                'website' => 'https://nutifood.com.vn',
                'status' => 'active',
                'sort_order' => 3
            ],
            [
                'name' => 'Milo',
                'slug' => 'milo',
                'description' => 'Năng lượng cho cả ngày dài',
                'logo' => 'milo-logo.png',
                'website' => 'https://milo.com',
                'status' => 'active',
                'sort_order' => 4
            ],
            [
                'name' => 'Dutch Lady',
                'slug' => 'dutch-lady',
                'description' => 'Sữa dinh dưỡng từ Hà Lan',
                'logo' => 'dutch-lady-logo.png',
                'website' => 'https://dutchlady.com.vn',
                'status' => 'active',
                'sort_order' => 5
            ]
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
