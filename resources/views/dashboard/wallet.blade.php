@extends('layouts.main')

@section('title', 'Wallet - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Wallet</h1>
        
        <div class="bg-gradient-to-r from-[#2C418F] to-[#3A5AE8] rounded-xl p-6 text-white mb-6">
            <p class="text-sm opacity-80">Available Balance</p>
            <p class="text-3xl font-bold">₦{{ number_format(Auth::user()->balance ?? 0) }}</p>
        </div>
        
        <div class="flex gap-4">
            <a href="/dashboard/fund-wallet" class="flex-1 bg-[#2C418F] text-white text-center py-3 rounded-lg hover:bg-[#1a2d6b]">Fund Wallet</a>
            <button class="flex-1 border border-[#2C418F] text-[#2C418F] py-3 rounded-lg hover:bg-[#2C418F] hover:text-white">Withdraw</button>
        </div>
    </div>
</div>
@endsection
