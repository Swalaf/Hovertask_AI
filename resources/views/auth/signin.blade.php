<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign in to your Hovertask account to start earning, advertising, and reselling products.">
    <title>Sign In - Hovertask</title>
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
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <!-- Floating Shapes -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-300/20 rounded-full blur-3xl"></div>
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

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side - Image -->
            <div class="w-full md:w-1/2 relative min-h-[300px] md:min-h-[600px]">
                <img src="/assets/newgilr.jpeg" alt="Welcome Back" class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/50 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                    <h2 class="text-3xl font-bold mb-2">Welcome Back!</h2>
                    <p class="text-white/90 text-lg">Sign in to continue your earning journey with Hovertask</p>
                    <div class="flex items-center gap-4 mt-6">
                        <div class="flex -space-x-2">
                            <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                            <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                            <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                        </div>
                        <span class="text-sm">Join 500K+ users earning daily</span>
                    </div>
                </div>
                <!-- Trust Badges -->
                <div class="absolute top-4 right-4 flex gap-2">
                    <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-white text-xs flex items-center gap-1">
                        <i class="fas fa-shield-alt"></i> SSL Secured
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    <div class="mb-8">
                        <img src="/assets/brand-logo.svg" alt="Hovertask Logo" class="h-10 mb-6" />
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h2>
                        <p class="text-gray-600">Enter your credentials to access your account</p>
                    </div>

                    <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" id="email" name="email" required class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Enter your email">
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password" required class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Enter your password">
                                <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center" onclick="togglePassword()">
                                    <i class="fas fa-eye text-gray-400 hover:text-primary" id="eye-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                                <span class="text-sm text-gray-600">Remember me</span>
                            </label>
                            <a href="/forgot-password" class="text-sm text-primary hover:text-accent font-medium">
                                Forgot Password?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-primary hover:bg-accent text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-primary/30 hover:shadow-primary/40 hover:scale-[1.02]">
                            Sign In
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Or continue with</span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="grid grid-cols-2 gap-4">
                        <button class="flex items-center justify-center gap-2 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                            <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5">
                            <span class="text-sm font-medium text-gray-700">Google</span>
                        </button>
                        <button class="flex items-center justify-center gap-2 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                            <i class="fab fa-facebook text-blue-600 text-lg"></i>
                            <span class="text-sm font-medium text-gray-700">Facebook</span>
                        </button>
                    </div>

                    <!-- Sign Up Link -->
                    <p class="text-center text-gray-600 mt-8">
                        Don't have an account?
                        <a href="/signup" class="text-primary hover:text-accent font-semibold">
                            Create Account
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
    </script>
</body>
</html>
