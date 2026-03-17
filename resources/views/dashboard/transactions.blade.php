@extends('layouts.main')

@section('title', 'Transactions - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Transactions</h1>
        
        <div class="space-y-3">
            @forelse([] as $transaction)
            <div class="flex items-center justify-between p-4 bg-zinc-50 rounded-lg">
                <div>
                    <p class="font-medium text-zinc-800">{{ $transaction->description }}</p>
                    <p class="text-sm text-zinc-500">{{ $transaction->created_at->format('M d, Y') }}</p>
                </div>
                <p class="font-bold {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                    {{ $transaction->type === 'credit' ? '+' : '-' }}₦{{ number_format($transaction->amount) }}
                </p>
            </div>
            @empty
            <p class="text-zinc-500 text-center py-8">No transactions yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
