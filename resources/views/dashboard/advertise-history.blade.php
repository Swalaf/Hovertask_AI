@extends('layouts.main')

@section('title', 'Advert History - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Campaign History</h1>
                <p class="text-sm text-gray-500">View all your advert campaigns and their performance</p>
            </div>
            <a href="{{ route('dashboard.advertise.post') }}" class="bg-[#2C418F] text-white px-4 py-2 rounded-lg hover:bg-[#1a2d6b]">
                + New Campaign
            </a>
        </div>

        <!-- Filter Tabs -->
        <div class="flex gap-2 mb-6 border-b border-gray-200 pb-4">
            <button class="px-4 py-2 bg-[#2C418F] text-white rounded-lg text-sm">All</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm hover:bg-gray-200">Active</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm hover:bg-gray-200">Pending</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm hover:bg-gray-200">Completed</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm hover:bg-gray-200">Rejected</button>
        </div>

        @if($adverts && $adverts->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Campaign</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Platform</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Participants</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Budget</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Created</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adverts as $advert)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4">
                            <div class="font-medium text-gray-800">{{ $advert->title ?? 'Untitled Campaign' }}</div>
                            <div class="text-xs text-gray-500">{{ Str::limit($advert->description ?? 'No description', 40) }}</div>
                        </td>
                        <td class="py-4 px-4">
                            @if($advert->platforms)
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                {{ is_array($advert->platforms) ? implode(', ', $advert->platforms) : $advert->platforms }}
                            </span>
                            @else
                            <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-gray-700">
                            {{ $advert->no_of_status_post ?? 0 }}
                        </td>
                        <td class="py-4 px-4 text-gray-700 font-medium">
                            ₦{{ number_format($advert->estimated_cost ?? 0, 0) }}
                        </td>
                        <td class="py-4 px-4">
                            @if(($advert->status ?? 'pending') === 'active')
                            <span class="inline-flex items-center px-2 py-1 bg-green-50 text-green-700 rounded-full text-xs">Active</span>
                            @elseif(($advert->status ?? 'pending') === 'pending')
                            <span class="inline-flex items-center px-2 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs">Pending</span>
                            @elseif(($advert->status ?? 'pending') === 'completed')
                            <span class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 rounded-full text-xs">Completed</span>
                            @elseif(($advert->status ?? 'pending') === 'rejected')
                            <span class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 rounded-full text-xs">Rejected</span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 bg-gray-50 text-gray-700 rounded-full text-xs">{{ $advert->status ?? 'Unknown' }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-gray-500 text-sm">
                            {{ $advert->created_at ? $advert->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex gap-2">
                                <a href="#" class="text-[#2C418F] hover:underline text-sm">View</a>
                                <a href="#" class="text-gray-500 hover:text-gray-700 text-sm">Stats</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $adverts->links() }}
        </div>
        @else
        <div class="text-center py-12 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16h.01"/></svg>
            <p class="mb-2">No campaign history yet.</p>
            <p class="text-sm text-gray-400 mb-4">Create your first campaign to start tracking its performance.</p>
            <a href="{{ route('dashboard.advertise.post') }}" class="inline-block bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">Create Campaign</a>
        </div>
        @endif
    </div>
</div>
@endsection
