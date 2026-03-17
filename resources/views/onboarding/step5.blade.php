@extends('onboarding.layout')

@section('title', 'Step 5: You\'re All Set!')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in text-center">
    <!-- Success Animation -->
    <div class="mb-8">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
            <i class="fas fa-check text-4xl text-green-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">You're All Set! 🎉</h1>
        <p class="text-gray-500">Your Hovertask account is ready</p>
    </div>

    <!-- Quick Actions -->
    <div class="space-y-3 mb-8">
        <a href="{{ route('dashboard.earn.tasks') }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-green-300 hover:bg-green-50 transition-all">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-tasks text-green-600"></i>
            </div>
            <div class="text-left flex-1">
                <h3 class="font-semibold text-gray-800">Find Tasks</h3>
                <p class="text-sm text-gray-500">Start earning now</p>
            </div>
            <i class="fas fa-arrow-right text-green-600"></i>
        </a>

        <a href="{{ route('dashboard.marketplace') }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-purple-300 hover:bg-purple-50 transition-all">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-store text-purple-600"></i>
            </div>
            <div class="text-left flex-1">
                <h3 class="font-semibold text-gray-800">Browse Marketplace</h3>
                <p class="text-sm text-gray-500">Discover products</p>
            </div>
            <i class="fas fa-arrow-right text-purple-600"></i>
        </a>

        <a href="{{ route('dashboard.refer') }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-pink-300 hover:bg-pink-50 transition-all">
            <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-share-alt text-pink-600"></i>
            </div>
            <div class="text-left flex-1">
                <h3 class="font-semibold text-gray-800">Invite Friends</h3>
                <p class="text-sm text-gray-500">Earn ₦500 per referral</p>
            </div>
            <i class="fas fa-arrow-right text-pink-600"></i>
        </a>
    </div>

    <form action="{{ route('onboarding.step5') }}" method="POST">
        @csrf
        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold py-4 rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all shadow-lg">
            Go to Dashboard <i class="fas fa-rocket ml-2"></i>
        </button>
    </form>
</div>
@endsection
