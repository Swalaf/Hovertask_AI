@extends('layouts.dashboard')

@section('title', 'Dashboard - Hovertask')

@section('main')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-[#2C418F] rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold">
                    Welcome back, {{ Auth::user()->fname ?? 'User' }}!
                </h1>
                <p class="text-white/80 text-sm mt-1">
                    Here's an overview of your account.
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('dashboard.advertise.post') }}" class="bg-white text-[#2C418F] px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                    + Create Ad
                </a>
                <a href="{{ route('dashboard.earn') }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/30 transition-colors">
                    Start Earning
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid - Simplified -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Wallet Balance -->
        <div class="bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500 mb-1">Wallet Balance</p>
            <p class="text-2xl font-bold text-[#2C418F]">₦{{ number_format(Auth::user()->balance ?? 0) }}</p>
            <a href="{{ route('dashboard.fund.wallet') }}" class="text-sm text-[#2C418F] mt-2 inline-block hover:underline">
                Fund Wallet →
            </a>
        </div>

        <!-- Active Adverts -->
        <div class="bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500 mb-1">Active Adverts</p>
            <p class="text-2xl font-bold text-[#2C418F]">{{ Auth::user()->advertise_count ?? 0 }}</p>
            <a href="{{ route('dashboard.earn.adverts') }}" class="text-sm text-[#2C418F] mt-2 inline-block hover:underline">
                View Campaigns →
            </a>
        </div>

        <!-- Tasks Completed -->
        <div class="bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500 mb-1">Tasks Completed</p>
            <p class="text-2xl font-bold text-[#2C418F]">{{ Auth::user()->task_count ?? 0 }}</p>
            <a href="{{ route('dashboard.earn.tasks') }}" class="text-sm text-[#2C418F] mt-2 inline-block hover:underline">
                Find Tasks →
            </a>
        </div>

        <!-- Membership -->
        <div class="bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500 mb-1">Membership</p>
            <p class="text-2xl font-bold text-[#2C418F]">{{ (Auth::user()->is_member ?? false) ? 'Premium' : 'Free' }}</p>
            <a href="#" class="text-sm text-[#2C418F] mt-2 inline-block hover:underline">
                Upgrade →
            </a>
        </div>
    </div>

    <!-- Quick Actions - Simplified -->
    <div class="bg-white rounded-xl p-5 border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
            <a href="{{ route('dashboard.advertise.post') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 transition-all border border-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Post Ad</span>
            </a>
            <a href="{{ route('dashboard.earn.tasks') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 transition-all border border-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Find Tasks</span>
            </a>
            <a href="{{ route('dashboard.marketplace') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 transition-all border border-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Marketplace</span>
            </a>
            <a href="{{ route('dashboard.earn.resell') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 transition-all border border-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Resell</span>
            </a>
            <a href="{{ route('dashboard.fund.wallet') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 transition-all border border-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Fund Wallet</span>
            </a>
            <a href="{{ route('dashboard.refer') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 transition-all border border-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Refer</span>
            </a>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Available Tasks -->
        <div class="bg-white rounded-xl p-5 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Available Tasks</h2>
                <a href="{{ route('dashboard.earn.tasks') }}" class="text-sm text-[#2C418F] hover:underline">
                    View All →
                </a>
            </div>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800 text-sm">Like & Follow</p>
                            <p class="text-xs text-gray-500">500+ available</p>
                        </div>
                    </div>
                    <span class="font-semibold text-[#2C418F]">₦500</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800 text-sm">Share Post</p>
                            <p class="text-xs text-gray-500">200+ available</p>
                        </div>
                    </div>
                    <span class="font-semibold text-[#2C418F]">₦800</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800 text-sm">Comment</p>
                            <p class="text-xs text-gray-500">150+ available</p>
                        </div>
                    </div>
                    <span class="font-semibold text-[#2C418F]">₦1,200</span>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-xl p-5 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Recent Transactions</h2>
                <a href="{{ route('dashboard.transactions') }}" class="text-sm text-[#2C418F] hover:underline">
                    View All →
                </a>
            </div>
            <div class="text-center py-8 text-gray-500">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <p>No recent transactions</p>
                <p class="text-xs mt-1 text-gray-400">Your transaction history will appear here</p>
            </div>
        </div>
    </div>
</div>
@endsection
