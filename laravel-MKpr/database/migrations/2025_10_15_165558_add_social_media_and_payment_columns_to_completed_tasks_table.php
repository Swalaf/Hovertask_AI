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
        Schema::table('completed_tasks', function (Blueprint $table) {
            // Add new columns - don't use after() since advert_id may not exist yet
            $table->string('social_media_url')->nullable();
            $table->decimal('payment_per_task', 10, 2)->default(0);
            $table->string('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('completed_tasks', function (Blueprint $table) {
            $table->dropColumn(['social_media_url', 'payment_per_task', 'title']);
        });
    }
};
