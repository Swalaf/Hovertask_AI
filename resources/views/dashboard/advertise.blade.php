@extends('layouts.main')

@section('title', 'Advertise - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-[#2C418F] to-blue-700 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <a href="/dashboard" class="mt-1 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold mb-2">Advertise Your Products & Services</h1>
                    <p class="text-blue-100">Reach thousands of active users on our platform every day</p>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="/images/Premium_Photo___Composition_with_smartphone_used_for_digital_shopping_and_online_ordering-removebg-preview 2.png" alt="Advertise" class="w-40" />
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="/dashboard/advertise/post-advert" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all">
            <div class="p-3 rounded-xl bg-[#2C418F] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-zinc-800">Create New Campaign</h3>
                <p class="text-sm text-zinc-500">Start a new advert or engagement campaign</p>
            </div>
        </a>
        <a href="/dashboard/advertise/history" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all">
            <div class="p-3 rounded-xl bg-blue-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-zinc-800">View All Campaigns</h3>
                <p class="text-sm text-zinc-500">See your advert and engagement task history</p>
            </div>
        </a>
        <a href="/dashboard/advertise/history" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all">
            <div class="p-3 rounded-xl bg-green-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16h.01"/><path d="M12 11h.01"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-zinc-800">Track Performance</h3>
                <p class="text-sm text-zinc-500">Monitor your campaign results</p>
            </div>
        </a>
    </div>

    <!-- Advert Options -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-6">Choose Campaign Type</h2>
        
        <div class="grid md:grid-cols-2 gap-4">
            <a href="/dashboard/advertise/post-advert" class="group bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-lg hover:border-[#2C418F]/20 transition-all">
                <div class="p-4 rounded-2xl bg-blue-500 text-white w-fit mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16h.01"/><path d="M12 11h.01"/></svg>
                </div>
                <h3 class="text-lg font-bold text-zinc-800 mb-2">Post Advert</h3>
                <p class="text-sm text-zinc-500">Promote your products or services to targeted audiences</p>
                <div class="mt-4 flex items-center text-[#2C418F] font-medium">
                    Get Started <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
            </a>
            
            <a href="/dashboard/advertise/post-advert" class="group bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-lg hover:border-[#2C418F]/20 transition-all">
                <div class="p-4 rounded-2xl bg-purple-500 text-white w-fit mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-zinc-800 mb-2">Engagement Tasks</h3>
                <p class="text-sm text-zinc-500">Get more likes, comments, shares, and followers</p>
                <div class="mt-4 flex items-center text-[#2C418F] font-medium">
                    Get Started <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
            </a>
        </div>
    </div>

    <!-- Features -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-6">Why Advertise With Us?</h2>
        
        <div class="grid md:grid-cols-3 gap-4">
            <div class="text-center p-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-800 mb-1">Targeted Audience</h3>
                <p class="text-sm text-zinc-500">Reach users based on location, interests, and behavior</p>
            </div>
            <div class="text-center p-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-800 mb-1">Verified Users</h3>
                <p class="text-sm text-zinc-500">All users are verified for authentic engagement</p>
            </div>
            <div class="text-center p-4">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-800 mb-1">Real-time Analytics</h3>
                <p class="text-sm text-zinc-500">Track your campaign performance in real-time</p>
            </div>
        </div>
    </div>
</div>
@endsection
