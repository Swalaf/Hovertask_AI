<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Hovertask - Earn money online through tasks, advertising, reselling, and referrals. Join thousands of users earning daily.')">
    <meta name="keywords" content="@yield('meta_keywords', 'earn money online, tasks, advertising, reselling, referrals, Nigeria, freelance')">
    <meta name="author" content="Hovertask">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Hovertask - Earn Money Online')">
    <meta property="og:description" content="@yield('meta_description', 'Earn money online through tasks, advertising, reselling, and referrals.')">
    <meta property="og:image" content="@yield('og_image', '/assets/og-image.jpg')">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Hovertask - Earn Money Online')">
    <meta property="twitter:description" content="@yield('meta_description', 'Earn money online through tasks, advertising, reselling, and referrals.')">
    <meta property="twitter:image" content="@yield('og_image', '/assets/og-image.jpg')">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <title>@yield('title', 'Hovertask')</title>
    
    <!-- Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                            50: '#EFF6FF',
                            100: '#DBEAFE',
                            500: '#3A5AE8',
                        },
                        success: '#10B981',
                        warning: '#F59E0B',
                        danger: '#EF4444',
                        info: '#06B6D4',
                    },
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 2px 8px rgba(0, 0, 0, 0.06)',
                        'card-hover': '0 8px 20px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        
        /* Primary color utilities */
        .text-primary { color: #2C418F; }
        .bg-primary { background-color: #2C418F; }
        .bg-primary-hover:hover { background-color: #1a2d6b; }
        .border-primary { border-color: #2C418F; }
        .hover\:text-primary:hover { color: #2C418F; }
        .hover\:bg-primary:hover { background-color: #2C418F; }
        
        /* Gradient backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #2C418F 0%, #3A5AE8 100%);
        }
        
        /* Card hover effect */
        .card-hover {
            transition: all 0.25s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Mobile sidebar */
        @media (max-width: 1023px) {
            #sidebar {
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            }
        }
        
        /* Sidebar active state */
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background-color: #F3F4F6;
        }
        .sidebar-link.active {
            background-color: #EEF2FF;
            color: #2C418F;
            font-weight: 600;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        
        /* Dropdown animations */
        .dropdown-content { 
            display: none; 
            animation: slideDown 0.2s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown:hover .dropdown-content, .dropdown.active .dropdown-content { display: block; }
        
        /* Make dropdown more clickable */
        .dropdown button { pointer-events: none; }
        .dropdown > * { pointer-events: auto; }
        .dropdown-content a { pointer-events: auto; }
        
        /* Button styles */
        .btn-primary {
            @apply bg-primary text-white px-5 py-2.5 rounded-lg font-medium transition-all duration-200;
        }
        .btn-primary:hover {
            @apply bg-primary-hover;
        }
        
        /* Card styles */
        .card {
            @apply bg-white rounded-lg border border-gray-200 overflow-hidden;
        }
        
        /* Badge styles */
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium;
        }
        .badge-success {
            @apply bg-green-100 text-green-800;
        }
        .badge-warning {
            @apply bg-yellow-100 text-yellow-800;
        }
        .badge-danger {
            @apply bg-red-100 text-red-800;
        }
        .badge-info {
            @apply bg-blue-100 text-blue-800;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50 font-body">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col fixed lg:relative inset-y-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <!-- Mobile Close Button -->
            <div class="lg:hidden flex items-center justify-between h-16 px-5 border-b border-gray-100">
                <span class="text-lg font-semibold text-gray-800 font-heading">Hovertask</span>
                <button onclick="toggleSidebar()" class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <!-- Logo - Desktop Only -->
            <div class="hidden lg:flex items-center h-16 px-5 border-b border-gray-100">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary to-indigo-500 rounded-lg flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">H</span>
                    </div>
                    <span class="text-lg font-semibold text-gray-800 font-heading">Hovertask</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }} sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->is('dashboard') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-500' }}">
                        <i class="fas fa-th-large text-sm"></i>
                    </div>
                    <span>Dashboard</span>
                </a>

                <!-- Earn Dropdown -->
                <div class="relative dropdown">
                    <button class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-100 text-green-600">
                                <i class="fas fa-wallet text-sm"></i>
                            </div>
                            <span>Earn</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                    </button>
                    <div class="dropdown-content absolute left-0 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('dashboard.earn') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-star w-4 text-xs"></i>
                            <span>Earn Hub</span>
                        </a>
                        <a href="{{ route('dashboard.earn.tasks') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-thumbs-up w-4 text-xs"></i>
                            <span>Social Tasks</span>
                        </a>
                        <a href="{{ route('dashboard.earn.adverts') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-bullhorn w-4 text-xs"></i>
                            <span>Post Adverts</span>
                        </a>
                        <a href="{{ route('dashboard.earn.resell') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-chart-line w-4 text-xs"></i>
                            <span>Resell Products</span>
                        </a>
                    </div>
                </div>

                <!-- Freelance (Job) Dropdown -->
                <div class="relative dropdown">
                    <button class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                                <i class="fas fa-briefcase text-sm"></i>
                            </div>
                            <span>Freelance (Job)</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                    </button>
                    <div class="dropdown-content absolute left-0 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('dashboard.freelance') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-laptop-house w-4 text-xs"></i>
                            <span>Browse Freelance</span>
                        </a>
                        <a href="{{ route('dashboard.freelance.my-tasks') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-list w-4 text-xs"></i>
                            <span>My Freelance Projects</span>
                        </a>
                        <a href="{{ route('dashboard.jobs') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-briefcase w-4 text-xs"></i>
                            <span>Browse Jobs</span>
                        </a>
                        <a href="{{ route('dashboard.jobs.my-jobs') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-building w-4 text-xs"></i>
                            <span>My Posted Jobs</span>
                        </a>
                    </div>
                </div>

                <!-- Marketplace Dropdown -->
                <div class="relative dropdown">
                    <button class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                                <i class="fas fa-store text-sm"></i>
                            </div>
                            <span>Marketplace</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                    </button>
                    <div class="dropdown-content absolute left-0 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('dashboard.marketplace') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-store w-4 text-xs"></i>
                            <span>Browse Marketplace</span>
                        </a>
                        <a href="{{ route('dashboard.marketplace.listings') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-list w-4 text-xs"></i>
                            <span>My Listings</span>
                        </a>
                        <a href="{{ route('dashboard.marketplace.create') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-plus-circle w-4 text-xs"></i>
                            <span>Add Product</span>
                        </a>
                        <a href="{{ route('reseller.stats') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-primary hover:bg-gray-50 transition-all">
                            <i class="fas fa-chart-line w-4 text-xs"></i>
                            <span>Reseller Stats</span>
                        </a>
                    </div>
                </div>

                <!-- AddMeUp -->
                <a href="{{ route('dashboard.add-me-up') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="fas fa-user-plus text-sm"></i>
                    </div>
                    <span>AddMeUp</span>
                </a>

                <!-- Wallet -->
                <a href="{{ route('dashboard.wallet') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                        <i class="fas fa-wallet text-sm"></i>
                    </div>
                    <span>Wallet</span>
                </a>

                <!-- Refer & Earn -->
                <a href="{{ route('dashboard.refer') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-pink-100 text-pink-600">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                    <span>Refer & Earn</span>
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div class="pt-3 border-t border-gray-100 px-3 pb-4 space-y-1">
                <!-- KYC Status -->
                <div class="px-3 py-2.5 rounded-lg bg-gradient-to-r from-primary to-indigo-500 text-white mb-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs opacity-80">KYC Status</span>
                        <span class="badge bg-white/20 text-white text-xs">Verified</span>
                    </div>
                </div>
                
                <a href="{{ route('dashboard.settings') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-500">
                        <i class="fas fa-cog text-sm"></i>
                    </div>
                    <span>Settings</span>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="fas fa-sign-out-alt text-sm"></i>
                    </div>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6">
                <!-- Mobile Menu Button -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg mr-2">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                
                <!-- Search -->
                <div class="flex-1 max-w-md hidden sm:block">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all border border-transparent focus:border-primary">
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-2 lg:gap-4">
                    <!-- Quick Fund - Hidden on mobile -->
                    <a href="{{ route('dashboard.fund.wallet') }}" class="btn-primary text-sm hidden sm:inline-flex">
                        <i class="fas fa-plus mr-1.5"></i><span class="hidden lg:inline">Fund Wallet</span>
                    </a>
                    
                    <!-- Notifications -->
                    <a href="{{ route('dashboard.notifications') }}" class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </a>

                    <!-- User Menu -->
                    @auth
                    <div class="flex items-center gap-2 lg:gap-3 pl-2 lg:pl-4 border-l border-gray-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->fname ?? 'User' }}</p>
                            <p class="text-xs text-gray-500 hidden lg:block"> {{ Auth::user()->email ?? 'user@hovertask.com' }}</p>
                        </div>
                        <div class="w-9 h-9 bg-gradient-to-br from-primary to-indigo-500 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md">
                            {{ strtoupper(substr(Auth::user()->fname ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-primary hover:underline font-medium text-sm hidden sm:block">Sign In</a>
                    @endauth
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
    
    <script>
        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        // Dropdown click handler
        document.querySelectorAll('.dropdown > button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                this.parentElement.classList.toggle('active');
            });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        });
    </script>
</body>
</html>
