@extends('layouts.public')

@section('title', 'Marketplace - Hovertask')
@section('meta_description', 'Browse and buy products on Hovertask Marketplace. Discover amazing deals, become a reseller, or list your own products for sale.')
@section('meta_keywords', 'marketplace, buy, sell, products, reseller, online shopping, Nigeria')

@section('content')
<div class="min-h-full bg-gradient-to-br from-slate-50 via-white to-blue-50/30">
    <!-- Enhanced Header -->
    <div class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-slate-800">
                            Marketplace
                        </h1>
                        <p class="text-sm text-slate-500 hidden sm:block">
                            Buy, sell, and earn effortlessly
                        </p>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="hidden md:flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="p-2 rounded-lg bg-blue-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Products</p>
                            <p class="font-semibold text-blue-600">{{ $products->total() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="p-2 rounded-lg bg-green-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Trending</p>
                            <p class="font-semibold text-green-600">{{ $products->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Hero Section -->
        <div class="relative rounded-2xl overflow-hidden mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-[#2C418F] via-[#2C418F]/90 to-purple-600"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-60 h-60 bg-amber-300 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>
            </div>
            <div class="relative z-10 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="text-center sm:text-left">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white mb-2">
                        Connect, Trade & Earn
                    </h2>
                    <p class="text-white/80 text-sm sm:text-base max-w-md">
                        Discover amazing products or start selling today. Join thousands of buyers and sellers on Hovertask Marketplace.
                    </p>
                    <div class="flex flex-wrap justify-center sm:justify-start gap-3 mt-4">
                        @auth
                        <a href="{{ route('dashboard.marketplace') }}" class="inline-block bg-white text-[#2C418F] font-medium px-4 py-2 rounded-lg">
                            Sell Now
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="inline-block bg-white text-[#2C418F] font-medium px-4 py-2 rounded-lg">
                            Sell Now
                        </a>
                        @endauth
                        <a href="#products" class="inline-block border border-white text-white px-4 py-2 rounded-lg hover:bg-white/10">
                            Browse Products
                        </a>
                    </div>
                </div>
                <div class="w-full sm:w-auto max-w-md">
                    <form action="{{ route('marketplace') }}" method="GET" class="bg-white rounded-xl p-2 flex items-center gap-2">
                        <input type="text" name="search" class="flex-1 p-2 outline-none text-slate-700" placeholder="Search products..." value="{{ request('search') }}" />
                        <button type="submit" class="bg-[#2C418F] text-white p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
            <a href="#products" class="block">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">Browse Products</h3>
                            <p class="text-xs text-slate-500">Find amazing deals</p>
                        </div>
                    </div>
                </div>
            </a>
            @auth
            <a href="{{ route('dashboard.marketplace') }}" class="block">
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-purple-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">List Your Product</h3>
                            <p class="text-xs text-slate-500">Start selling today</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard.earn.resell') }}" class="block">
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-amber-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">Become a Reseller</h3>
                            <p class="text-xs text-slate-500">Earn through promotion</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard') }}" class="block">
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">Dashboard</h3>
                            <p class="text-xs text-slate-500">Manage your account</p>
                        </div>
                    </div>
                </div>
            </a>
            @else
            <a href="{{ route('register') }}" class="block">
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-purple-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">List Your Product</h3>
                            <p class="text-xs text-slate-500">Start selling today</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('register') }}" class="block">
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-amber-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">Become a Reseller</h3>
                            <p class="text-xs text-slate-500">Earn through promotion</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('register') }}" class="block">
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-slate-800">Join Hovertask</h3>
                            <p class="text-xs text-slate-500">Create free account</p>
                        </div>
                    </div>
                </div>
            </a>
            @endauth
        </div>

        <!-- Main Content Grid with Categories Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6" id="products">
            <!-- Categories Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sticky top-24">
                    <h3 class="font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"/><path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"/></svg>
                        Categories
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('marketplace') }}" class="flex items-center justify-between p-2 rounded-lg bg-[#2C418F] text-white">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                All Products
                            </span>
                            <span class="text-xs opacity-70">{{ $products->total() }}</span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=electronics" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
                                Electronics
                            </span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=fashion" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>
                                Fashion
                            </span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=beauty" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-4.96.44 2.5 2.5 0 0 1-2.96-3.08 3 3 0 0 1-.34-5.58 2.5 2.5 0 0 1 1.32-4.24 2.5 2.5 0 0 1 1.98-3A2.5 2.5 0 0 1 9.5 2Z"/><path d="M14.5 2A2.5 2.5 0 0 0 12 4.5v15a2.5 2.5 0 0 0 4.96.44 2.5 2.5 0 0 0 2.96-3.08 3 3 0 0 0 .34-5.58 2.5 2.5 0 0 0-1.32-4.24 2.5 2.5 0 0 0-1.98-3A2.5 2.5 0 0 0 14.5 2Z"/></svg>
                                Beauty
                            </span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=home" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                Home
                            </span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=sports" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                                Sports
                            </span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=food" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/></svg>
                                Food
                            </span>
                        </a>
                        <a href="{{ route('marketplace') }}?category=services" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-100 text-slate-700">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                Services
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($products as $product)
                    <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 group">
                        <div class="relative aspect-square overflow-hidden bg-slate-100">
                            @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-slate-300" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                            @endif
                            @if($product->discount > 0)
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded-full">
                                -{{ $product->discount }}%
                            </div>
                            @endif
                        </div>
                        <div class="p-3 space-y-2">
                            <h3 class="font-medium text-sm text-slate-800 line-clamp-2 group-hover:text-[#2C418F] transition-colors">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold text-[#2C418F]">₦{{ number_format($product->price, 0) }}</span>
                                @if($product->discount > 0)
                                <span class="text-xs text-slate-400 line-through">₦{{ number_format($product->price * (1 + $product->discount/100), 0) }}</span>
                                @endif
                            </div>
                            
                            @auth
                            <!-- Show contact options for logged in users -->
                            <div class="pt-2 border-t border-slate-100">
                                <div class="flex gap-2">
                                    @if($product->user && $product->user->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->user->phone) }}" target="_blank" class="flex-1 bg-green-500 text-white text-center py-2 rounded-lg text-xs font-medium hover:bg-green-600 transition-colors flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                        WhatsApp
                                    </a>
                                    @endif
                                    <a href="tel:{{ $product->user->phone ?? '' }}" class="flex-1 bg-[#2C418F] text-white text-center py-2 rounded-lg text-xs font-medium hover:bg-[#1a2d6b] transition-colors flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                        Call
                                    </a>
                                </div>
                            </div>
                            @else
                            <!-- Show sign up prompt for guests -->
                            <div class="pt-2 border-t border-slate-100">
                                <a href="{{ route('login') }}" class="block w-full bg-slate-100 text-slate-600 text-center py-2 rounded-lg text-xs font-medium hover:bg-slate-200 transition-colors">
                                    Sign in to contact seller
                                </a>
                            </div>
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
                @else
                <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto text-slate-300 mb-4" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <h3 class="text-lg font-semibold text-slate-800 mb-2">No Products Found</h3>
                    <p class="text-slate-500 mb-4">There are no products available at the moment.</p>
                    @auth
                    <a href="{{ route('dashboard.marketplace') }}" class="inline-block bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">
                        List Your Product
                    </a>
                    @else
                    <a href="{{ route('register') }}" class="inline-block bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">
                        Start Selling
                    </a>
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
