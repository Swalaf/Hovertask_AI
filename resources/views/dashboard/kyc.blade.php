@extends('layouts.main')

@section('title', 'KYC Verification - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">KYC Verification</h1>
        
        <div class="bg-zinc-50 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full {{ Auth::user()->kyc_verified ? 'bg-green-100' : 'bg-yellow-100' }} flex items-center justify-center">
                    @if(Auth::user()->kyc_verified)
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @else
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    @endif
                </div>
                <div>
                    <p class="font-medium text-zinc-800">{{ Auth::user()->kyc_verified ? 'Verified' : 'Pending Verification' }}</p>
                    <p class="text-sm text-zinc-500">{{ Auth::user()->kyc_verified ? 'Your identity has been verified' : 'Complete your KYC to unlock all features' }}</p>
                </div>
            </div>
        </div>
        
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Full Name</label>
                <input type="text" class="w-full p-3 rounded-lg border border-zinc-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Date of Birth</label>
                <input type="date" class="w-full p-3 rounded-lg border border-zinc-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Address</label>
                <input type="text" class="w-full p-3 rounded-lg border border-zinc-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">ID Type</label>
                <select class="w-full p-3 rounded-lg border border-zinc-200">
                    <option>National ID</option>
                    <option>Passport</option>
                    <option>Driver's License</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">ID Number</label>
                <input type="text" class="w-full p-3 rounded-lg border border-zinc-200">
            </div>
            <button type="submit" class="w-full bg-[#2C418F] text-white py-3 rounded-lg hover:bg-[#1a2d6b]">Submit for Verification</button>
        </form>
    </div>
</div>
@endsection
