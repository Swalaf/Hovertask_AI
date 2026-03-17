@extends('layouts.public')
@section('title', 'Verify Reset Code - Hovertask')

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

        <!-- Verify Code Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-[#2C418F]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#2C418F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Enter Reset Code</h2>
                <p class="text-gray-600 mt-2 text-sm">We sent a 6-digit code to your email</p>
                <p class="text-[#2C418F] font-medium text-sm mt-1" id="userEmail"></p>
            </div>

            <!-- Verify Form -->
            <form id="verifyCodeForm" class="space-y-4">
                @csrf
                <input type="hidden" id="email" name="email">
                
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1.5">Verification Code</label>
                    <input type="text" id="code" name="code" required maxlength="6" minlength="6"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2C418F]/20 focus:bg-white focus:border-[#2C418F] transition-all text-center text-2xl tracking-widest font-mono" 
                        placeholder="000000">
                </div>

                <div id="newPasswordSection" class="space-y-4 hidden">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">New Password</label>
                        <input type="password" id="password" name="password" minlength="8"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2C418F]/20 focus:bg-white focus:border-[#2C418F] transition-all" 
                            placeholder="Enter new password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" minlength="8"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2C418F]/20 focus:bg-white focus:border-[#2C418F] transition-all" 
                            placeholder="Confirm new password">
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full bg-[#2C418F] text-white py-3.5 rounded-xl font-semibold hover:bg-[#1a2d6b] transition-colors flex items-center justify-center gap-2">
                    <span id="btnText">Verify Code</span>
                    <svg id="spinnerIcon" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <!-- Resend Code -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">Didn't receive the code?</p>
                <button type="button" id="resendBtn" class="text-[#2C418F] font-medium hover:underline text-sm mt-1">
                    Resend Code
                </button>
                <span id="resendTimer" class="text-gray-400 text-sm ml-2 hidden"></span>
            </div>

            <!-- Back to Forgot Password -->
            <div class="mt-4 text-center">
                <a href="/forgot-password" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-[#2C418F] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>

            <!-- Message Container -->
            <div id="messageContainer" class="mt-4 hidden">
                <div id="messageContent" class="p-4 rounded-xl text-sm"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const email = sessionStorage.getItem('reset_email');
    if (!email) {
        window.location.href = '/forgot-password';
        return;
    }
    
    document.getElementById('email').value = email;
    document.getElementById('userEmail').textContent = email;
    
    let step = 1; // 1 = verify code, 2 = set new password
    
    // Auto-advance when 6 digits entered
    document.getElementById('code').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
        if (this.value.length === 6 && step === 1) {
            verifyCode();
        }
    });
    
    // Resend button
    document.getElementById('resendBtn').addEventListener('click', async function() {
        await resendCode();
    });
    
    // Form submit
    document.getElementById('verifyCodeForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        if (step === 1) {
            await verifyCode();
        } else {
            await resetPassword();
        }
    });
    
    async function verifyCode() {
        const submitBtn = document.getElementById('submitBtn');
        const spinnerIcon = document.getElementById('spinnerIcon');
        const btnText = document.getElementById('btnText');
        const messageContainer = document.getElementById('messageContainer');
        const messageContent = document.getElementById('messageContent');
        
        const code = document.getElementById('code').value;
        const email = document.getElementById('email').value;
        
        if (code.length !== 6) {
            showMessage('Please enter the 6-digit code', 'error');
            return;
        }
        
        submitBtn.disabled = true;
        spinnerIcon.classList.remove('hidden');
        btnText.textContent = 'Verifying...';
        
        try {
            const response = await fetch('/api/verify-reset-code', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    email: email,
                    code: code
                })
            });
            
            const data = await response.json();
            
            if (data.status) {
                step = 2;
                document.getElementById('newPasswordSection').classList.remove('hidden');
                document.getElementById('code').disabled = true;
                btnText.textContent = 'Reset Password';
                showMessage('Code verified! Now enter your new password.', 'success');
            } else {
                showMessage(data.message || 'Invalid code. Please try again.', 'error');
            }
        } catch (error) {
            showMessage('Network error. Please try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            spinnerIcon.classList.add('hidden');
            btnText.textContent = step === 1 ? 'Verify Code' : 'Reset Password';
        }
    }
    
    async function resetPassword() {
        const submitBtn = document.getElementById('submitBtn');
        const spinnerIcon = document.getElementById('spinnerIcon');
        const btnText = document.getElementById('btnText');
        
        const email = document.getElementById('email').value;
        const code = document.getElementById('code').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;
        
        if (password.length < 8) {
            showMessage('Password must be at least 8 characters', 'error');
            return;
        }
        
        if (password !== password_confirmation) {
            showMessage('Passwords do not match', 'error');
            return;
        }
        
        submitBtn.disabled = true;
        spinnerIcon.classList.remove('hidden');
        btnText.textContent = 'Resetting...';
        
        try {
            const response = await fetch('/api/password/reset', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    email: email,
                    code: code,
                    password: password,
                    password_confirmation: password_confirmation
                })
            });
            
            const data = await response.json();
            
            if (data.status) {
                showMessage('Password reset successful! Redirecting to login...', 'success');
                sessionStorage.removeItem('reset_email');
                setTimeout(() => {
                    window.location.href = '/signin?reset=success';
                }, 1500);
            } else {
                showMessage(data.message || 'Failed to reset password', 'error');
            }
        } catch (error) {
            showMessage('Network error. Please try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            spinnerIcon.classList.add('hidden');
            btnText.textContent = 'Reset Password';
        }
    }
    
    async function resendCode() {
        const resendBtn = document.getElementById('resendBtn');
        const resendTimer = document.getElementById('resendTimer');
        
        resendBtn.disabled = true;
        
        try {
            const response = await fetch('/api/reset-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: document.getElementById('email').value })
            });
            
            const data = await response.json();
            
            if (data.status) {
                showMessage('New code sent! Check your email.', 'success');
                // Start timer
                let seconds = 60;
                resendTimer.classList.remove('hidden');
                resendBtn.classList.add('hidden');
                
                const timer = setInterval(() => {
                    seconds--;
                    resendTimer.textContent = `(${seconds}s)`;
                    if (seconds <= 0) {
                        clearInterval(timer);
                        resendTimer.classList.add('hidden');
                        resendBtn.classList.remove('hidden');
                        resendBtn.disabled = false;
                    }
                }, 1000);
            } else {
                showMessage(data.message || 'Failed to resend code', 'error');
                resendBtn.disabled = false;
            }
        } catch (error) {
            showMessage('Network error. Please try again.', 'error');
            resendBtn.disabled = false;
        }
    }
    
    function showMessage(message, type) {
        const messageContainer = document.getElementById('messageContainer');
        const messageContent = document.getElementById('messageContent');
        
        messageContainer.classList.remove('hidden');
        
        if (type === 'success') {
            messageContent.className = 'p-4 rounded-xl text-sm bg-green-50 text-green-700 border border-green-200';
        } else {
            messageContent.className = 'p-4 rounded-xl text-sm bg-red-50 text-red-700 border border-red-200';
        }
        
        messageContent.textContent = message;
    }
});
</script>
@endsection
