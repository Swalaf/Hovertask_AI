@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('main')
    </main>
</div>
@endsection
