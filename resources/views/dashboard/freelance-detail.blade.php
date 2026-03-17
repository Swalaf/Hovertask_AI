@extends('layouts.dashboard')

@section('main')
<div class="space-y-6">
    <!-- Back Button -->
    <a href="{{ route('dashboard.freelance.browse') }}" class="inline-flex items-center gap-2 text-zinc-600 hover:text-zinc-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to Browse
    </a>

    <!-- Project Detail -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-zinc-800 mb-2">{{ $task->title }}</h1>
                <div class="flex items-center gap-4 text-sm text-zinc-500">
                    <span>Posted {{ $task->created_at->diffForHumans() }}</span>
                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">
                        {{ $task->status ?? 'Active' }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-purple-600">₦{{ number_format($task->payment_per_task ?? $task->task_amount ?? 0) }}</div>
                @if($task->pricing_type === 'hourly')
                <div class="text-sm text-zinc-500">per hour</div>
                @else
                <div class="text-sm text-zinc-500">Fixed Price</div>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-zinc-800 mb-3">Project Description</h2>
            <p class="text-zinc-600 whitespace-pre-wrap">{{ $task->description }}</p>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-zinc-800 mb-3">Project Details</h3>
                <div class="space-y-2 text-sm">
                    @if($task->category)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Category:</span>
                        <span class="text-zinc-800 font-medium">{{ ucfirst($task->category) }}</span>
                    </div>
                    @endif
                    @if($task->experience_level)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Experience Level:</span>
                        <span class="text-zinc-800 font-medium">{{ ucfirst($task->experience_level) }}</span>
                    </div>
                    @endif
                    @if($task->project_duration)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Duration:</span>
                        <span class="text-zinc-800 font-medium">
                            @switch($task->project_duration)
                                @case('less_than_1_month') Less than 1 month @break
                                @case('1_3_months') 1-3 months @break
                                @case('3_6_months') 3-6 months @break
                                @case('more_than_6_months') More than 6 months @break
                            @endswitch
                        </span>
                    </div>
                    @endif
                    @if($task->location)
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Location:</span>
                        <span class="text-zinc-800 font-medium">{{ $task->location }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-zinc-800 mb-3">Skills Required</h3>
                @if($task->skills_required)
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $task->skills_required) as $skill)
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                        {{ trim($skill) }}
                    </span>
                    @endforeach
                </div>
                @else
                <p class="text-zinc-500 text-sm">No specific skills listed</p>
                @endif
            </div>
        </div>

        <!-- Posted By -->
        @if($task->user)
        <div class="border-t border-zinc-200 pt-6">
            <h2 class="text-lg font-semibold text-zinc-800 mb-3">Posted By</h2>
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <span class="text-purple-600 font-medium text-lg">{{ substr($task->user->fname ?? 'U', 0, 1) }}</span>
                </div>
                <div>
                    <div class="font-medium text-zinc-800">{{ $task->user->fname }} {{ $task->user->lname ?? '' }}</div>
                    <div class="text-sm text-zinc-500">Member since {{ $task->user->created_at->format('M Y') }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="border-t border-zinc-200 pt-6 mt-6 flex gap-4">
            <button class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 font-medium transition">
                Apply Now
            </button>
            <a href="{{ route('dashboard.freelance.browse') }}" class="border border-zinc-300 text-zinc-700 px-6 py-3 rounded-lg hover:bg-zinc-50 font-medium transition">
                Browse More Projects
            </a>
        </div>
    </div>
</div>
@endsection
