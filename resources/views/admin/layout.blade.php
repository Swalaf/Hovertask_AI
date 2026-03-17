<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Hovertask Admin Panel')">
    <meta name="keywords" content="@yield('meta_keywords', 'admin, hovertask, management')">
    
    <title>@yield('title', 'Admin Panel') - Hovertask</title>
    
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
                        dark: '#1F2937',
                    },
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        
        .sidebar-link {
            @apply flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-primary-700 hover:text-white rounded-lg transition-all duration-200;
        }
        
        .sidebar-link.active {
            @apply bg-primary-700 text-white font-medium;
        }
        
        .stat-card {
            @apply bg-white rounded-xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300;
        }
        
        .data-table {
            @apply w-full text-left;
        }
        
        .data-table th {
            @apply px-4 py-3 text-sm font-semibold text-gray-600 bg-gray-50 border-b;
        }
        
        .data-table td {
            @apply px-4 py-3 text-sm text-gray-700 border-b;
        }
        
        .data-table tr:hover td {
            @apply bg-gray-50;
        }
        
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
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
        
        .badge-neutral {
            @apply bg-gray-100 text-gray-800;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100 font-body">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-dark flex-shrink-0 flex flex-col">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">H</span>
                    </div>
                    <span class="text-white font-heading font-bold text-xl">Admin</span>
                </a>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <!-- Users Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Users</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users w-5"></i>
                        <span>All Users</span>
                    </a>
                    <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <i class="fas fa-user-tag w-5"></i>
                        <span>Roles & Permissions</span>
                    </a>
                    
                    <!-- Marketplace Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Marketplace</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-box w-5"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart w-5"></i>
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags w-5"></i>
                        <span>Categories</span>
                    </a>
                    
                    <!-- Tasks & Earnings Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tasks & Earnings</p>
                    </div>
                    <a href="{{ route('admin.tasks.index') }}" class="sidebar-link {{ request()->routeIs('admin.tasks.*') ? 'active' : '' }}">
                        <i class="fas fa-tasks w-5"></i>
                        <span>Tasks</span>
                    </a>
                    <a href="{{ route('admin.completed-tasks.index') }}" class="sidebar-link {{ request()->routeIs('admin.completed-tasks.*') ? 'active' : '' }}">
                        <i class="fas fa-check-circle w-5"></i>
                        <span>Completed Tasks</span>
                    </a>
                    <a href="{{ route('admin.advertises.index') }}" class="sidebar-link {{ request()->routeIs('admin.advertises.*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn w-5"></i>
                        <span>Advertisements</span>
                    </a>
                    <a href="{{ route('admin.withdrawals.index') }}" class="sidebar-link {{ request()->routeIs('admin.withdrawals.*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave w-5"></i>
                        <span>Withdrawals</span>
                    </a>
                    <a href="{{ route('admin.transactions.index') }}" class="sidebar-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt w-5"></i>
                        <span>Transactions</span>
                    </a>
                    
                    <!-- Referrals & Resellers -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Referrals</p>
                    </div>
                    <a href="{{ route('admin.referrals.index') }}" class="sidebar-link {{ request()->routeIs('admin.referrals.*') ? 'active' : '' }}">
                        <i class="fas fa-share-alt w-5"></i>
                        <span>Referrals</span>
                    </a>
                    <a href="{{ route('admin.reseller-conversions.index') }}" class="sidebar-link {{ request()->routeIs('admin.reseller-conversions.*') ? 'active' : '' }}">
                        <i class="fas fa-store w-5"></i>
                        <span>Reseller Conversions</span>
                    </a>
                    
                    <!-- System Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">System</p>
                    </div>
                    <a href="{{ route('admin.activity-logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                        <i class="fas fa-history w-5"></i>
                        <span>Activity Logs</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cogs w-5"></i>
                        <span>Settings</span>
                    </a>
                    <a href="{{ route('admin.maintenance.index') }}" class="sidebar-link {{ request()->routeIs('admin.maintenance.*') ? 'active' : '' }}">
                        <i class="fas fa-tools w-5"></i>
                        <span>Maintenance</span>
                    </a>
                </div>
            </nav>
            
            <!-- User Profile -->
            <div class="border-t border-gray-700 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-semibold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email ?? 'admin@hovertask.com' }}</p>
                    </div>
                    <a href="{{ route('logout') }}" class="text-gray-400 hover:text-white" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700 lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-heading font-semibold text-gray-800">
                        @yield('page_title', 'Dashboard')
                    </h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    
                    <!-- Quick Links -->
                    <a href="{{ url('/') }}" target="_blank" class="p-2 text-gray-500 hover:text-gray-700" title="View Website">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('scripts')
</body>
</html>
