<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create your free Hovertask account and start earning money online through tasks, advertising, and reselling.">
    <title>Sign Up - Hovertask</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2C418F',
                        accent: '#3A5AE8',
                    },
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #2C418F 0%, #3A5AE8 50%, #6366F1 100%);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <!-- Floating Shapes -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-amber-300/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-6xl relative z-10">
        <!-- Logo & Nav -->
        <div class="flex items-center justify-between mb-8">
            <a href="/" class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-primary font-bold text-2xl">H</span>
                </div>
                <span class="text-2xl font-bold text-white">Hovertask</span>
            </a>
            <div class="hidden md:flex items-center gap-6 text-white/80">
                <a href="/" class="hover:text-white transition">Home</a>
                <a href="/about" class="hover:text-white transition">About</a>
                <a href="/marketplace" class="hover:text-white transition">Marketplace</a>
                <a href="/faq" class="hover:text-white transition">FAQ</a>
                <a href="/contact" class="hover:text-white transition">Contact</a>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row-reverse">
            <!-- Right Side - Image -->
            <div class="w-full md:w-1/2 relative min-h-[300px] md:min-h-[700px]">
                <img src="/assets/newgilr.jpeg" alt="Join Hovertask" class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/50 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                    <h2 class="text-3xl font-bold mb-2">Start Your Journey!</h2>
                    <p class="text-white/90 text-lg">Join thousands earning daily with Hovertask</p>
                    
                    <!-- Benefits List -->
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                            <span class="text-sm">Earn ₦500 for each referral</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                            <span class="text-sm">Complete tasks and get paid instantly</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                            <span class="text-sm">Advertise to 500K+ engaged users</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Side - Form -->
            <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center overflow-y-auto max-h-[90vh]">
                <div class="max-w-md mx-auto w-full">
                    <div class="mb-6">
                        <img src="/assets/brand-logo.svg" alt="Hovertask Logo" class="h-10 mb-4" />
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h2>
                        <p class="text-gray-600">Enter your details to get started - it's free!</p>
                    </div>

                    <!-- Progress Indicator -->
                    <div class="flex items-center gap-2 mb-6">
                        <div class="flex-1 h-1 bg-primary rounded-full"></div>
                        <div class="flex-1 h-1 bg-gray-200 rounded-full"></div>
                    </div>

                    <form method="POST" action="#" id="signupForm" class="space-y-4">
                        @csrf

                        <!-- Name Row -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="fname" class="block text-sm font-medium text-gray-700 mb-1.5">First Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="text" id="fname" name="fname" required class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="First name">
                                </div>
                            </div>
                            <div>
                                <label for="lname" class="block text-sm font-medium text-gray-700 mb-1.5">Last Name</label>
                                <input type="text" id="lname" name="lname" required class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Last name">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                </div>
                                <input type="email" id="email" name="email" required class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Enter your email">
                            </div>
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-at text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="username" name="username" required class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Choose a username">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400 text-sm"></i>
                                </div>
                                <input type="tel" id="phone" name="phone" required class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Enter your phone number">
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                                </div>
                                <input type="password" id="password" name="password" required class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Create a password">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword()">
                                    <i class="fas fa-eye text-gray-400 hover:text-primary text-sm" id="eye-icon"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">At least 8 characters</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Confirm your password">
                            </div>
                        </div>

                        <!-- Referral Code -->
                        <div>
                            <label for="referral_code" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Referral Code <span class="text-gray-400 font-normal">(Optional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="referral_code" name="referral_code" class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all text-sm" placeholder="Enter referral code">
                            </div>
                        </div>

                        <!-- Terms -->
                        <div>
                            <label class="flex items-start gap-2 cursor-pointer">
                                <input type="checkbox" name="terms" required class="w-4 h-4 mt-0.5 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="text-xs text-gray-600">
                                    I agree to the
                                    <a href="/terms" class="text-primary hover:underline">Terms of Service</a>
                                    and
                                    <a href="/privacy-policy" class="text-primary hover:underline">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-primary hover:bg-accent text-white py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-primary/30 hover:shadow-primary/40 hover:scale-[1.02]">
                            Create Account
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-3 bg-white text-gray-500">Or sign up with</span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="grid grid-cols-2 gap-3">
                        <button class="flex items-center justify-center gap-2 py-2.5 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <img src="https://www.google.com/favicon.ico" alt="Google" class="w-4 h-4">
                            <span class="text-sm font-medium text-gray-700">Google</span>
                        </button>
                        <button class="flex items-center justify-center gap-2 py-2.5 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-facebook text-blue-600"></i>
                            <span class="text-sm font-medium text-gray-700">Facebook</span>
                        </button>
                    </div>

                    <!-- Sign In Link -->
                    <p class="text-center text-gray-600 mt-6 text-sm">
                        Already have an account?
                        <a href="/signin" class="text-primary hover:text-accent font-semibold">
                            Sign In
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/60 text-sm">
            <p>&copy; {{ date('Y') }} Hovertask. All rights reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        // Handle form submission
        document.getElementById('signupForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            
            // Basic validation
            const password = formData.get('password');
            const passwordConfirmation = formData.get('password_confirmation');
            
            if (password !== passwordConfirmation) {
                alert('Passwords do not match!');
                return;
            }
            
            if (password.length < 6) {
                alert('Password must be at least 6 characters!');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
            
            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        fname: formData.get('fname'),
                        lname: formData.get('lname'),
                        email: formData.get('email'),
                        username: formData.get('username'),
                        password: password,
                        password_confirmation: passwordConfirmation,
                        country: formData.get('country') || 'Nigeria',
                        currency: formData.get('currency') || 'NGN',
                        phone: formData.get('phone'),
                        referral_code: formData.get('referral_code')
                    })
                });
                
                const data = await response.json();
                
                if (data.status) {
                    // Store token and redirect
                    if (data.token) {
                        localStorage.setItem('token', data.token);
                    }
                    alert('Account created successfully! Please check your email for verification code.');
                    window.location.href = '/signin?registered=true';
                } else {
                    alert(data.message || 'Registration failed. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            } catch (error) {
                console.error('Registration error:', error);
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        });
    </script>
</body>
</html>
