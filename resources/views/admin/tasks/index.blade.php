@extends('admin.layout')

@section('title', 'Tasks Management')
@section('page_title', 'Tasks')

@section('content')
<div class="bg-white rounded-xl shadow-card">
    <!-- Header -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Tasks Management</h2>
                <p class="text-sm text-gray-500">Create, manage, and track all platform tasks</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="exportData('tasks')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <a href="{{ route('admin.tasks.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create Task
                </a>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="mt-4 flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" id="searchInput" placeholder="Search tasks..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <select id="statusFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
                <option value="expired">Expired</option>
            </select>
            <select id="typeFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Types</option>
                <option value="simple">Simple Task</option>
                <option value="advert">Advertisement</option>
                <option value="engagement">Engagement</option>
                <option value="freelance">Freelance</option>
                <option value="job">Job</option>
            </select>
            <select id="categoryFilter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Categories</option>
                <option value="social_media">Social Media</option>
                <option value="marketing">Marketing</option>
                <option value="data_entry">Data Entry</option>
                <option value="design">Design</option>
                <option value="development">Development</option>
            </select>
        </div>
    </div>
    
    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 p-6 border-b border-gray-100">
        <div class="text-center">
            <p class="text-2xl font-bold text-primary">{{ $stats['total_tasks'] ?? 0 }}</p>
            <p class="text-sm text-gray-500">Total</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-success">{{ $stats['active_tasks'] ?? 0 }}</p>
            <p class="text-sm text-gray-500">Active</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-warning">{{ $stats['pending_tasks'] ?? 0 }}</p>
            <p class="text-sm text-gray-500">Pending</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-info">{{ $stats['completed_tasks'] ?? 0 }}</p>
            <p class="text-sm text-gray-500">Completed</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-danger">{{ $stats['expired_tasks'] ?? 0 }}</p>
            <p class="text-sm text-gray-500">Expired</p>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Reward</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Participants</th>
                    <th class="px-6 py-3">Created</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks ?? [] as $task)
                <tr>
                    <td class="px-6 py-4">#{{ $task->id }}</td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium text-gray-800">{{ Str::limit($task->title, 40) }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($task->description, 60) }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                        $typeColors = [
                            'simple' => 'info',
                            'advert' => 'warning',
                            'engagement' => 'success',
                            'freelance' => 'purple',
                            'job' => 'neutral'
                        ];
                        @endphp
                        <span class="badge badge-{{ $typeColors[$task->type] ?? 'neutral' }}">
                            {{ ucfirst($task->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ ucfirst($task->category ?? 'N/A') }}
                    </td>
                    <td class="px-6 py-4">
                        ₦{{ number_format($task->reward_amount, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                        $statusColors = [
                            'active' => 'success',
                            'pending' => 'warning',
                            'completed' => 'info',
                            'cancelled' => 'danger',
                            'expired' => 'neutral'
                        ];
                        @endphp
                        <span class="badge badge-{{ $statusColors[$task->status] ?? 'neutral' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span>{{ $task->participants_count ?? 0 }}</span>
                            <span class="text-gray-400">/</span>
                            <span>{{ $task->max_participants ?? '∞' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.tasks.show', $task->id) }}" class="p-2 text-gray-500 hover:text-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="p-2 text-gray-500 hover:text-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($task->status === 'active')
                            <button onclick="archiveTask({{ $task->id }})" class="p-2 text-gray-500 hover:text-danger" title="Archive">
                                <i class="fas fa-archive"></i>
                            </button>
                            @endif
                            <button onclick="deleteTask({{ $task->id }})" class="p-2 text-gray-500 hover:text-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        No tasks found
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
                Showing {{ ($tasks->currentPage() - 1) * $tasks->perPage() + 1 }} to 
                {{ min($tasks->currentPage() * $tasks->perPage(), $tasks->total()) }} 
                of {{ number_format($tasks->total()) }} results
            </p>
            {{ $tasks->links() }}
        </div>
    </div>
</div>

<!-- Create/Edit Task Modal -->
<div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 overflow-y-auto">
    <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4 my-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Create New Task</h3>
            <button onclick="closeTaskModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="taskForm" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Task Title</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Task Type</label>
                    <select name="type" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="simple">Simple Task</option>
                        <option value="advert">Advertisement</option>
                        <option value="engagement">Engagement</option>
                        <option value="freelance">Freelance</option>
                        <option value="job">Job</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="social_media">Social Media</option>
                        <option value="marketing">Marketing</option>
                        <option value="data_entry">Data Entry</option>
                        <option value="design">Design</option>
                        <option value="development">Development</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reward Amount (₦)</label>
                    <input type="number" name="reward_amount" step="0.01" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Participants</label>
                    <input type="number" name="max_participants" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Leave empty for unlimited">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date" name="start_date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                    <input type="date" name="end_date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                    <textarea name="requirements" rows="2" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter task requirements..."></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeTaskModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">Create Task</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
function openTaskModal() {
    document.getElementById('taskForm').reset();
    document.getElementById('taskModal').classList.remove('hidden');
    document.getElementById('taskModal').classList.add('flex');
}

function closeTaskModal() {
    document.getElementById('taskModal').classList.add('hidden');
    document.getElementById('taskModal').classList.remove('flex');
}

function archiveTask(taskId) {
    if(confirm('Are you sure you want to archive this task?')) {
        fetch(`/admin/tasks/${taskId}/archive`, {
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

function deleteTask(taskId) {
    if(confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
        fetch(`/admin/tasks/${taskId}`, {
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

function filterTasks() {
    const search = document.getElementById('searchInput').value;
    const status = document.getElementById('statusFilter').value;
    const type = document.getElementById('typeFilter').value;
    const category = document.getElementById('categoryFilter').value;
    
    const params = new URLSearchParams();
    if(search) params.append('search', search);
    if(status) params.append('status', status);
    if(type) params.append('type', type);
    if(category) params.append('category', category);
    
    window.location.href = `{{ route('admin.tasks.index') }}?${params.toString()}`;
}

document.getElementById('searchInput').addEventListener('input', debounce(filterTasks, 500));
document.getElementById('statusFilter').addEventListener('change', filterTasks);
document.getElementById('typeFilter').addEventListener('change', filterTasks);
document.getElementById('categoryFilter').addEventListener('change', filterTasks);

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}
@endpush
