@extends('onboarding.layout')

@section('title', 'Step 4: Fund Your Wallet')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-wallet text-3xl text-blue-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Fund Your Wallet</h1>
        <p class="text-gray-500">Add money to start advertising or withdraw earnings</p>
    </div>

    <div class="bg-gradient-to-r from-primary to-indigo-600 rounded-xl p-6 text-white mb-6">
        <p class="text-sm opacity-80">Current Balance</p>
        <p class="text-3xl font-bold">₦{{ number_format(Auth::user()->balance ?? 0) }}</p>
    </div>

    <div class="space-y-3 mb-6">
        <div class="p-4 rounded-xl border border-gray-100 hover:border-primary/30 transition-all cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-university text-green-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">Bank Transfer</h3>
                    <p class="text-xs text-gray-500">Instant transfer via Nigerian banks</p>
                </div>
                <i class="fas fa-chevron-right text-gray-300"></i>
            </div>
        </div>

        <div class="p-4 rounded-xl border border-gray-100 hover:border-primary/30 transition-all cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fab fa-cc-visa text-purple-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">Debit Card</h3>
                    <p class="text-xs text-gray-500">Visa, Mastercard, Verve</p>
                </div>
                <i class="fas fa-chevron-right text-gray-300"></i>
            </div>
        </div>

        <div class="p-4 rounded-xl border border-gray-100 hover:border-primary/30 transition-all cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">USSD</h3>
                    <p class="text-xs text-gray-500">Pay with USSD code</p>
                </div>
                <i class="fas fa-chevron-right text-gray-300"></i>
            </div>
        </div>
    </div>

    <div class="flex gap-3">
        <form action="{{ route('onboarding.step4') }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" class="w-full border-2 border-primary text-primary font-semibold py-3 rounded-lg hover:bg-primary hover:text-white transition-colors">
                Skip for Now
            </button>
        </form>
        <a href="{{ route('dashboard.fund.wallet') }}" class="flex-1 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary/90 transition-colors text-center">
            Add Funds
        </a>
    </div>
</div>
@endsection
