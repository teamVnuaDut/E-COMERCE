<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Công ty Cổ phần Sữa Việt Nam (Vinamilk)',
                'code' => 'VINAMILK',
                'contact_person' => 'Nguyễn Thị Hồng',
                'email' => 'cungcap@vinamilk.com.vn',
                'phone' => '02838233565',
                'address' => 'Số 10 Tân Trào, P. Tân Phú, Q. 7, TP. HCM',
                'tax_code' => '0300588567',
                'bank_name' => 'Vietcombank',
                'bank_account_number' => '0071000799999',
                'bank_account_name' => 'CTY CP SỮA VIỆT NAM',
                'status' => 'active'
            ],
            [
                'name' => 'Tập đoàn TH',
                'code' => 'TH_GROUP',
                'contact_person' => 'Trần Văn Minh',
                'email' => 'supplier@thgroup.com.vn',
                'phone' => '02839456789',
                'address' => 'Lô CN1, Khu Công nghiệp Thái Hòa, Nghĩa Đàn, Nghệ An',
                'tax_code' => '2900621736',
                'bank_name' => 'BIDV',
                'bank_account_number' => '119000009999',
                'bank_account_name' => 'TAP DOAN TH',
                'status' => 'active'
            ],
            [
                'name' => 'Công ty Cổ phần Dinh dưỡng Nutifood',
                'code' => 'NUTIFOOD',
                'contact_person' => 'Lê Thị Hương',
                'email' => 'supply@nutifood.com.vn',
                'phone' => '02839123456',
                'address' => 'Số 281-283 Hoàng Diệu, P. 6, Q. 4, TP. HCM',
                'tax_code' => '0302289980',
                'bank_name' => 'Agribank',
                'bank_account_number' => '6000201099999',
                'bank_account_name' => 'CTY CP DINH DUONG NUTIFOOD',
                'status' => 'active'
            ],
            [
                'name' => 'Công ty TNHH Nestlé Việt Nam',
                'code' => 'NESTLE',
                'contact_person' => 'Phạm Quốc Bảo',
                'email' => 'procurement@nestle.com.vn',
                'phone' => '02838279999',
                'address' => 'Khu công nghiệp Biên Hòa 1, Đồng Nai',
                'tax_code' => '3600274919',
                'bank_name' => 'HSBC',
                'bank_account_number' => '999888777666',
                'bank_account_name' => 'CTY TNHH NESTLE VIET NAM',
                'status' => 'active'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
