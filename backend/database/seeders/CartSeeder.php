<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->take(2)->get();

        foreach ($users as $user) {
            Cart::create([
                'user_id' => $user->first()->id,
                'total_amount' => 0,
                'grand_total' => 0,
                'is_active' => true,
                'is_guest' => false
            ]);
        }

        // Tạo giỏ hàng cho khách vãng lai
        Cart::create([
            'session_id' => 'guest_session_123456',
            'total_amount' => 0,
            'grand_total' => 0,
            'is_active' => true,
            'is_guest' => true
        ]);

        // Tạo giỏ hàng abandoned
        Cart::create([
            'user_id' => $users->first()->id,
            'total_amount' => 50000,
            'grand_total' => 50000,
            'is_active' => false,
            'is_guest' => false,
            'abandoned_at' => now()->subDays(3)
        ]);
    }
}
