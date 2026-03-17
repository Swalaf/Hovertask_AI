@extends('admin.layout')

@section('title', 'Users Management')
@section('page_title', 'Users')

@section('content')
<div class="bg-white rounded-xl shadow-card">
    <!-- Header -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">All Users</h2>
                <p class="text-sm text-gray-500">Manage user accounts, roles, and permissions</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="exportData('users')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add User
                </a>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="mt-4 flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" id="searchInput" placeholder="Search by name or email..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <select id="roleFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Roles</option>
                <option value="superadministrator">Super Admin</option>
                <option value="administrator">Admin</option>
                <option value="manager">Manager</option>
                <option value="user">User</option>
            </select>
            <select id="statusFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="banned">Banned</option>
                <option value="pending">Pending</option>
            </select>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3">
                        <input type="checkbox" id="selectAll" class="rounded border-gray-300">
                    </th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Wallet Balance</th>
                    <th class="px-6 py-3">Joined</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @forelse($users ?? [] as $user)
                <tr>
                    <td class="px-6 py-4">
                        <input type="checkbox" class="user-checkbox rounded border-gray-300" value="{{ $user->id }}">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary font-semibold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                        $roleColors = [
                            'superadministrator' => 'danger',
                            'administrator' => 'warning',
                            'manager' => 'info',
                            'user' => 'neutral'
                        ];
                        $role = $user->roles->first();
                        $roleName = $role ? $role->name : 'user';
                        $color = $roleColors[$roleName] ?? 'neutral';
                        @endphp
                        <span class="badge badge-{{ $color }}">{{ ucfirst($roleName) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->is_banned)
                        <span class="badge badge-danger">Banned</span>
                        @else
                        <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        ₦{{ number_format($user->wallet->balance ?? 0, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="p-2 text-gray-500 hover:text-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-gray-500 hover:text-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->is_banned)
                            <button onclick="unbanUser({{ $user->id }})" class="p-2 text-gray-500 hover:text-success" title="Unban">
                                <i class="fas fa-user-check"></i>
                            </button>
                            @else
                            <button onclick="banUser({{ $user->id }})" class="p-2 text-gray-500 hover:text-danger" title="Ban">
                                <i class="fas fa-user-slash"></i>
                            </button>
                            @endif
                            <button onclick="deleteUser({{ $user->id }})" class="p-2 text-gray-500 hover:text-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        No users found
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
                Showing {{ ($users->currentPage() - 1) * $users->perPage() + 1 }} to 
                {{ min($users->currentPage() * $users->perPage(), $users->total()) }} 
                of {{ number_format($users->total()) }} results
            </p>
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Ban User Modal -->
<div id="banModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Ban User</h3>
        <p class="text-gray-600 mb-4">Are you sure you want to ban this user? They will no longer be able to access their account.</p>
        <form id="banForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason (optional)</label>
                <textarea name="reason" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter ban reason..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeBanModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-danger text-white rounded-lg hover:bg-red-600">Ban User</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete User Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Delete User</h3>
        <p class="text-gray-600 mb-4">Are you sure you want to delete this user? This action cannot be undone.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-danger text-white rounded-lg hover:bg-red-600">Delete</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentUserId = null;
    
    function banUser(userId) {
        currentUserId = userId;
        document.getElementById('banForm').action = `/admin/users/${userId}/ban`;
        document.getElementById('banModal').classList.remove('hidden');
        document.getElementById('banModal').classList.add('flex');
    }
    
    function closeBanModal() {
        document.getElementById('banModal').classList.add('hidden');
        document.getElementById('banModal').classList.remove('flex');
    }
    
    function unbanUser(userId) {
        if(confirm('Are you sure you want to unban this user?')) {
            fetch(`/admin/users/${userId}/unban`, {
                method: 'POST',
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
    
    function deleteUser(userId) {
        currentUserId = userId;
        document.getElementById('deleteForm').action = `/admin/users/${userId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
    
    // Search and Filter
    document.getElementById('searchInput').addEventListener('input', debounce(function(e) {
        filterUsers();
    }, 500));
    
    document.getElementById('roleFilter').addEventListener('change', filterUsers);
    document.getElementById('statusFilter').addEventListener('change', filterUsers);
    
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    function filterUsers() {
        const search = document.getElementById('searchInput').value;
        const role = document.getElementById('roleFilter').value;
        const status = document.getElementById('statusFilter').value;
        
        const params = new URLSearchParams();
        if(search) params.append('search', search);
        if(role) params.append('role', role);
        if(status) params.append('status', status);
        
        window.location.href = `{{ route('admin.users.index') }}?${params.toString()}`;
    }
    
    // Select All
    document.getElementById('selectAll').addEventListener('change', function(e) {
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });
    
    function exportData(type) {
        window.location.href = `/admin/export/${type}`;
    }
</script>
@endpush
