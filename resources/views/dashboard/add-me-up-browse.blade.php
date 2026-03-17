@extends('layouts.dashboard')

@section('title', 'Browse Public Contact Lists')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Browse Public Lists</h1>
                <p class="text-purple-100">Discover public contact lists from other users</p>
            </div>
            <a href="{{ route('dashboard.add-me-up') }}" 
               class="bg-white text-purple-600 px-6 py-3 rounded-lg hover:bg-purple-50 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to My Lists
            </a>
        </div>
    </div>

    <!-- Public Lists -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-900">Available Public Lists</h2>
        </div>
        
        @if($publicLists->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach($publicLists as $list)
                    <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $list->name }}</h3>
                                <p class="text-sm text-gray-500">by {{ $list->user->fname ?? 'Unknown' }}</p>
                            </div>
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                Public
                            </span>
                        </div>
                        
                        <p class="text-gray-600 mb-4">{{ $list->description ?? 'No description provided' }}</p>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $list->contacts_count }} contacts
                            </span>
                            <a href="{{ route('dashboard.add-me-up.list-detail', $list->id) }}" 
                               class="text-purple-600 hover:text-purple-700 font-medium">
                                View Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="p-6 border-t border-gray-100">
                {{ $publicLists->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-gray-500 mb-4">No public lists available yet</p>
                <p class="text-sm text-gray-400">Be the first to create a public list!</p>
            </div>
        @endif
    </div>
</div>
@endsection
