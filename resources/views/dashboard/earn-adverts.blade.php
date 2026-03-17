@extends('layouts.main')

@section('title', 'My Campaigns - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <a href="/dashboard/earn" class="mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold mb-2">My Campaigns</h1>
                    <p class="text-blue-100">Manage all your posted campaigns</p>
                </div>
            </div>
            <a href="{{ route('dashboard.advertise.post') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-50 transition">
                + Create New Campaign
            </a>
        </div>
    </div>

    <!-- Tab Switcher -->
    <div class="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <a href="{{ route('dashboard.earn.adverts') }}" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium bg-white text-[#2C418F] shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16h.01"/><path d="M12 11h.01"/></svg>
            Adverts
        </a>
        <a href="{{ route('dashboard.freelance.my-tasks') }}" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Freelance Tasks
        </a>
        <a href="{{ route('dashboard.jobs.my-jobs') }}" class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-zinc-500 hover:text-zinc-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            Jobs
        </a>
    </div>

    <!-- Campaigns Table -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        @if($advertises && $advertises->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-zinc-200">
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Campaign</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Type</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Platform</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Posts</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Budget</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Created</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advertises as $advert)
                    <tr class="border-b border-zinc-100 hover:bg-zinc-50">
                        <td class="py-4 px-4">
                            <div class="font-medium text-zinc-800">{{ $advert->title ?? 'N/A' }}</div>
                            <div class="text-xs text-zinc-500">{{ Str::limit($advert->description ?? 'No description', 50) }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-50 text-blue-700 rounded-full text-xs">
                                Advert
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-50 text-green-700 rounded-full text-xs">
                                {{ $advert->platforms ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-zinc-700">
                            {{ $advert->no_of_status_post ?? 0 }}
                        </td>
                        <td class="py-4 px-4 text-zinc-700 font-medium">
                            ₦{{ number_format($advert->estimated_cost ?? 0, 0) }}
                        </td>
                        <td class="py-4 px-4">
                            @if($advert->status === 'active')
                            <span class="inline-flex items-center px-2 py-1 bg-green-50 text-green-700 rounded-full text-xs">Active</span>
                            @elseif($advert->status === 'pending')
                            <span class="inline-flex items-center px-2 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs">Pending</span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 bg-gray-50 text-gray-700 rounded-full text-xs">{{ $advert->status ?? 'Unknown' }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-zinc-500 text-sm">
                            {{ $advert->created_at->diffForHumans() }}
                        </td>
                        <td class="py-4 px-4">
                            <button class="text-[#2C418F] hover:text-[#1a2d6b] font-medium text-sm">View Details</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $advertises->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-zinc-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16h.01"/><path d="M12 11h.01"/></svg>
            </div>
            <h3 class="text-lg font-semibold text-zinc-800 mb-2">No Campaigns Yet</h3>
            <p class="text-zinc-500 text-sm mb-4">You haven't created any advert campaigns yet.</p>
            <a href="{{ route('dashboard.advertise.post') }}" class="inline-flex items-center gap-2 text-[#2C418F] font-medium hover:underline">
                Create your first campaign <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
