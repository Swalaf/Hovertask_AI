@extends('layouts.main')

@section('title', 'Refer & Earn - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">Refer Friends & Earn Rewards! 🎁</h1>
                <p class="text-pink-100 text-lg max-w-xl">
                    Invite friends and earn ₦500 for each successful referral
                </p>
                <div class="flex items-center gap-2 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12v10H4V12"/><path d="M2 7h20v5H2z"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                    <span class="text-sm font-medium">Earn ₦500 per referral</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Referral Link -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-4">Your Referral Link</h2>
        <div class="flex flex-col md:flex-row gap-3">
            <input type="text" value="https://hovertask.com/signup/?ref={{ Auth::user()->referral_code ?? 'YOURCODE' }}" readonly class="flex-1 p-3 rounded-lg border border-zinc-200 bg-zinc-50 text-zinc-600" />
            <button class="bg-[#2C418F] text-white px-6 py-3 rounded-lg hover:bg-[#1a2d6b]">Copy Link</button>
        </div>
    </div>

    <!-- How it Works -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-6">How It Works</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-12 h-12 bg-[#2C418F] rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-white font-bold">1</span>
                </div>
                <h3 class="font-semibold text-zinc-800 mb-1">Copy Link</h3>
                <p class="text-sm text-zinc-500">Copy your unique referral link above</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-[#2C418F] rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-white font-bold">2</span>
                </div>
                <h3 class="font-semibold text-zinc-800 mb-1">Share</h3>
                <p class="text-sm text-zinc-500">Share via social media, email, or messaging apps</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-[#2C418F] rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-white font-bold">3</span>
                </div>
                <h3 class="font-semibold text-zinc-800 mb-1">Earn</h3>
                <p class="text-sm text-zinc-500">Get ₦500 for each friend who signs up</p>
            </div>
        </div>
    </div>

    <!-- Your Referrals -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-4">Your Referrals</h2>
        <div class="text-center py-8 text-zinc-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-zinc-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m22 2-10 10"/><path d="m22 2-4 4"/></svg>
            <h4 class="font-medium text-zinc-800 mb-2">No Referrals Yet</h4>
            <p class="text-sm">Start sharing your referral link to earn rewards!</p>
        </div>
    </div>
</div>
@endsection
