<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        User::firstOrCreate(
            ['email' => 'test@hovertask.com'],
            [
                'fname' => 'Test',
                'lname' => 'User',
                'name' => 'Test User',
                'username' => 'testuser',
                'phone' => '2348012345678',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        User::where('email', 'test@hovertask.com')->delete();
    }
};
