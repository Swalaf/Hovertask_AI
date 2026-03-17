<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Hovertask - Earn money online through tasks, advertising, reselling, and referrals in Nigeria. Join thousands of users earning daily income.')">
    <meta name="keywords" content="@yield('meta_keywords', 'earn money online, tasks, advertising, reselling, referrals, Nigeria, freelance, social media marketing')">
    <meta name="author" content="Hovertask">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Hovertask - Earn or Advertise on Social Media')">
    <meta property="og:description" content="@yield('meta_description', 'Earn money online through tasks, advertising, reselling, and referrals. Join thousands of users earning daily income.')">
    <meta property="og:image" content="@yield('og_image', '/assets/og-image.jpg')">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Hovertask - Earn or Advertise on Social Media')">
    <meta property="twitter:description" content="@yield('meta_description', 'Earn money online through tasks, advertising, reselling, and referrals.')">
    <meta property="twitter:image" content="@yield('og_image', '/assets/og-image.jpg')">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <title>@yield('title', 'Hovertask - Earn or Advertise on Social Media')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#2C418F',
                            50: '#EEF2FF',
                            100: '#E0E7FF',
                            200: '#C7D2FE',
                            300: '#A5B4FC',
                            400: '#818CF8',
                            500: '#6366F1',
                            600: '#4F46E5',
                            700: '#4338CA',
                            800: '#2C418F',
                            900: '#1E1B4B',
                        },
                        accent: {
                            DEFAULT: '#3A5AE8',
                            500: '#3A5AE8',
                        }
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
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        
        .gradient-text {
            background: linear-gradient(to right, #2C418F, #4F6BED);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .bg-base { background-color: #2C418F; }
        .text-base { color: #2C418F; }
        .hover\:bg-base:hover { background-color: #2C418F; }
        .border-base { border-color: #2C418F; }
        
        /* Smooth animations */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #2C418F;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-sm sticky top-0 w-full left-0 z-50 shadow-sm border-b border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-primary to-accent rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-2xl">H</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-800">Hovertask</span>
                </a>

                <!-- Desktop Navigation -->
                <nav role="navigation" class="hidden lg:flex gap-8 items-center">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'text-primary font-semibold' : 'text-gray-600 hover:text-primary' }} transition-colors">
                        Home
                    </a>
                    <a href="{{ route('marketplace') }}" class="nav-link {{ request()->is('marketplace*') ? 'text-primary font-semibold' : 'text-gray-600 hover:text-primary' }} transition-colors">
                        Marketplace
                    </a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->is('about*') ? 'text-primary font-semibold' : 'text-gray-600 hover:text-primary' }} transition-colors">
                        About Us
                    </a>
                    <a href="{{ route('faq') }}" class="nav-link {{ request()->is('faq*') ? 'text-primary font-semibold' : 'text-gray-600 hover:text-primary' }} transition-colors">
                        FAQ
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->is('contact*') ? 'text-primary font-semibold' : 'text-gray-600 hover:text-primary' }} transition-colors">
                        Contact Us
                    </a>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden lg:flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-medium transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-full font-medium shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        Create Account
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 text-gray-600" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 px-4 py-4">
            <nav class="flex flex-col gap-4">
                <a href="/" class="text-gray-600 hover:text-primary py-2">Home</a>
                <a href="{{ route('marketplace') }}" class="text-gray-600 hover:text-primary py-2">Marketplace</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary py-2">About Us</a>
                <a href="{{ route('faq') }}" class="text-gray-600 hover:text-primary py-2">FAQ</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary py-2">Contact Us</a>
                <hr class="my-2">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary py-2">Sign In</a>
                <a href="{{ route('register') }}" class="bg-primary text-white text-center px-6 py-3 rounded-full font-medium">Create Account</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-primary to-[#1a1a2e] text-gray-200 py-12 pt-24 relative overflow-hidden">
        <!-- Wave Effect -->
        <div class="absolute h-[60px] w-full bg-white top-0 left-0"></div>
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pt-8">
                <!-- Brand -->
                <div class="flex flex-col">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">H</span>
                        </div>
                        <span class="text-xl font-bold text-white">Hovertask</span>
                    </div>
                    <p class="text-gray-300">
                        Our mission is to create opportunities for people to earn daily income while helping
                        businesses reach a wider audience.
                    </p>
                    <!-- Trust Badges -->
                    <div class="flex items-center gap-3 mt-4">
                        <div class="flex items-center gap-1 text-xs text-gray-300">
                            <i class="fas fa-shield-alt text-green-400"></i>
                            <span>SSL Secured</span>
                        </div>
                        <div class="flex items-center gap-1 text-xs text-gray-300">
                            <i class="fas fa-user-shield text-primary"></i>
                            <span>Verified</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('marketplace') }}" class="hover:text-white transition">Marketplace</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Useful Links -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Useful Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-white transition">Terms & Conditions</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Support</a></li>
                    </ul>
                </div>

                <!-- Social & App -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Connect With Us</h3>
                    <div class="flex gap-4 mb-6">
                        <a href="https://web.facebook.com/hovertaskng" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/hovertaskng" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/hovertaskng/" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/hovertask-ng" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-12 pt-6 border-t border-white/10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-400">
                        &copy; {{ date('Y') }} Hovertask. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-400">
                        Made with <i class="fas fa-heart text-red-400"></i> by <a href="https://Deepmynd.ca" target="_blank" class="text-primary hover:underline">Deepmynd Technologies Limited</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
