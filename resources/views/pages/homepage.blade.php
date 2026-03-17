@extends('layouts.public')

@section('title', 'Hovertask - Earn Money Online or Advertise Your Business')
@section('meta_description', 'Hovertask - Earn money online through tasks, advertising, reselling, and referrals. Join 500K+ users earning daily income. Advertise to thousands of engaged audiences.')
@section('meta_keywords', 'earn money online, social media tasks, advertising, Nigeria, freelance, passive income, earn from home')

@section('styles')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #2C418F 0%, #4F6BED 50%, #6366F1 100%);
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    .pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite;
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(44, 65, 143, 0.3); }
        50% { box-shadow: 0 0 40px rgba(44, 65, 143, 0.6); }
    }
    .gradient-border {
        position: relative;
        background: white;
    }
    .gradient-border::before {
        content: '';
        position: absolute;
        inset: -3px;
        background: linear-gradient(135deg, #2C418F, #6366F1, #2C418F);
        border-radius: inherit;
        z-index: -1;
    }
    .stat-counter {
        animation: count-up 2s ease-out forwards;
    }
    .feature-card:hover {
        transform: translateY(-10px);
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-gradient min-h-[90vh] relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-300 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-20 float-animation hidden lg:block">
        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 text-white">
            <i class="fas fa-check-circle text-2xl"></i>
            <span class="block text-sm mt-1">Task Completed</span>
        </div>
    </div>
    <div class="absolute top-40 left-16 float-animation hidden lg:block" style="animation-delay: 1s;">
        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 text-white">
            <i class="fas fa-naira-sign text-2xl"></i>
            <span class="block text-sm mt-1">₦5,000 Earned</span>
        </div>
    </div>

    <div class="container mx-auto px-6 py-20 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white text-sm mb-6">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Trusted by 500,000+ Users
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Earn Money Online or
                    <span class="text-amber-300">Advertise</span> Your Business
                </h1>
                
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-xl mx-auto lg:mx-0">
                    Join thousands of Nigerians earning daily income by completing simple social media tasks. 
                    Or advertise your products to engaged audiences starting at just ₦150.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-user-plus mr-2"></i>Create Free Account
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/20 transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </a>
                </div>
                
                <!-- Trust Stats -->
                <div class="flex flex-wrap gap-8 justify-center lg:justify-start mt-10 text-white/90">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-white">500K+</p>
                        <p class="text-sm">Active Users</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-white">₦50M+</p>
                        <p class="text-sm">Paid to Users</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-white">4.8★</p>
                        <p class="text-sm">User Rating</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Image -->
            <div class="relative hidden lg:block">
                <div class="relative float-animation">
                    <img src="/assets/black-girls-city.png" alt="Hovertask App" class="w-full max-w-lg mx-auto rounded-3xl shadow-2xl" />
                    
                    <!-- Floating Cards -->
                    <div class="absolute -left-8 top-10 glass-card p-4 rounded-xl shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Task Completed!</p>
                                <p class="text-sm text-green-600">+₦500 earned</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute -right-4 bottom-20 glass-card p-4 rounded-xl shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-ad text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Ad Posted!</p>
                                <p class="text-sm text-blue-600">10,000 views</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">How <span class="text-primary">Hovertask</span> Works</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Start earning or advertising in just 3 simple steps</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="text-center group">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary group-hover:scale-110 transition-all">
                    <span class="text-4xl font-bold text-primary">1</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Create Account</h3>
                <p class="text-gray-600">Sign up for free with your email or phone number. It's quick and easy!</p>
            </div>
            
            <!-- Step 2 -->
            <div class="text-center group">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary group-hover:scale-110 transition-all">
                    <span class="text-4xl font-bold text-primary">2</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Choose Activity</h3>
                <p class="text-gray-600">Complete tasks, post adverts, or resell products - you choose how to earn!</p>
            </div>
            
            <!-- Step 3 -->
            <div class="text-center group">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary group-hover:scale-110 transition-all">
                    <span class="text-4xl font-bold text-primary">3</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Get Paid</h3>
                <p class="text-gray-600">Withdraw your earnings instantly to your bank account or wallet.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Why Choose <span class="text-primary">Hovertask</span>?</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">We've made it easy for everyone to earn and advertise</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all feature-card">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-tasks text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Daily Tasks</h3>
                <p class="text-gray-600">Access over 1,000 daily tasks including liking posts, following accounts, sharing content, and more.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all feature-card">
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullhorn text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Social Advertising</h3>
                <p class="text-gray-600">Advertise your products to thousands of engaged users starting at just ₦150.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all feature-card">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Resell Products</h3>
                <p class="text-gray-600">Become a reseller and earn commission on every sale without holding inventory.</p>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all feature-card">
                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-users text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Refer & Earn</h3>
                <p class="text-gray-600">Invite friends and earn ₦500 for each referral. Plus bonus when they complete tasks!</p>
            </div>
            
            <!-- Feature 5 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all feature-card">
                <div class="w-14 h-14 bg-cyan-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-wallet text-2xl text-cyan-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Instant Withdrawals</h3>
                <p class="text-gray-600">Withdraw your earnings instantly to any Nigerian bank account.</p>
            </div>
            
            <!-- Feature 6 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all feature-card">
                <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-2xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Secure & Trusted</h3>
                <p class="text-gray-600">Your data and payments are secured with SSL encryption and verified systems.</p>
            </div>
        </div>
    </div>
</section>

<!-- Earn Money Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <img src="/assets/hand-holding-phone.png" alt="Earn Money" class="w-full max-w-md mx-auto rounded-3xl shadow-2xl" />
                
                <!-- Floating Stats -->
                <div class="absolute -bottom-6 -right-4 bg-primary text-white p-6 rounded-2xl shadow-xl">
                    <p class="text-3xl font-bold">₦50M+</p>
                    <p class="text-sm opacity-90">Total Paid to Users</p>
                </div>
            </div>
            
            <div>
                <div class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium mb-4">
                    💰 Start Earning Today
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Earn Money by Helping Others Grow</h2>
                <p class="text-lg text-gray-600 mb-8">Get paid for completing simple social media tasks. No investment or signup fee required.</p>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <span class="text-gray-700">Over 1,000 daily tasks available</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <span class="text-gray-700">Instant withdrawals to any bank</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <span class="text-gray-700">No investment or signup fee</span>
                    </div>
                </div>
                
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 rounded-full font-semibold hover:bg-primary/90 transition-all">
                    <i class="fas fa-rocket"></i> Start Earning Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Advertise Section -->
<section class="py-20 bg-gradient-to-r from-primary to-accent text-white">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block bg-white/20 text-white px-4 py-2 rounded-full text-sm font-medium mb-4">
                    📢 Advertise Your Business
                </div>
                <h2 class="text-4xl font-bold mb-6">Reach Thousands of Engaged Audiences</h2>
                <p class="text-lg opacity-90 mb-8">Get your products and services in front of thousands of active users. Our influencers will share your content with their followers.</p>
                
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-white/10 rounded-xl p-4">
                        <p class="text-3xl font-bold">10K+</p>
                        <p class="text-sm opacity-80">Daily Ad Views</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4">
                        <p class="text-3xl font-bold">5K+</p>
                        <p class="text-sm opacity-80">Active Influencers</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4">
                        <p class="text-3xl font-bold">₦150</p>
                        <p class="text-sm opacity-80">Starting Price</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4">
                        <p class="text-3xl font-bold">98%</p>
                        <p class="text-sm opacity-80">Satisfaction Rate</p>
                    </div>
                </div>
                
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white text-primary px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-all">
                    <i class="fas fa-bullhorn"></i> Start Advertising
                </a>
            </div>
            
            <div class="relative">
                <img src="/assets/app-uis.png" alt="Advertise Dashboard" class="w-full max-w-md mx-auto rounded-3xl shadow-2xl" />
            </div>
        </div>
    </div>
</section>

<!-- Refer & Earn Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="bg-gradient-to-br from-primary/10 to-purple-100 rounded-3xl p-12 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Refer Friends & Earn ₦500</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">Share your referral link with friends and earn ₦500 for each new member who joins. Plus bonus when they complete tasks!</p>
            
            <div class="flex flex-wrap justify-center gap-8 mb-8">
                <div class="text-center">
                    <p class="text-3xl font-bold text-primary">₦500</p>
                    <p class="text-gray-600">Per Referral</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-primary">10%</p>
                    <p class="text-gray-600">Task Bonus</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-primary">Unlimited</p>
                    <p class="text-gray-600">Earnings</p>
                </div>
            </div>
            
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 rounded-full font-semibold hover:bg-primary/90 transition-all">
                <i class="fas fa-share-alt"></i> Get Your Referral Link
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">What Our <span class="text-primary">Users Say</span></h2>
            <p class="text-xl text-gray-600">Join thousands of satisfied users earning daily</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                </div>
                <p class="text-gray-600 mb-6">"I've been using Hovertask for 3 months now and I've already earned over ₦50,000. The tasks are easy and payments are always on time!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold">A</div>
                    <div>
                        <p class="font-semibold text-gray-800">Adaeze M.</p>
                        <p class="text-sm text-gray-500">Lagos, Nigeria</p>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                </div>
                <p class="text-gray-600 mb-6">"As a small business owner, Hovertask has been amazing for advertising. I reached over 50,000 people with my campaign!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold">T</div>
                    <div>
                        <p class="font-semibold text-gray-800">Tunde A.</p>
                        <p class="text-sm text-gray-500">Abuja, Nigeria</p>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                    <i class="fas fa-star text-amber-400"></i>
                </div>
                <p class="text-gray-600 mb-6">"The referral program is awesome! I've referred 20 friends and earned ₦10,000 just from referrals. This is real passive income!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold">C</div>
                    <div>
                        <p class="font-semibold text-gray-800">Chioma O.</p>
                        <p class="text-sm text-gray-500">Port Harcourt</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary to-accent text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Start Earning?</h2>
        <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">Join 500,000+ users who are already earning daily with Hovertask. It's free to join!</p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                <i class="fas fa-user-plus mr-2"></i>Create Free Account
            </a>
            <a href="{{ route('about') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/20 transition-all">
                Learn More
            </a>
        </div>
        
        <div class="flex justify-center gap-6 mt-10 opacity-80">
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt"></i>
                <span class="text-sm">SSL Secured</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-user-check"></i>
                <span class="text-sm">Verified Platform</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-headset"></i>
                <span class="text-sm">24/7 Support</span>
            </div>
        </div>
    </div>
</section>
@endsection
