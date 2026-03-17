@extends('admin.layout')

@section('title', 'Dashboard - Admin Panel')
@section('page_title', 'Dashboard Overview')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                <i class="fas fa-users text-primary text-xl"></i>
            </div>
            <span class="badge badge-success">+12%</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_users'] ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Total Users</p>
    </div>
    
    <!-- Total Products -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                <i class="fas fa-box text-success text-xl"></i>
            </div>
            <span class="badge badge-success">+8%</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_products'] ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Total Products</p>
    </div>
    
    <!-- Total Orders -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                <i class="fas fa-shopping-cart text-purple-600 text-xl"></i>
            </div>
            <span class="badge badge-success">+15%</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_orders'] ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Total Orders</p>
    </div>
    
    <!-- Total Revenue -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-naira-sign text-warning text-xl"></i>
            </div>
            <span class="badge badge-success">+22%</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">₦{{ number_format($stats['total_revenue'] ?? 0, 2) }}</h3>
        <p class="text-sm text-gray-500">Total Revenue</p>
    </div>
</div>

<!-- Secondary Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Active Tasks -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center">
                <i class="fas fa-tasks text-indigo-600 text-xl"></i>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['active_tasks'] ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Active Tasks</p>
    </div>
    
    <!-- Pending Withdrawals -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                <i class="fas fa-clock text-danger text-xl"></i>
            </div>
            @if(($stats['pending_withdrawals'] ?? 0) > 0)
            <span class="badge badge-danger">{{ number_format($stats['pending_withdrawals']) }} pending</span>
            @endif
        </div>
        <h3 class="text-2xl font-bold text-gray-800">₦{{ number_format($stats['pending_withdrawals_amount'] ?? 0, 2) }}</h3>
        <p class="text-sm text-gray-500">Pending Withdrawals</p>
    </div>
    
    <!-- Active Advertisements -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-pink-100 flex items-center justify-center">
                <i class="fas fa-bullhorn text-pink-600 text-xl"></i>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['active_advertises'] ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Active Advertisements</p>
    </div>
    
    <!-- Completed Tasks -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-teal-100 flex items-center justify-center">
                <i class="fas fa-check-circle text-teal-600 text-xl"></i>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['completed_tasks'] ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Completed Tasks</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Revenue Overview</h3>
        <canvas id="revenueChart" height="300"></canvas>
    </div>
    
    <!-- User Registration Chart -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">User Registrations</h3>
        <canvas id="userChart" height="300"></canvas>
    </div>
</div>

<!-- Recent Activity & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Recent Users -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Recent Users</h3>
            <a href="{{ route('admin.users.index') }}" class="text-primary text-sm hover:underline">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recent_users ?? [] as $user)
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary font-semibold">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                </div>
                <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-500 text-center py-4">No recent users</p>
            @endforelse
        </div>
    </div>
    
    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-primary text-sm hover:underline">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recent_orders ?? [] as $order)
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-800">Order #{{ $order->id }}</p>
                    <p class="text-xs text-gray-500">{{ $order->user->name ?? 'N/A' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">₦{{ number_format($order->total_amount, 2) }}</p>
                    <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'pending' ? 'badge-warning' : 'badge-neutral') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-500 text-center py-4">No recent orders</p>
            @endforelse
        </div>
    </div>
    
    <!-- Pending Approvals -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Pending Approvals</h3>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-user-clock text-warning"></i>
                    <span class="text-sm text-gray-700">KYC Verifications</span>
                </div>
                <span class="badge badge-warning">{{ $stats['pending_kyc'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-ad text-info"></i>
                    <span class="text-sm text-gray-700">Ad Reviews</span>
                </div>
                <span class="badge badge-info">{{ $stats['pending_adverts'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check text-success"></i>
                    <span class="text-sm text-gray-700">Task Approvals</span>
                </div>
                <span class="badge badge-success">{{ $stats['pending_task_approvals'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-money-bill-wave text-purple-600"></i>
                    <span class="text-sm text-gray-700">Withdrawal Requests</span>
                </div>
                <span class="badge badge-neutral">{{ $stats['pending_withdrawals'] ?? 0 }}</span>
            </div>
        </div>
    </div>
</div>

<!-- System Health -->
<div class="bg-white rounded-xl shadow-card p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">System Health</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-server text-success"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Server Status</p>
                <p class="font-semibold text-success">Online</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-database text-success"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Database</p>
                <p class="font-semibold text-success">Connected</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-memory text-warning"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Memory Usage</p>
                <p class="font-semibold text-gray-800">{{ $stats['memory_usage'] ?? '45%' }}</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-clock text-success"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Last Backup</p>
                <p class="font-semibold text-gray-800">{{ $stats['last_backup'] ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenue_labels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenue_data ?? [0, 0, 0, 0, 0, 0]) !!},
                borderColor: '#2C418F',
                backgroundColor: 'rgba(44, 65, 143, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
    
    // User Registration Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    new Chart(userCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($user_labels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
            datasets: [{
                label: 'New Users',
                data: {!! json_encode($user_data ?? [0, 0, 0, 0, 0, 0]) !!},
                backgroundColor: '#3A5AE8',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
