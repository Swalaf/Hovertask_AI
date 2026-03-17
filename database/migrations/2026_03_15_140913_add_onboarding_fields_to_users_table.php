<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Onboarding tracking
            $table->enum('onboarding_status', ['pending', 'in_progress', 'completed'])->default('pending')->after('is_member');
            $table->integer('onboarding_step')->default(0)->after('onboarding_status');
            $table->timestamp('onboarding_completed_at')->nullable()->after('onboarding_step');

            // Profile completion
            $table->boolean('profile_completed')->default(false)->after('onboarding_completed_at');
            $table->boolean('wallet_funded')->default(false)->after('profile_completed');
            $table->boolean('first_task_completed')->default(false)->after('wallet_funded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'onboarding_status',
                'onboarding_step',
                'onboarding_completed_at',
                'profile_completed',
                'wallet_funded',
                'first_task_completed',
            ]);
        });
    }
};
