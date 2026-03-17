@extends('layouts.main')

@section('title', 'Task History - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <a href="/dashboard/earn/tasks" class="mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold mb-2">My Task History</h1>
                    <p class="text-green-100">View all your completed tasks and earnings</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $completedTasks->count() ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Completed Tasks</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">₦{{ number_format($completedTasks->sum('earnings') ?? 0) }}</p>
                    <p class="text-sm text-gray-500">Total Earnings</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $pendingTasks->count() ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Pending Tasks</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Switcher -->
    <div class="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <a href="/dashboard/earn/tasks" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            Available Tasks
        </a>
        <span class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium bg-white text-[#2C418F] shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Completed
        </span>
    </div>

    <!-- Completed Tasks List -->
    @if($completedTasks->count() > 0)
    <div class="space-y-3">
        @foreach($completedTasks as $task)
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $task->title ?? 'Task #' . $task->id }}</h3>
                        <p class="text-sm text-gray-500">{{ $task->description ?? 'Completed task' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">₦{{ number_format($task->earnings ?? 0) }}</p>
                    <p class="text-xs text-gray-500">{{ $task->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-zinc-50 rounded-xl p-8 text-center">
        <div class="w-16 h-16 bg-zinc-200 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h3 class="text-lg font-semibold text-zinc-800 mb-2">No completed tasks yet</h3>
        <p class="text-zinc-500 text-sm mb-4">Start completing tasks to earn money</p>
        <a href="/dashboard/earn/tasks" class="inline-flex items-center gap-2 bg-[#2C418F] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#2C418F]/90 transition-colors">
            Find Tasks <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
    @endif

    <!-- Pagination -->
    @if(isset($completedTasks) && $completedTasks->hasPages())
    <div class="flex justify-center">
        {{ $completedTasks->links() }}
    </div>
    @endif
</div>
@endsection
