@extends('layouts.main')

@section('title', 'Edit Profile - Hovertask')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Avatar -->
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 bg-gradient-to-br from-primary to-indigo-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr(Auth::user()->fname ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <label class="block">
                        <span class="text-sm font-medium text-gray-700">Profile Photo</span>
                        <input type="file" name="avatar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90">
                    </label>
                </div>
            </div>

            <!-- Name -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="fname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="fname" value="{{ Auth::user()->fname }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label for="lname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="lname" value="{{ Auth::user()->lname }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary">
                </div>
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ Auth::user()->username }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary" readonly>
                <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" name="phone" value="{{ Auth::user()->phone }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary">
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <select name="country" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary">
                    <option value="Nigeria" {{ Auth::user()->country == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                    <option value="Ghana" {{ Auth::user()->country == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                    <option value="Kenya" {{ Auth::user()->country == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                    <option value="South Africa" {{ Auth::user()->country == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                </select>
            </div>

            <!-- How you want to use -->
            <div>
                <label for="how_you_want_to_use" class="block text-sm font-medium text-gray-700 mb-1">I want to</label>
                <select name="how_you_want_to_use" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-primary">
                    <option value="worker" {{ Auth::user()->how_you_want_to_use == 'worker' ? 'selected' : '' }}>Earn by completing tasks</option>
                    <option value="advertiser" {{ Auth::user()->how_you_want_to_use == 'advertiser' ? 'selected' : '' }}>Advertise my business</option>
                    <option value="both" {{ Auth::user()->how_you_want_to_use == 'both' ? 'selected' : '' }}>Both</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-primary/90 transition-colors">
                    Save Changes
                </button>
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 border border-gray-200 rounded-lg font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
