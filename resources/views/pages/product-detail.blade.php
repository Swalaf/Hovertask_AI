@extends('layouts.app')

@section('title', $product->name . ' - Hovertask Marketplace')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('marketplace') }}" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Marketplace
                </a>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">Sign In</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Product Detail -->
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="bg-white rounded-xl shadow-sm p-4">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
                @else
                    <div class="w-full h-96 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <!-- Category -->
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium mb-4">
                    {{ $product->category }}
                </span>

                <!-- Name -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="text-4xl font-bold text-emerald-600 mb-6">
                    ₦{{ number_format($product->price, 2) }}
                </div>

                <!-- Stock Status -->
                <div class="flex items-center gap-2 mb-6">
                    @if($product->stock > 0)
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="text-green-600 font-medium">In Stock ({{ $product->stock }} available)</span>
                    @else
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        <span class="text-red-600 font-medium">Out of Stock</span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Seller Info -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Sold by</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                            <span class="text-emerald-600 font-bold">{{ strtoupper(substr($product->user->name ?? 'S', 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $product->user->name ?? 'Seller' }}</p>
                            @if($product->user && $product->user->created_at)
                                <p class="text-sm text-gray-500">Member since {{ $product->user->created_at->format('M Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @auth
                    @if($product->stock > 0)
                        <form action="#" method="POST" class="flex gap-4">
                            @csrf
                            <button type="submit" class="flex-1 bg-emerald-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                                Buy Now
                            </button>
                            <button type="button" class="px-6 py-3 border border-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 py-3 px-6 rounded-lg font-medium cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full bg-emerald-600 text-white text-center py-3 px-6 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                        Sign in to Purchase
                    </a>
                @endauth
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('marketplace.product', $related->id) }}" class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    @if($related->image)
                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $related->name }}</h3>
                        <p class="text-emerald-600 font-bold">₦{{ number_format($related->price, 2) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </main>
</div>
@endsection
