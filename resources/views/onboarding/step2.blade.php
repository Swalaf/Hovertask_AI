@extends('onboarding.layout')

@section('title', 'Step 2: Choose Your Path')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-route text-3xl text-green-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">How will you use Hovertask?</h1>
        <p class="text-gray-500">Choose what works best for you</p>
    </div>

    <form action="{{ route('onboarding.step2') }}" method="POST" class="space-y-4">
        @csrf
        
        <label class="cursor-pointer block">
            <input type="radio" name="how_you_want_to_use" value="worker" class="peer sr-only"
                {{ old('how_you_want_to_use', $user->how_you_want_to_use) == 'worker' ? 'checked' : '' }}>
            <div class="p-5 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tasks text-xl text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">I'm here to Earn</h3>
                        <p class="text-sm text-gray-500">Complete tasks, do micro-jobs, and get paid</p>
                    </div>
                </div>
            </div>
        </label>

        <label class="cursor-pointer block">
            <input type="radio" name="how_you_want_to_use" value="advertiser" class="peer sr-only"
                {{ old('how_you_want_to_use', $user->how_you_want_to_use) == 'advertiser' ? 'checked' : '' }}>
            <div class="p-5 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-bullhorn text-xl text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">I'm here to Advertise</h3>
                        <p class="text-sm text-gray-500">Promote your business and reach more customers</p>
                    </div>
                </div>
            </div>
        </label>

        <label class="cursor-pointer block">
            <input type="radio" name="how_you_want_to_use" value="both" class="peer sr-only"
                {{ old('how_you_want_to_use', $user->how_you_want_to_use) == 'both' ? 'checked' : '' }}>
            <div class="p-5 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-balance-scale text-xl text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">I want both</h3>
                        <p class="text-sm text-gray-500">Earn by completing tasks AND advertise your business</p>
                    </div>
                </div>
            </div>
        </label>

        @error('how_you_want_to_use')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary/90 transition-colors mt-6">
            Continue <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </form>
</div>
@endsection
