@extends('layouts.main')

@section('title', 'Tasks - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <a href="/dashboard/earn" class="mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold mb-2">Find Tasks & Earn</h1>
                    <p class="text-green-100">Complete simple tasks and earn money instantly</p>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="/images/Media_Sosial_Pictures___Freepik-removebg-preview 2.png" alt="Tasks" class="w-40" />
            </div>
        </div>
    </div>

    <!-- Tab Switcher -->
    <div class="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <a href="/dashboard/earn/tasks" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium bg-white text-[#2C418F] shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            Social Tasks
        </a>
        <a href="/dashboard/freelance/browse" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Freelance Tasks
        </a>
        <a href="/dashboard/jobs/browse" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            Jobs
        </a>
    </div>

    <!-- Info Banner -->
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
        <p class="text-sm text-blue-800">
            <span class="font-semibold">How it works:</span> Complete social media tasks to earn rewards. 
            Your earnings are credited instantly after task verification.
        </p>
    </div>

    <!-- Available Tasks -->
    @if($availableTasks->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($availableTasks as $task)
        <div class="bg-white rounded-xl p-5 border border-zinc-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                    {{ $task->task_count_remaining ?? $task->task_count_total }} left
                </span>
            </div>
            <h3 class="font-semibold text-zinc-800 mb-2">{{ $task->title }}</h3>
            <p class="text-sm text-zinc-500 mb-4 line-clamp-2">{{ $task->description }}</p>
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-lg font-bold text-[#2C418F]">₦{{ number_format($task->payment_per_task) }}</span>
                    <span class="text-xs text-zinc-500">/ task</span>
                </div>
                <a href="{{ route('dashboard.earn.task.detail', $task->id) }}" class="px-4 py-2 bg-[#2C418F] text-white text-sm font-medium rounded-lg hover:bg-[#2C418F]/90 transition-colors">
                    Start Task
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $availableTasks->links() }}
    </div>
    @else
    <div class="bg-zinc-50 rounded-xl p-8 text-center">
        <div class="w-16 h-16 bg-zinc-200 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        </div>
        <h3 class="text-lg font-semibold text-zinc-800 mb-2">No Tasks Available</h3>
        <p class="text-zinc-500 text-sm mb-4">Check back later for new tasks</p>
        <a href="{{ route('dashboard.earn.tasks.history') }}" class="inline-flex items-center gap-2 text-[#2C418F] font-medium hover:underline">
            Check completed tasks <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
    @endif
</div>
@endsection
