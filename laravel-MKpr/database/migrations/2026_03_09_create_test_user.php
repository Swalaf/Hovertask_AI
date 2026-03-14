<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        User::firstOrCreate(
            ['email' => 'test@hovertask.com'],
            [
                'name' => 'Test',
                'lname' => 'User',
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
