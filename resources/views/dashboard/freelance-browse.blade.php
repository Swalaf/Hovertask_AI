@extends('layouts.dashboard')

@section('main')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <a href="/dashboard/earn" class="mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold mb-2">Freelance Opportunities</h1>
                    <p class="text-purple-100">Find freelance work and projects</p>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="/images/Media_Sosial_Pictures___Freepik-removebg-preview 2.png" alt="Freelance" class="w-40" />
            </div>
        </div>
    </div>

    <!-- Tab Switcher -->
    <div class="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <a href="/dashboard/freelance/browse" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium bg-white text-purple-600 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Browse Projects
        </a>
        <a href="/dashboard/freelance/my-tasks" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            My Projects
        </a>
        <a href="/dashboard/freelance/create" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            Post Project
        </a>
    </div>

    <!-- Info Banner -->
    <div class="bg-purple-50 border border-purple-100 rounded-xl p-4">
        <p class="text-sm text-purple-800">
            <span class="font-semibold">How it works:</span> Browse freelance projects and submit proposals. 
            Get hired and earn by completing projects.
        </p>
    </div>

    <!-- Available Freelance Projects -->
    @if($freelanceTasks->isEmpty())
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <p class="text-gray-500 mb-4">No freelance projects available at the moment.</p>
        <a href="/dashboard/freelance/create" class="text-purple-600 hover:text-purple-700 font-medium">
            Post your first project
        </a>
    </div>
    @else
    <div class="grid gap-4">
        @foreach($freelanceTasks as $task)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-zinc-800 mb-2">
                        <a href="{{ route('dashboard.freelance.detail', $task->id) }}" class="hover:text-purple-600">
                            {{ $task->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-zinc-600 mb-3 line-clamp-2">{{ $task->description }}</p>
                    <div class="flex flex-wrap gap-4 text-sm text-zinc-500">
                        @if($task->location)
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $task->location }}
                        </span>
                        @endif
                        @if($task->platforms)
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M3 9h18"/></svg>
                            {{ $task->platforms }}
                        </span>
                        @endif
                        @if($task->payment_per_task)
                        <span class="flex items-center gap-1 text-green-600 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            ₦{{ number_format($task->payment_per_task) }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="ml-4">
                    <a href="{{ route('dashboard.freelance.detail', $task->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $freelanceTasks->links() }}
    </div>
    @endif
</div>
@endsection
