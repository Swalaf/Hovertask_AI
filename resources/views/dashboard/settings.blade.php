@extends('layouts.main')

@section('title', 'Settings - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Settings</h1>
        
        <div class="space-y-8">
            <!-- Profile Settings -->
            <div>
                <h3 class="font-medium text-zinc-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#2C418F]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Profile Settings
                </h3>
                <form action="{{ route('update.profile') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-zinc-600 mb-1">First Name</label>
                            <input type="text" name="fname" value="{{ auth()->user()->fname ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                        </div>
                        <div>
                            <label class="block text-sm text-zinc-600 mb-1">Last Name</label>
                            <input type="text" name="lname" value="{{ auth()->user()->lname ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Username</label>
                        <input type="text" value="{{ auth()->user()->username ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 bg-zinc-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Email</label>
                        <input type="email" value="{{ auth()->user()->email ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Phone</label>
                        <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="+2348000000000">
                    </div>
                    <button type="submit" class="bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">Save Changes</button>
                </form>
            </div>
            
            <hr class="border-zinc-100">
            
            <!-- Bank Details -->
            <div>
                <h3 class="font-medium text-zinc-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#2C418F]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    Bank Details
                </h3>
                <form action="{{ route('change.bank') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ auth()->user()->bank_name ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., First Bank">
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Account Number</label>
                        <input type="text" name="account_number" value="{{ auth()->user()->account_number ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="10-digit account number">
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Account Name</label>
                        <input type="text" name="account_name" value="{{ auth()->user()->account_name ?? '' }}" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="As it appears on bank account">
                    </div>
                    <button type="submit" class="bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">Update Bank Details</button>
                </form>
            </div>
            
            <hr class="border-zinc-100">
            
            <!-- Change Password -->
            <div>
                <h3 class="font-medium text-zinc-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#2C418F]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Change Password
                </h3>
                <form action="{{ route('change.password') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Current Password</label>
                        <input type="password" name="current_password" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">New Password</label>
                        <input type="password" name="password" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                    </div>
                    <div>
                        <label class="block text-sm text-zinc-600 mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                    </div>
                    <button type="submit" class="bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">Update Password</button>
                </form>
            </div>
            
            <hr class="border-zinc-100">
            
            <!-- Notification Settings -->
            <div>
                <h3 class="font-medium text-zinc-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#2C418F]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                    Notification Preferences
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg cursor-pointer hover:bg-zinc-50">
                        <div>
                            <p class="font-medium text-zinc-800">Email Notifications</p>
                            <p class="text-sm text-zinc-500">Receive updates via email</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 text-[#2C418F]" checked>
                    </label>
                    <label class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg cursor-pointer hover:bg-zinc-50">
                        <div>
                            <p class="font-medium text-zinc-800">SMS Notifications</p>
                            <p class="text-sm text-zinc-500">Receive updates via SMS</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 text-[#2C418F]" checked>
                    </label>
                    <label class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg cursor-pointer hover:bg-zinc-50">
                        <div>
                            <p class="font-medium text-zinc-800">Push Notifications</p>
                            <p class="text-sm text-zinc-500">Receive push notifications</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 text-[#2C418F]" checked>
                    </label>
                </div>
            </div>
            
            <hr class="border-zinc-100">
            
            <!-- Security -->
            <div>
                <h3 class="font-medium text-zinc-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#2C418F]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Security
                </h3>
                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50">
                        <div>
                            <p class="font-medium text-zinc-800">Two-Factor Authentication</p>
                            <p class="text-sm text-zinc-500">Add an extra layer of security</p>
                        </div>
                        <span class="text-[#2C418F]">Enable →</span>
                    </a>
                    <a href="#" class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50">
                        <div>
                            <p class="font-medium text-zinc-800">Active Sessions</p>
                            <p class="text-sm text-zinc-500">Manage your active sessions</p>
                        </div>
                        <span class="text-[#2C418F]">View →</span>
                    </a>
                </div>
            </div>
            
            <hr class="border-zinc-100">
            
            <!-- Danger Zone -->
            <div>
                <h3 class="font-medium text-red-600 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Danger Zone
                </h3>
                <div class="p-4 border border-red-200 rounded-lg bg-red-50">
                    <p class="text-sm text-red-600 mb-3">Once you delete your account, there is no going back. Please be certain.</p>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
