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
        // Add contact_list_id column to contacts table
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('contact_list_id')->nullable()->constrained('contact_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['contact_list_id']);
            $table->dropColumn('contact_list_id');
        });
    }
};
