<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            // AttributeSeeder::class,
            // BrandSeeder::class,
            // CategorySeeder::class,
            // SupplierSeeder::class,
            UserSeeder::class,
            // ProductSeeder::class,
            // CouponSeeder::class,
            // CartSeeder::class,
            // CartItemSeeder::class,
            // OrderSeeder::class,
            // OrderItemSeeder::class,
            // PaymentSeeder::class,
            // ProductImageSeeder::class,
            // ShippingSeeder::class,
        ]);
    }
}
