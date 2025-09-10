<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@sua.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'phone' => '0123456789',
        ]);

        User::create([
            'name' => 'Store Manager',
            'email' => 'manager@sua.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@sua.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@sua.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'status' => 'active',
        ]);
    }
}
