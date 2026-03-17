@extends('layouts.main')

@section('title', 'Earn - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Hero Banner -->
    <div class="bg-gradient-to-r from-[#2C418F] via-[#2C418F]/80 to-blue-600 rounded-2xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-4">
                <h1 class="text-3xl font-bold">Choose Your Earning Path</h1>
                <p class="text-white/90 text-lg max-w-xl">
                    Select how you want to earn and start making money today
                </p>
                <div class="flex gap-3 flex-wrap">
                    <a href="/dashboard/earn/tasks" class="bg-white text-[#2C418F] px-6 py-3 rounded-xl font-semibold flex items-center gap-2 hover:bg-gray-100 transition-colors">
                        Find Tasks <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="/dashboard/advertise" class="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 hover:bg-white/30 transition-colors">
                        Post Adverts
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="/dashboard/earn/tasks" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all">
            <div class="p-3 rounded-xl bg-green-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-zinc-800">Find Tasks</h3>
                <p class="text-sm text-zinc-500">Browse available social media tasks</p>
            </div>
        </a>
        <a href="/dashboard/earn/tasks-history" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all">
            <div class="p-3 rounded-xl bg-blue-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-zinc-800">Task History</h3>
                <p class="text-sm text-zinc-500">View your completed tasks and earnings</p>
            </div>
        </a>
        <a href="/dashboard/earn/connect-accounts" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all">
            <div class="p-3 rounded-xl bg-purple-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-zinc-800">Connect Accounts</h3>
                <p class="text-sm text-zinc-500">Link your social media accounts</p>
            </div>
        </a>
    </div>

    <!-- Earning Options -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-6">Ways to Earn</h2>
        
        <div class="grid md:grid-cols-3 gap-4">
            <a href="/dashboard/earn/tasks" class="group bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-lg hover:border-[#2C418F]/20 transition-all">
                <div class="p-4 rounded-2xl bg-green-500 text-white w-fit mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
                </div>
                <h3 class="text-lg font-bold text-zinc-800 mb-2">Complete Tasks</h3>
                <p class="text-sm text-zinc-500">Earn money by completing simple social media tasks</p>
                <div class="mt-4 flex items-center text-[#2C418F] font-medium">
                    Start Earning <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
            </a>
            
            <a href="/dashboard/advertise" class="group bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-lg hover:border-[#2C418F]/20 transition-all">
                <div class="p-4 rounded-2xl bg-blue-500 text-white w-fit mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16h.01"/><path d="M12 11h.01"/></svg>
                </div>
                <h3 class="text-lg font-bold text-zinc-800 mb-2">Post Adverts</h3>
                <p class="text-sm text-zinc-500">Promote your products to thousands of users</p>
                <div class="mt-4 flex items-center text-[#2C418F] font-medium">
                    Create Ad <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
            </a>
            
            <a href="/dashboard/earn/resell" class="group bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-lg hover:border-[#2C418F]/20 transition-all">
                <div class="p-4 rounded-2xl bg-purple-500 text-white w-fit mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                </div>
                <h3 class="text-lg font-bold text-zinc-800 mb-2">Resell Products</h3>
                <p class="text-sm text-zinc-500">Sell products and earn commissions</p>
                <div class="mt-4 flex items-center text-[#2C418F] font-medium">
                    Start Selling <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
