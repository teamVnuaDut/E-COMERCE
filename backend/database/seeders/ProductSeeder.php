<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::where('slug', 'sua-tuoi')->first();
        $brand = Brand::where('slug', 'vinamilk')->first();
        $supplier = Supplier::where('code', 'VINAMILK')->first();

        $products = [
            [
                'name' => 'Sữa Tươi Tiệt Trùng Vinamilk 100% Không Đường 180ml',
                'slug' => 'sua-tuoi-tiet-trung-vinamilk-100-khong-duong-180ml',
                'sku' => 'VNM-STT-100-180ML',
                'short_description' => 'Sữa tươi tiệt trùng nguyên chất 100% không đường, hộp 180ml',
                'description' => 'Sữa tươi tiệt trùng Vinamilk 100% không đường được làm từ 100% sữa tươi nguyên chất. Sản phẩm giàu dinh dưỡng, không chất bảo quản, phù hợp cho mọi lứa tuổi.',
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'supplier_id' => $supplier->id,
                'price' => 8000,
                'cost_price' => 6000,
                'stock_quantity' => 1000,
                'weight' => 180,
                'status' => 'published',
                'is_active' => true
            ],
            [
                'name' => 'Sữa Tươi Tiệt Trùng Vinamilk Có Đường 180ml',
                'slug' => 'sua-tuoi-tiet-trung-vinamilk-co-duong-180ml',
                'sku' => 'VNM-STT-DUONG-180ML',
                'short_description' => 'Sữa tươi tiệt trùng có đường, hộp 180ml',
                'description' => 'Sữa tươi tiệt trùng Vinamilk có đường thơm ngon, bổ dưỡng. Sản phẩm được tiệt trùng ở nhiệt độ cao, đảm bảo an toàn vệ sinh thực phẩm.',
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'supplier_id' => $supplier->id,
                'price' => 8000,
                'cost_price' => 6000,
                'stock_quantity' => 800,
                'weight' => 180,
                'status' => 'published',
                'is_active' => true
            ],
            [
                'name' => 'Sữa Tươi Tiệt Trùng TH true MILK Không Đường 110ml',
                'slug' => 'sua-tuoi-tiet-trung-th-true-milk-khong-duong-110ml',
                'sku' => 'TH-TT-KD-110ML',
                'short_description' => 'Sữa tươi tiệt trùng TH true MILK không đường, hộp 110ml',
                'description' => 'Sữa tươi tiệt trùng TH true MILK không đường, được sản xuất từ nguồn sữa tươi sạch của trang trại TH. Sản phẩm giàu canxi và vitamin D.',
                'category_id' => $category->id,
                'brand_id' => Brand::where('slug', 'th-true-milk')->first()->id,
                'supplier_id' => Supplier::where('code', 'TH_GROUP')->first()->id,
                'price' => 7000,
                'cost_price' => 5500,
                'stock_quantity' => 500,
                'weight' => 110,
                'status' => 'published',
                'is_active' => true
            ],
            [
                'name' => 'Sữa Đặc Ông Thọ có Đường 380g',
                'slug' => 'sua-dac-ong-tho-co-duong-380g',
                'sku' => 'VNM-SD-OT-380G',
                'short_description' => 'Sữa đặc có đường Ông Thọ, lon 380g',
                'description' => 'Sữa đặc có đường Ông Thọ với hương vị thơm ngon đặc trưng, giàu dinh dưỡng, thích hợp cho cả gia đình.',
                'category_id' => Category::where('slug', 'sua-dac')->first()->id,
                'brand_id' => $brand->id,
                'supplier_id' => $supplier->id,
                'price' => 32000,
                'cost_price' => 25000,
                'stock_quantity' => 300,
                'weight' => 380,
                'status' => 'published',
                'is_active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
