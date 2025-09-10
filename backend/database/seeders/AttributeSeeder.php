<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Dung tích',
                'slug' => 'dung-tich',
                'type' => 'select',
                'is_filterable' => true,
                'is_visible' => true,
                'is_required' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Hương vị',
                'slug' => 'huong-vi',
                'type' => 'select',
                'is_filterable' => true,
                'is_visible' => true,
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'name' => 'Độ tuổi',
                'slug' => 'do-tuoi',
                'type' => 'select',
                'is_filterable' => true,
                'is_visible' => true,
                'is_required' => false,
                'sort_order' => 3
            ],
            [
                'name' => 'Xuất xứ',
                'slug' => 'xuat-xu',
                'type' => 'select',
                'is_filterable' => true,
                'is_visible' => true,
                'is_required' => false,
                'sort_order' => 4
            ],
            [
                'name' => 'Thành phần',
                'slug' => 'thanh-phan',
                'type' => 'text',
                'is_filterable' => false,
                'is_visible' => true,
                'is_required' => false,
                'sort_order' => 5
            ],
            [
                'name' => 'Hạn sử dụng',
                'slug' => 'han-su-dung',
                'type' => 'number',
                'is_filterable' => false,
                'is_visible' => true,
                'is_required' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Đường kính',
                'slug' => 'duong-kinh',
                'type' => 'select',
                'is_filterable' => false,
                'is_visible' => false,
                'is_required' => false,
                'sort_order' => 7
            ]
        ];

        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }
    }
}
