@extends('admin.layout')

@section('title', 'Activity Logs')
@section('page_title', 'Activity Logs')

@section('content')
<div class="bg-white rounded-xl shadow-card">
    <!-- Header -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Activity Logs</h2>
                <p class="text-sm text-gray-500">Track all administrative actions and system events</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="exportLogs()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <button onclick="clearLogs()" class="px-4 py-2 bg-danger text-white rounded-lg hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash mr-2"></i>Clear Logs
                </button>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="mt-4 flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" id="searchInput" placeholder="Search logs..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <select id="typeFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Types</option>
                <option value="user">User Activity</option>
                <option value="admin">Admin Activity</option>
                <option value="system">System</option>
                <option value="transaction">Transaction</option>
                <option value="auth">Authentication</option>
            </select>
            <select id="actionFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Actions</option>
                <option value="create">Created</option>
                <option value="update">Updated</option>
                <option value="delete">Deleted</option>
                <option value="login">Login</option>
                <option value="logout">Logout</option>
                <option value="ban">Banned</option>
                <option value="unban">Unbanned</option>
            </select>
            <input type="date" id="dateFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
    </div>
    
    <!-- Logs Table -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3">Timestamp</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Action</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">IP Address</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs ?? [] as $log)
                <tr>
                    <td class="px-6 py-4">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $log->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $log->created_at->format('H:i:s') }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($log->user)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary text-sm font-semibold">
                                {{ substr($log->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $log->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $log->user->email }}</p>
                            </div>
                        </div>
                        @else
                        <span class="text-gray-400">System</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @php
                        $typeColors = [
                            'user' => 'info',
                            'admin' => 'warning',
                            'system' => 'neutral',
                            'transaction' => 'success',
                            'auth' => 'purple'
                        ];
                        @endphp
                        <span class="badge badge-{{ $typeColors[$log->type] ?? 'neutral' }}">
                            {{ ucfirst($log->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                        $actionColors = [
                            'create' => 'success',
                            'update' => 'warning',
                            'delete' => 'danger',
                            'login' => 'info',
                            'logout' => 'neutral',
                            'ban' => 'danger',
                            'unban' => 'success'
                        ];
                        @endphp
                        <span class="badge badge-{{ $actionColors[$log->action] ?? 'neutral' }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-700">{{ Str::limit($log->description, 80) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-500">{{ $log->ip_address ?? 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <button onclick="viewLogDetails({{ $log->id }})" class="p-2 text-gray-500 hover:text-primary" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        No activity logs found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-6 border-t border-gray-100">
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Showing {{ ($logs->currentPage() - 1) * $logs->perPage() + 1 }} to 
                {{ min($logs->currentPage() * $logs->perPage(), $logs->total()) }} 
                of {{ number_format($logs->total()) }} results
            </p>
            {{ $logs->links() }}
        </div>
    </div>
</div>

<!-- Log Details Modal -->
<div id="logDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Activity Log Details</h3>
            <button onclick="closeLogDetailsModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="logDetailsContent" class="space-y-4">
            <!-- Content loaded via AJAX -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
function viewLogDetails(logId) {
    fetch(`/admin/activity-logs/${logId}`)
        .then(response => response.json())
        .then(data => {
            const content = `
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Timestamp</p>
                        <p class="font-medium">${data.created_at}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Type</p>
                        <p class="font-medium">${data.type}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Action</p>
                        <p class="font-medium">${data.action}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">User</p>
                        <p class="font-medium">${data.user_name || 'System'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">IP Address</p>
                        <p class="font-medium">${data.ip_address || 'N/A'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">User Agent</p>
                        <p class="font-medium">${data.user_agent || 'N/A'}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Description</p>
                    <p class="mt-1">${data.description}</p>
                </div>
                ${data.metadata ? `
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Additional Data</p>
                    <pre class="mt-1 p-3 bg-gray-50 rounded-lg overflow-x-auto text-sm">${JSON.stringify(data.metadata, null, 2)}</pre>
                </div>
                ` : ''}
            `;
            document.getElementById('logDetailsContent').innerHTML = content;
            document.getElementById('logDetailsModal').classList.remove('hidden');
            document.getElementById('logDetailsModal').classList.add('flex');
        });
}

function closeLogDetailsModal() {
    document.getElementById('logDetailsModal').classList.add('hidden');
    document.getElementById('logDetailsModal').classList.remove('flex');
}

function exportLogs() {
    const params = new URLSearchParams(window.location.search);
    params.set('export', 'true');
    window.location.href = `{{ route('admin.activity-logs.index') }}?${params.toString()}`;
}

function clearLogs() {
    if(confirm('Are you sure you want to clear all activity logs? This action cannot be undone.')) {
        fetch('{{ route('admin.activity-logs.clear') }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              if(data.success) {
                  location.reload();
              }
          });
    }
}

function filterLogs() {
    const search = document.getElementById('searchInput').value;
    const type = document.getElementById('typeFilter').value;
    const action = document.getElementById('actionFilter').value;
    const date = document.getElementById('dateFilter').value;
    
    const params = new URLSearchParams();
    if(search) params.append('search', search);
    if(type) params.append('type', type);
    if(action) params.append('action', action);
    if(date) params.append('date', date);
    
    window.location.href = `{{ route('admin.activity-logs.index') }}?${params.toString()}`;
}

document.getElementById('searchInput').addEventListener('input', debounce(filterLogs, 500));
document.getElementById('typeFilter').addEventListener('change', filterLogs);
document.getElementById('actionFilter').addEventListener('change', filterLogs);
document.getElementById('dateFilter').addEventListener('change', filterLogs);

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}
@endpush
