@extends('layouts.main')

@section('title', 'Task Details - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 text-white">
        <div class="flex items-start gap-4">
            <a href="/dashboard/earn/tasks" class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold mb-2">{{ $task->title }}</h1>
                <p class="text-green-100">Complete this task and earn ₦{{ number_format($task->payment_per_task) }}</p>
            </div>
        </div>
    </div>

    <!-- Task Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
                <h2 class="text-lg font-semibold text-zinc-800 mb-4">Task Description</h2>
                <p class="text-zinc-600 leading-relaxed">{{ $task->description }}</p>
            </div>

            <div class="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
                <h2 class="text-lg font-semibold text-zinc-800 mb-4">Task Instructions</h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">1</span>
                        <span class="text-zinc-600">Click the "Start Task" button below</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">2</span>
                        <span class="text-zinc-600">Complete the required social media action</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">3</span>
                        <span class="text-zinc-600">Take a screenshot as proof of completion</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">4</span>
                        <span class="text-zinc-600">Submit your completion below</span>
                    </li>
                </ul>
            </div>

            @if($task->platforms)
            <div class="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
                <h2 class="text-lg font-semibold text-zinc-800 mb-4">Platform</h2>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                        {{ ucfirst($task->platforms) }}
                    </span>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Reward Card -->
            <div class="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
                <h3 class="text-sm font-medium text-zinc-500 mb-4">Reward</h3>
                <div class="text-3xl font-bold text-[#2C418F] mb-4">₦{{ number_format($task->payment_per_task) }}</div>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-zinc-500">Available Slots</span>
                        <span class="font-medium text-zinc-800">{{ $task->task_count_remaining ?? $task->task_count_total }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-zinc-500">Total Slots</span>
                        <span class="font-medium text-zinc-800">{{ $task->task_count_total }}</span>
                    </div>
                </div>

                <form action="{{ route('dashboard.earn.task.complete', $task->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#2C418F] text-white py-3 rounded-lg font-medium hover:bg-[#2C418F]/90 transition-colors">
                        Complete Task
                    </button>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                <h3 class="text-sm font-semibold text-blue-800 mb-3">Tips for Approval</h3>
                <ul class="space-y-2 text-sm text-blue-700">
                    <li>• Make sure to follow all instructions carefully</li>
                    <li>• Take a clear screenshot as proof</li>
                    <li>• Ensure your profile is not private</li>
                    <li>• Complete the task within the deadline</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
