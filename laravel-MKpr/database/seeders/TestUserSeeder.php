<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test user if not exists
        User::firstOrCreate(
            ['email' => 'test@hovertask.com'],
            [
                'fname' => 'Test',
                'lname' => 'User',
                'username' => 'testuser',
                'phone' => '+234-800-000-0000',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'country' => 'Nigeria',
                'currency' => 'NGN',
                'avatar' => 'https://via.placeholder.com/150',
                'is_member' => true,
            ]
        );

        // Create admin test user
        User::firstOrCreate(
            ['email' => 'admin@hovertask.com'],
            [
                'fname' => 'Admin',
                'lname' => 'User',
                'username' => 'adminuser',
                'phone' => '+234-800-000-0001',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'country' => 'Nigeria',
                'currency' => 'NGN',
                'avatar' => 'https://via.placeholder.com/150',
                'is_member' => true,
            ]
        );

        // Create seller test user
        User::firstOrCreate(
            ['email' => 'seller@hovertask.com'],
            [
                'fname' => 'Seller',
                'lname' => 'User',
                'username' => 'selleruser',
                'phone' => '+234-800-000-0002',
                'password' => Hash::make('seller123'),
                'email_verified_at' => now(),
                'country' => 'Nigeria',
                'currency' => 'NGN',
                'avatar' => 'https://via.placeholder.com/150',
                'is_member' => true,
            ]
        );

        echo "Test users created successfully!\n";
        echo "Credentials:\n";
        echo "1. test@hovertask.com / password123\n";
        echo "2. admin@hovertask.com / admin123\n";
        echo "3. seller@hovertask.com / seller123\n";
    }
}
