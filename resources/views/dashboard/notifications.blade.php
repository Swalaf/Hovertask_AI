@extends('layouts.main')

@section('title', 'Notifications - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Notifications</h1>
        
        <div class="space-y-3">
            @forelse([] as $notification)
            <div class="flex items-start gap-4 p-4 bg-zinc-50 rounded-lg">
                <div class="w-10 h-10 bg-[#2C418F] rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-zinc-800">{{ $notification->title }}</p>
                    <p class="text-sm text-zinc-500">{{ $notification->message }}</p>
                    <p class="text-xs text-zinc-400 mt-1">{{ $notification->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>
            @empty
            <p class="text-zinc-500 text-center py-8">No notifications</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
