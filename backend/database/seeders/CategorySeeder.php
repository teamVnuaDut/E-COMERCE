<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Danh mục gốc
            [
                'name' => 'Sữa Tươi',
                'slug' => 'sua-tuoi',
                'description' => 'Các loại sữa tươi tiệt trùng',
                'status' => 'active',
                'sort_order' => 1
            ],
            [
                'name' => 'Sữa Đặc',
                'slug' => 'sua-dac',
                'description' => 'Sữa đặc các loại',
                'status' => 'active',
                'sort_order' => 2
            ],
            [
                'name' => 'Sữa Bột',
                'slug' => 'sua-bot',
                'description' => 'Sữa bột cho mọi lứa tuổi',
                'status' => 'active',
                'sort_order' => 3
            ],
            [
                'name' => 'Sữa Chua',
                'slug' => 'sua-chua',
                'description' => 'Sữa chua ăn và uống',
                'status' => 'active',
                'sort_order' => 4
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Thêm danh mục con cho Sữa Tươi
        $suaTuoi = Category::where('slug', 'sua-tuoi')->first();

        if ($suaTuoi) {
            $subCategories = [
                [
                    'name' => 'Sữa Tươi Không Đường',
                    'slug' => 'sua-tuoi-khong-duong',
                    'parent_id' => $suaTuoi->id,
                    'status' => 'active',
                    'sort_order' => 1
                ],
                [
                    'name' => 'Sữa Tươi Có Đường',
                    'slug' => 'sua-tuoi-co-duong',
                    'parent_id' => $suaTuoi->id,
                    'status' => 'active',
                    'sort_order' => 2
                ],
                [
                    'name' => 'Sữa Tươi Organic',
                    'slug' => 'sua-tuoi-organic',
                    'parent_id' => $suaTuoi->id,
                    'status' => 'active',
                    'sort_order' => 3
                ]
            ];

            foreach ($subCategories as $subCategory) {
                Category::create($subCategory);
            }
        }
    }
}
