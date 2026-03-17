@extends('onboarding.layout')

@section('title', 'Step 3: Connect Your Accounts')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-link text-3xl text-orange-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Connect Your Accounts</h1>
        <p class="text-gray-500">This helps you complete tasks faster (Optional)</p>
    </div>

    <div class="space-y-4">
        <div class="p-4 rounded-xl border border-gray-100 hover:border-gray-200 transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fab fa-facebook text-xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Facebook</h3>
                        <p class="text-sm text-green-600">Not connected</p>
                    </div>
                </div>
                <button type="button" class="px-4 py-2 text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">
                    Connect
                </button>
            </div>
        </div>

        <div class="p-4 rounded-xl border border-gray-100 hover:border-gray-200 transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-sky-500 rounded-xl flex items-center justify-center">
                        <i class="fab fa-twitter text-xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Twitter / X</h3>
                        <p class="text-sm text-green-600">Not connected</p>
                    </div>
                </div>
                <button type="button" class="px-4 py-2 text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">
                    Connect
                </button>
            </div>
        </div>

        <div class="p-4 rounded-xl border border-gray-100 hover:border-gray-200 transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center">
                        <i class="fab fa-instagram text-xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Instagram</h3>
                        <p class="text-sm text-green-600">Not connected</p>
                    </div>
                </div>
                <button type="button" class="px-4 py-2 text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">
                    Connect
                </button>
            </div>
        </div>

        <div class="p-4 rounded-xl border border-gray-100 hover:border-gray-200 transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                        <i class="fab fa-whatsapp text-xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">WhatsApp</h3>
                        <p class="text-sm text-green-600">Not connected</p>
                    </div>
                </div>
                <button type="button" class="px-4 py-2 text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors">
                    Connect
                </button>
            </div>
        </div>
    </div>

    <form action="{{ route('onboarding.step3') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary/90 transition-colors">
            Skip for Now <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </form>
</div>
@endsection
