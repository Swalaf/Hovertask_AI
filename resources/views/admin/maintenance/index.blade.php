@extends('admin.layout')

@section('title', 'System Maintenance')
@section('page_title', 'Maintenance')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Cache Management -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                <i class="fas fa-database text-primary text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Cache Management</h3>
                <p class="text-sm text-gray-500">Clear application and route cache</p>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Application Cache</p>
                        <p class="text-sm text-gray-500">Clear all cached data</p>
                    </div>
                    <button onclick="clearCache('app')" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                        Clear
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Route Cache</p>
                        <p class="text-sm text-gray-500">Clear route cache</p>
                    </div>
                    <button onclick="clearCache('routes')" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                        Clear
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Config Cache</p>
                        <p class="text-sm text-gray-500">Clear configuration cache</p>
                    </div>
                    <button onclick="clearCache('config')" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                        Clear
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">View Cache</p>
                        <p class="text-sm text-gray-500">Clear compiled views</p>
                    </div>
                    <button onclick="clearCache('views')" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                        Clear
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-yellow-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Clear All Cache</p>
                        <p class="text-sm text-gray-500">Clear all cached data at once</p>
                    </div>
                    <button onclick="clearCache('all')" class="px-4 py-2 bg-warning text-white rounded-lg hover:bg-yellow-600">
                        Clear All
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Database Optimization -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                <i class="fas fa-server text-success text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Database Optimization</h3>
                <p class="text-sm text-gray-500">Optimize database performance</p>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Migrate Database</p>
                        <p class="text-sm text-gray-500">Run pending migrations</p>
                    </div>
                    <button onclick="runMigrations()" class="px-4 py-2 bg-success text-white rounded-lg hover:bg-green-600">
                        Migrate
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Seed Database</p>
                        <p class="text-sm text-gray-500">Run database seeders</p>
                    </div>
                    <button onclick="seedDatabase()" class="px-4 py-2 bg-success text-white rounded-lg hover:bg-green-600">
                        Seed
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Optimize Database</p>
                        <p class="text-sm text-gray-500">Optimize database tables</p>
                    </div>
                    <button onclick="optimizeDatabase()" class="px-4 py-2 bg-success text-white rounded-lg hover:bg-green-600">
                        Optimize
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Backup & Restore -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                <i class="fas fa-hdd text-purple-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Backup & Restore</h3>
                <p class="text-sm text-gray-500">Manage database backups</p>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Create Backup</p>
                        <p class="text-sm text-gray-500">Create a full database backup</p>
                    </div>
                    <button onclick="createBackup()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        <i class="fas fa-download mr-2"></i>Backup
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Restore Backup</p>
                        <p class="text-sm text-gray-500">Restore from a backup file</p>
                    </div>
                    <label class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 cursor-pointer">
                        <i class="fas fa-upload mr-2"></i>Restore
                        <input type="file" class="hidden" accept=".sql,.zip" onchange="restoreBackup(this)">
                    </label>
                </div>
            </div>
            
            <div class="mt-4">
                <h4 class="font-medium text-gray-800 mb-3">Recent Backups</h4>
                <div class="space-y-2">
                    @forelse($backups ?? [] as $backup)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-file-archive text-gray-400"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $backup->name }}</p>
                                <p class="text-xs text-gray-500">{{ $backup->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="downloadBackup('{{ $backup->path }}')" class="p-2 text-gray-500 hover:text-primary" title="Download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button onclick="deleteBackup('{{ $backup->name }}')" class="p-2 text-gray-500 hover:text-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 text-center py-4">No backups available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Log Management -->
    <div class="bg-white rounded-xl shadow-card p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                <i class="fas fa-file-alt text-gray-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Log Management</h3>
                <p class="text-sm text-gray-500">View and manage system logs</p>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">View Application Logs</p>
                        <p class="text-sm text-gray-500">View recent application logs</p>
                    </div>
                    <a href="{{ route('admin.logs.view') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        View
                    </a>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">View Error Logs</p>
                        <p class="text-sm text-gray-500">View recent error logs</p>
                    </div>
                    <a href="{{ route('admin.logs.errors') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        View
                    </a>
                </div>
            </div>
            
            <div class="p-4 bg-red-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">Clear All Logs</p>
                        <p class="text-sm text-gray-500">Delete all log files</p>
                    </div>
                    <button onclick="clearLogs()" class="px-4 py-2 bg-danger text-white rounded-lg hover:bg-red-600">
                        Clear
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Disk Usage -->
        <div class="mt-6">
            <h4 class="font-medium text-gray-800 mb-3">Disk Usage</h4>
            <div class="space-y-3">
                <div>
                    <div class="flex items-center justify-between text-sm mb-1">
                        <span class="text-gray-600">Storage Used</span>
                        <span class="font-medium">{{ $diskUsage['used'] ?? '0 MB' }} / {{ $diskUsage['total'] ?? '0 MB' }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full" style="width: {{ $diskUsage['percentage'] ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-8 text-center">
        <div class="animate-spin w-12 h-12 border-4 border-primary border-t-transparent rounded-full mx-auto mb-4"></div>
        <p class="text-gray-700 font-medium">Processing...</p>
        <p class="text-sm text-gray-500 mt-1">Please wait</p>
    </div>
</div>
@endsection

@push('scripts')
function showLoading() {
    document.getElementById('loadingModal').classList.remove('hidden');
    document.getElementById('loadingModal').classList.add('flex');
}

function hideLoading() {
    document.getElementById('loadingModal').classList.add('hidden');
    document.getElementById('loadingModal').classList.remove('flex');
}

function clearCache(type) {
    if(confirm(`Are you sure you want to clear ${type} cache?`)) {
        showLoading();
        fetch(`/admin/maintenance/clear-cache/${type}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              hideLoading();
              if(data.success) {
                  alert('Cache cleared successfully!');
              } else {
                  alert('Error: ' + data.message);
              }
          })
          .catch(error => {
              hideLoading();
              alert('An error occurred');
          });
    }
}

function runMigrations() {
    if(confirm('Are you sure you want to run migrations?')) {
        showLoading();
        fetch('{{ route('admin.maintenance.migrate') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              hideLoading();
              alert(data.message);
          })
          .catch(error => {
              hideLoading();
              alert('An error occurred');
          });
    }
}

function seedDatabase() {
    if(confirm('Are you sure you want to seed the database?')) {
        showLoading();
        fetch('{{ route('admin.maintenance.seed') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              hideLoading();
              alert(data.message);
          })
          .catch(error => {
              hideLoading();
              alert('An error occurred');
          });
    }
}

function optimizeDatabase() {
    if(confirm('Are you sure you want to optimize the database?')) {
        showLoading();
        fetch('{{ route('admin.maintenance.optimize') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              hideLoading();
              alert(data.message);
          })
          .catch(error => {
              hideLoading();
              alert('An error occurred');
          });
    }
}

function createBackup() {
    if(confirm('Are you sure you want to create a backup?')) {
        showLoading();
        fetch('{{ route('admin.maintenance.backup.create') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              hideLoading();
              if(data.success) {
                  location.reload();
              } else {
                  alert('Error: ' + data.message);
              }
          })
          .catch(error => {
              hideLoading();
              alert('An error occurred');
          });
    }
}

function restoreBackup(input) {
    const file = input.files[0];
    if(file) {
        if(confirm('Are you sure you want to restore from this backup? Current data will be overwritten.')) {
            showLoading();
            const formData = new FormData();
            formData.append('backup', file);
            
            fetch('{{ route('admin.maintenance.backup.restore') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            }).then(response => response.json())
              .then(data => {
                  hideLoading();
                  alert(data.message);
              })
              .catch(error => {
                  hideLoading();
                  alert('An error occurred');
              });
        }
    }
}

function downloadBackup(path) {
    window.location.href = `/admin/maintenance/backup/download/${path}`;
}

function deleteBackup(name) {
    if(confirm('Are you sure you want to delete this backup?')) {
        fetch(`/admin/maintenance/backup/delete/${name}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              if(data.success) {
                  location.reload();
              } else {
                  alert('Error: ' + data.message);
              }
          });
    }
}

function clearLogs() {
    if(confirm('Are you sure you want to clear all log files? This action cannot be undone.')) {
        fetch('{{ route('admin.maintenance.logs.clear') }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              if(data.success) {
                  alert('Logs cleared successfully!');
              } else {
                  alert('Error: ' + data.message);
              }
          });
    }
}
@endpush
