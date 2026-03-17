@extends('layouts.main')

@section('title', 'Fund Wallet - Hovertask')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-primary to-indigo-600 rounded-2xl p-6 text-white">
        <p class="text-sm opacity-80">Current Balance</p>
        <p class="text-4xl font-bold">₦{{ number_format(Auth::user()->balance ?? 0) }}</p>
    </div>

    <!-- Fund Wallet Form -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Add Funds to Wallet</h2>
        
        <form action="{{ route('dashboard.fund.wallet.process') }}" method="POST" id="fundForm" class="space-y-6">
            @csrf
            <input type="hidden" name="return_to" value="{{ request()->get('return_to', '') }}">
            
            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount (₦)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">₦</span>
                    <input type="number" name="amount" id="amount" min="100" step="100" required
                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 text-lg font-semibold"
                        placeholder="Enter amount" value="{{ $prefillAmount ?? '' }}">
                </div>
                <p class="text-xs text-gray-500 mt-1">Minimum amount: ₦100</p>
            </div>

            <!-- Quick Amounts -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Quick amounts</label>
                <div class="grid grid-cols-4 gap-2">
                    <button type="button" class="amount-btn px-4 py-2 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-colors" data-amount="500">₦500</button>
                    <button type="button" class="amount-btn px-4 py-2 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-colors" data-amount="1000">₦1,000</button>
                    <button type="button" class="amount-btn px-4 py-2 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-colors" data-amount="5000">₦5,000</button>
                    <button type="button" class="amount-btn px-4 py-2 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-colors" data-amount="10000">₦10,000</button>
                </div>
            </div>

            <!-- Payment Methods -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Select Payment Method</label>
                <div class="space-y-3">
                    <!-- Paystack -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="paystack" class="peer sr-only" checked>
                        <div class="p-4 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                        <span class="text-green-600 font-bold text-sm">PK</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Paystack</h3>
                                        <p class="text-sm text-gray-500">Instant bank transfer</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-primary peer-checked:bg-primary flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Korapay -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="korapay" class="peer sr-only">
                        <div class="p-4 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <span class="text-blue-600 font-bold text-sm">KP</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Korapay</h3>
                                        <p class="text-sm text-gray-500">Quick & secure</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-primary peer-checked:bg-primary flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Bank Transfer -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="bank_transfer" class="peer sr-only">
                        <div class="p-4 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Bank Transfer</h3>
                                        <p class="text-sm text-gray-500">Transfer directly</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-primary peer-checked:bg-primary flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- USSD -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="ussd" class="peer sr-only">
                        <div class="p-4 rounded-xl border-2 border-gray-100 hover:border-primary/30 transition-all peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">USSD</h3>
                                        <p class="text-sm text-gray-500">Dial *Code# to pay</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-primary peer-checked:bg-primary flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full bg-primary text-white py-3.5 rounded-xl font-semibold hover:bg-primary/90 transition-colors">
                Proceed to Payment
            </button>
        </form>
    </div>

    <!-- Info -->
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
        <div class="flex gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            <div class="text-sm text-blue-800">
                <p class="font-semibold mb-1">Secure Payment</p>
                <p>Your payment is secured with 256-bit SSL encryption. Funds are processed instantly and reflected in your wallet balance.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('amount').value = btn.dataset.amount;
    });
});
</script>
@endsection
