<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test user
        User::firstOrCreate(
            ['email' => 'test@hovertask.com'],
            [
                'name' => 'Test',
                'lname' => 'User',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );

        echo "✅ Test user ready (test@hovertask.com / password123)\n";
    }
}
