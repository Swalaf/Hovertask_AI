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
        Schema::table('tasks', function (Blueprint $table) {
            // Add task type field to distinguish between engagement, freelance, and job
            $table->enum('task_category', ['engagement', 'freelance', 'job'])->default('engagement')->after('category');

            // Freelance Task Fields
            $table->text('skills_required')->nullable()->after('task_category');
            $table->enum('pricing_type', ['hourly', 'fixed'])->nullable()->after('skills_required');
            $table->decimal('hourly_rate', 10, 2)->nullable()->after('pricing_type');
            $table->decimal('fixed_price', 10, 2)->nullable()->after('hourly_rate');
            $table->enum('experience_level', ['entry', 'intermediate', 'expert'])->nullable()->after('fixed_price');
            $table->string('project_duration')->nullable()->after('experience_level');

            // Job Task Fields
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'internship'])->nullable()->after('project_duration');
            $table->string('salary_range_min')->nullable()->after('job_type');
            $table->string('salary_range_max')->nullable()->after('salary_range_min');
            $table->string('job_location')->nullable()->after('salary_range_max');
            $table->text('qualifications_required')->nullable()->after('job_location');
            $table->date('application_deadline')->nullable()->after('qualifications_required');
            $table->string('company_name')->nullable()->after('application_deadline');
            $table->text('job_benefits')->nullable()->after('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'task_category',
                'skills_required',
                'pricing_type',
                'hourly_rate',
                'fixed_price',
                'experience_level',
                'project_duration',
                'job_type',
                'salary_range_min',
                'salary_range_max',
                'job_location',
                'qualifications_required',
                'application_deadline',
                'company_name',
                'job_benefits',
            ]);
        });
    }
};
