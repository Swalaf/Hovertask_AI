@extends('layouts.main')

@section('title', 'Resell - Hovertask')

@section('content')
<div class="space-y-6">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-8 text-white">
        <div class="flex items-start gap-4 mb-6">
            <a href="{{ route('dashboard.earn') }}" class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-2">
                    Hot-selling Products to Maximize Your Earnings
                </h1>
                <p class="text-white/80">
                    Get access to high-demand products and services at discounted rates, resell, and earn profits instantly!
                </p>
            </div>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('dashboard.earn.resell') }}" method="GET" class="max-w-xl">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" name="search" placeholder="Search for products to resell..." class="w-full pl-12 pr-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-[#2C418F]/50 outline-none text-zinc-800" value="{{ request('search') }}" />
            </div>
        </form>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-4 border border-zinc-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-green-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <p class="text-xs text-zinc-500">My Sales</p>
                    <p class="text-lg font-bold text-zinc-800">₦0</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-zinc-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-blue-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div>
                    <p class="text-xs text-zinc-500">My Links</p>
                    <p class="text-lg font-bold text-zinc-800">{{ $resellers->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-zinc-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-purple-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <p class="text-xs text-zinc-500">Clicks</p>
                    <p class="text-lg font-bold text-zinc-800">0</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-zinc-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-amber-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                </div>
                <div>
                    <p class="text-xs text-zinc-500">Profit Margin</p>
                    <p class="text-lg font-bold text-zinc-800">10-30%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-zinc-800">Available Products for Resale</h2>
            <a href="{{ route('dashboard.marketplace') }}" class="text-[#2C418F] hover:underline text-sm">
                List Your Product →
            </a>
        </div>
        
        @if($products && $products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
            <div class="border border-zinc-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                <div class="aspect-square bg-zinc-100 relative">
                    @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-zinc-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                    @endif
                    @if($product->discount > 0)
                    <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">-{{ $product->discount }}%</div>
                    @endif
                </div>
                <div class="p-3">
                    <h3 class="font-medium text-zinc-800 text-sm mb-1 line-clamp-2">{{ $product->name }}</h3>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg font-bold text-[#2C418F]">₦{{ number_format($product->price, 0) }}</span>
                    </div>
                    <button onclick="createResellerLink({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})" class="w-full bg-[#2C418F] text-white py-2 rounded-lg text-sm hover:bg-[#1a2d6b]">
                        Create Resell Link
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center py-12 text-zinc-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-zinc-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
            <p>No products available for resale yet.</p>
            <p class="text-sm mt-2">Check back later for new products to sell.</p>
            <a href="{{ route('dashboard.marketplace') }}" class="inline-block mt-4 bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">
                Browse Marketplace
            </a>
        </div>
        @endif
    </div>

    <!-- My Reseller Links -->
    @if($resellers && $resellers->count() > 0)
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h2 class="text-xl font-bold text-zinc-800 mb-6">My Reseller Links</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-zinc-200">
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Product</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Reseller Price</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Your Price</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Clicks</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-zinc-600">Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resellers as $reseller)
                    <tr class="border-b border-zinc-100">
                        <td class="py-4 px-4 text-zinc-800">{{ $reseller->product->name ?? 'N/A' }}</td>
                        <td class="py-4 px-4 text-zinc-600">₦{{ number_format($reseller->product->price ?? 0, 0) }}</td>
                        <td class="py-4 px-4 text-zinc-800 font-medium">₦{{ number_format($reseller->reseller_price, 0) }}</td>
                        <td class="py-4 px-4 text-zinc-600">{{ $reseller->clicks ?? 0 }}</td>
                        <td class="py-4 px-4">
                            <button onclick="copyLink('{{ $reseller->link }}')" class="text-[#2C418F] hover:underline text-sm">
                                Copy Link
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<script>
function createResellerLink(productId, productName, basePrice) {
    const markup = prompt(`Enter your selling price for "${productName}"\nBase price: ₦${basePrice.toLocaleString()}`, basePrice);
    
    if (markup && markup > 0) {
        // In a real app, this would call an API to create the reseller link
        alert('Reseller link created! Share it to earn commissions.');
    }
}

function copyLink(link) {
    navigator.clipboard.writeText(window.location.origin + '/product/' + link);
    alert('Link copied to clipboard!');
}
</script>
@endsection
