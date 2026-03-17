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
                    <h1 class="text-2xl font-bold mb-2">My Freelance Projects</h1>
                    <p class="text-purple-100">Manage your posted freelance projects</p>
                </div>
            </div>
            <a href="/dashboard/freelance/create" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-medium hover:bg-purple-50 transition">
                + Post New Project
            </a>
        </div>
    </div>

    <!-- Tab Switcher -->
    <div class="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <a href="/dashboard/freelance/browse" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Browse Projects
        </a>
        <a href="/dashboard/freelance/my-tasks" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium bg-white text-purple-600 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            My Projects
        </a>
        <a href="/dashboard/freelance/create" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            Post Project
        </a>
    </div>

    <!-- My Projects List -->
    @if($freelanceTasks->isEmpty())
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <p class="text-gray-500 mb-4">You haven't posted any freelance projects yet.</p>
        <a href="/dashboard/freelance/create" class="text-purple-600 hover:text-purple-700 font-medium">
            Post your first project
        </a>
    </div>
    @else
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($freelanceTasks as $task)
                <tr>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                        <div class="text-sm text-gray-500 line-clamp-1">{{ $task->description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">₦{{ number_format($task->payment_per_task ?? $task->task_amount ?? 0) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($task->status === 'active') bg-green-100 text-green-800
                            @elseif($task->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $task->status ?? 'pending' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $task->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dashboard.freelance.detail', $task->id) }}" class="text-purple-600 hover:text-purple-900 mr-3">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $freelanceTasks->links() }}
    </div>
    @endif
</div>
@endsection
