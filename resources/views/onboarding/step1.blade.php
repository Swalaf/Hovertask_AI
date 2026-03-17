@extends('onboarding.layout')

@section('title', 'Step 1: Complete Your Profile')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-user-circle text-3xl text-primary"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Complete Your Profile</h1>
        <p class="text-gray-500">Let's get to know you better</p>
    </div>

    <form action="{{ route('onboarding.step1') }}" method="POST" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="fname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" name="fname" id="fname" value="{{ old('fname', $user->fname) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                    placeholder="John" required>
            </div>
            <div>
                <label for="lname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" name="lname" id="lname" value="{{ old('lname', $user->lname) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                    placeholder="Doe" required>
            </div>
        </div>

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">@</span>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                    placeholder="johndoe">
            </div>
            <p class="text-xs text-gray-400 mt-1">This will be your unique identifier on Hovertask</p>
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                placeholder="+234 800 000 0000">
        </div>

        <div>
            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
            <select name="country" id="country" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                <option value="">Select your country</option>
                <option value="Nigeria" {{ old('country', $user->country) == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                <option value="Ghana" {{ old('country', $user->country) == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                <option value="Kenya" {{ old('country', $user->country) == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                <option value="South Africa" {{ old('country', $user->country) == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                <option value="Other" {{ old('country', $user->country) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary/90 transition-colors">
            Continue <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </form>
</div>
@endsection
