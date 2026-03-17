<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        User::firstOrCreate(
            ['email' => 'test@hovertask.com'],
            [
                'fname' => 'Test',
                'lname' => 'User',
                'phone' => '08123456789',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@hovertask.com'],
            [
                'fname' => 'Admin',
                'lname' => 'User',
                'phone' => '08123456780',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
            ]
        );

        echo "✅ Test users ready:\n";
        echo "   - test@hovertask.com / password123\n";
        echo "   - admin@hovertask.com / admin123\n";
    }
}
