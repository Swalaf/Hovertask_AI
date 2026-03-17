@extends('layouts.dashboard')

@section('main')
<div class="space-y-6">
    <!-- Back Button -->
    <a href="{{ route('dashboard.jobs.browse') }}" class="inline-flex items-center gap-2 text-zinc-600 hover:text-zinc-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to Browse Jobs
    </a>

    <!-- Job Detail -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-zinc-800 mb-2">{{ $job->title }}</h1>
                @if($job->company_name)
                <div class="text-lg text-zinc-600 mb-2">{{ $job->company_name }}</div>
                @endif
                <div class="flex items-center gap-4 text-sm text-zinc-500">
                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                        {{ $job->status ?? 'Active' }}
                    </span>
                    @if($job->job_type)
                    <span class="px-2 py-1 bg-zinc-100 text-zinc-800 rounded-full text-xs font-medium">
                        {{ ucfirst($job->job_type) }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="text-right">
                @if($job->salary_range_min || $job->salary_range_max)
                <div class="text-2xl font-bold text-blue-600">
                    @if($job->salary_range_min && $job->salary_range_max)
                        ₦{{ number_format($job->salary_range_min) }} - ₦{{ number_format($job->salary_range_max) }}
                    @elseif($job->salary_range_min)
                        ₦{{ number_format($job->salary_range_min) }}+
                    @else
                        ₦{{ number_format($job->salary_range_max) }}
                    @endif
                </div>
                <div class="text-sm text-zinc-500">Salary Range</div>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-zinc-800 mb-3">Job Description</h2>
            <p class="text-zinc-600 whitespace-pre-wrap">{{ $job->description }}</p>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-zinc-800 mb-3">Job Details</h3>
                <div class="space-y-2 text-sm">
                    @if($job->category)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Category:</span>
                        <span class="text-zinc-800 font-medium">{{ ucfirst($job->category) }}</span>
                    </div>
                    @endif
                    @if($job->job_type)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Job Type:</span>
                        <span class="text-zinc-800 font-medium">{{ ucfirst($job->job_type) }}</span>
                    </div>
                    @endif
                    @if($job->job_location)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Location:</span>
                        <span class="text-zinc-800 font-medium">{{ $job->job_location }}</span>
                    </div>
                    @endif
                    @if($job->application_deadline)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Application Deadline:</span>
                        <span class="text-zinc-800 font-medium">{{ \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            @if($job->qualifications_required)
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-zinc-800 mb-3">Required Qualifications</h3>
                <p class="text-sm text-zinc-600 whitespace-pre-wrap">{{ $job->qualifications_required }}</p>
            </div>
            @endif
        </div>

        @if($job->job_benefits)
        <!-- Benefits -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-zinc-800 mb-3">Job Benefits</h2>
            <p class="text-zinc-600 whitespace-pre-wrap">{{ $job->job_benefits }}</p>
        </div>
        @endif

        <!-- Posted By -->
        @if($job->user)
        <div class="border-t border-zinc-200 pt-6">
            <h2 class="text-lg font-semibold text-zinc-800 mb-3">Posted By</h2>
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-blue-600 font-medium text-lg">{{ substr($job->user->fname ?? 'U', 0, 1) }}</span>
                </div>
                <div>
                    <div class="font-medium text-zinc-800">{{ $job->company_name ?? 'Company' }}</div>
                    <div class="text-sm text-zinc-500">Member since {{ $job->user->created_at->format('M Y') }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="border-t border-zinc-200 pt-6 mt-6 flex gap-4">
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition">
                Apply Now
            </button>
            <a href="{{ route('dashboard.jobs.browse') }}" class="border border-zinc-300 text-zinc-700 px-6 py-3 rounded-lg hover:bg-zinc-50 font-medium transition">
                Browse More Jobs
            </a>
        </div>
    </div>
</div>
@endsection
