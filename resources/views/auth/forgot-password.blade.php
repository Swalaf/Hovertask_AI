@extends('layouts.public')
@section('title', 'Forgot Password - Hovertask')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2C418F] to-[#4A6FD6] py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo-white.png') }}" alt="Hovertask" class="h-10" onerror="this.style.display='none'">
                <span class="text-2xl font-bold text-white">Hovertask</span>
            </a>
        </div>

        <!-- Forgot Password Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-[#2C418F]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#2C418F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Forgot Password?</h2>
                <p class="text-gray-600 mt-2 text-sm">No worries, we'll send you reset instructions.</p>
            </div>

            <!-- Reset Form -->
            <form id="forgotPasswordForm" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required 
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2C418F]/20 focus:bg-white focus:border-[#2C418F] transition-all" 
                            placeholder="Enter your email">
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full bg-[#2C418F] text-white py-3.5 rounded-xl font-semibold hover:bg-[#1a2d6b] transition-colors flex items-center justify-center gap-2">
                    <span>Reset Password</span>
                    <svg id="arrowIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    <svg id="spinnerIcon" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <!-- Back to Sign In -->
            <div class="mt-6 text-center">
                <a href="/signin" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-[#2C418F] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Sign In
                </a>
            </div>

            <!-- Message Container -->
            <div id="messageContainer" class="mt-4 hidden">
                <div id="messageContent" class="p-4 rounded-xl text-sm"></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-white/70 text-sm">
                Don't have an account? 
                <a href="/signup" class="text-white font-medium hover:underline">Sign up</a>
            </p>
        </div>
    </div>
</div>

<script>
document.getElementById('forgotPasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const arrowIcon = document.getElementById('arrowIcon');
    const spinnerIcon = document.getElementById('spinnerIcon');
    const messageContainer = document.getElementById('messageContainer');
    const messageContent = document.getElementById('messageContent');
    
    const email = document.getElementById('email').value;
    
    // Show loading state
    submitBtn.disabled = true;
    arrowIcon.classList.add('hidden');
    spinnerIcon.classList.remove('hidden');
    submitBtn.classList.add('opacity-75');
    messageContainer.classList.add('hidden');
    
    try {
        const response = await fetch('/api/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email })
        });
        
        const data = await response.json();
        
        messageContainer.classList.remove('hidden');
        
        if (data.status) {
            messageContent.className = 'p-4 rounded-xl text-sm bg-green-50 text-green-700 border border-green-200';
            messageContent.innerHTML = `
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-medium">${data.message}</p>
                        <p class="text-xs mt-1">Please check your email for the reset code.</p>
                    </div>
                </div>
            `;
            // Store email for the reset code verification
            sessionStorage.setItem('reset_email', email);
            // Redirect to reset code page after a short delay
            setTimeout(() => {
                window.location.href = '/verify-reset-code';
            }, 2000);
        } else {
            messageContent.className = 'p-4 rounded-xl text-sm bg-red-50 text-red-700 border border-red-200';
            messageContent.innerHTML = `
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-medium">Error</p>
                        <p class="text-xs mt-1">${data.message || 'Something went wrong. Please try again.'}</p>
                    </div>
                </div>
            `;
        }
    } catch (error) {
        messageContainer.classList.remove('hidden');
        messageContent.className = 'p-4 rounded-xl text-sm bg-red-50 text-red-700 border border-red-200';
        messageContent.innerHTML = `
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-medium">Network Error</p>
                    <p class="text-xs mt-1">Please check your connection and try again.</p>
                </div>
            </div>
        `;
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        arrowIcon.classList.remove('hidden');
        spinnerIcon.classList.add('hidden');
        submitBtn.classList.remove('opacity-75');
    }
});
</script>
@endsection
