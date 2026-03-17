@extends('admin.layout')

@section('title', 'Settings')
@section('page_title', 'Settings')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-card p-4">
            <nav class="space-y-1">
                <a href="#general" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors active">
                    <i class="fas fa-cog w-5"></i>
                    <span>General</span>
                </a>
                <a href="#notifications" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-bell w-5"></i>
                    <span>Notifications</span>
                </a>
                <a href="#api" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-key w-5"></i>
                    <span>API Settings</span>
                </a>
                <a href="#payment" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-credit-card w-5"></i>
                    <span>Payment</span>
                </a>
                <a href="#email" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Email</span>
                </a>
                <a href="#security" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-shield-alt w-5"></i>
                    <span>Security</span>
                </a>
            </nav>
        </div>
    </div>
    
    <!-- Content -->
    <div class="lg:col-span-3 space-y-6">
        <!-- General Settings -->
        <div id="general" class="bg-white rounded-xl shadow-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">General Settings</h3>
            <form method="POST" action="{{ route('admin.settings.update', 'general') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                        <input type="text" name="site_name" value="{{ config('app.name', 'Hovertask') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Site URL</label>
                        <input type="url" name="site_url" value="{{ config('app.url', 'https://hovertask.com') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                        <textarea name="site_description" rows="3" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">Hovertask - Earn money online through tasks, advertising, reselling, and referrals.</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Maintenance Mode</label>
                            <p class="text-sm text-gray-500">Enable to put the site in maintenance mode</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="maintenance_mode" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Notification Settings -->
        <div id="notifications" class="bg-white rounded-xl shadow-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Notification Settings</h3>
            <form method="POST" action="{{ route('admin.settings.update', 'notifications') }}">
                @csrf
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-800">Email Notifications</p>
                            <p class="text-sm text-gray-500">Receive email notifications for important events</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="email_notifications" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-800">New User Registration</p>
                            <p class="text-sm text-gray-500">Get notified when new users register</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="notify_new_user" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-800">Withdrawal Requests</p>
                            <p class="text-sm text-gray-500">Get notified for withdrawal requests</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="notify_withdrawal" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-800">New Orders</p>
                            <p class="text-sm text-gray-500">Get notified for new orders</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="notify_new_order" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="font-medium text-gray-800">Task Completion</p>
                            <p class="text-sm text-gray-500">Get notified when tasks are completed</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="notify_task_completion" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- API Settings -->
        <div id="api" class="bg-white rounded-xl shadow-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">API Settings</h3>
            <form method="POST" action="{{ route('admin.settings.update', 'api') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Paystack Public Key</label>
                        <input type="text" name="paystack_public_key" value="{{ config('services.paystack.public_key', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            placeholder="pk_test_xxxxxxxxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Paystack Secret Key</label>
                        <input type="password" name="paystack_secret_key" value="{{ config('services.paystack.secret_key', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            placeholder="sk_test_xxxxxxxxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cloudinary Cloud Name</label>
                        <input type="text" name="cloudinary_cloud_name" value="{{ config('cloudinary.cloud_name', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cloudinary API Key</label>
                        <input type="text" name="cloudinary_api_key" value="{{ config('cloudinary.api_key', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cloudinary API Secret</label>
                        <input type="password" name="cloudinary_api_secret" value="{{ config('cloudinary.api_secret', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Payment Settings -->
        <div id="payment" class="bg-white rounded-xl shadow-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Payment Settings</h3>
            <form method="POST" action="{{ route('admin.settings.update', 'payment') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Withdrawal Amount (₦)</label>
                        <input type="number" name="min_withdrawal" value="{{ config('settings.min_withdrawal', 1000) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Withdrawal Amount (₦)</label>
                        <input type="number" name="max_withdrawal" value="{{ config('settings.max_withdrawal', 100000) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Withdrawal Fee (₦)</label>
                        <input type="number" name="withdrawal_fee" value="{{ config('settings.withdrawal_fee', 50) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Referral Bonus (₦)</label>
                        <input type="number" name="referral_bonus" value="{{ config('settings.referral_bonus', 500) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Enable Manual Withdrawal</p>
                            <p class="text-sm text-gray-500">Allow admin to process withdrawals manually</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="manual_withdrawal" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Email Settings -->
        <div id="email" class="bg-white rounded-xl shadow-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Email Settings</h3>
            <form method="POST" action="{{ route('admin.settings.update', 'email') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail Driver</label>
                        <select name="mail_driver" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="smtp" {{ config('mail.default') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                            <option value="sendmail" {{ config('mail.default') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                            <option value="log" {{ config('mail.default') == 'log' ? 'selected' : '' }}>Log (Development)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail Host</label>
                        <input type="text" name="mail_host" value="{{ config('mail.mailers.smtp.host', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            placeholder="smtp.mailtrap.io">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail Port</label>
                        <input type="number" name="mail_port" value="{{ config('mail.mailers.smtp.port', 587) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            placeholder="587">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail Username</label>
                        <input type="text" name="mail_username" value="{{ config('mail.mailers.smtp.username', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail Password</label>
                        <input type="password" name="mail_password" value="{{ config('mail.mailers.smtp.password', '') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail From Address</label>
                        <input type="email" name="mail_from_address" value="{{ config('mail.from.address', 'noreply@hovertask.com') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mail From Name</label>
                        <input type="text" name="mail_from_name" value="{{ config('mail.from.name', 'Hovertask') }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Security Settings -->
        <div id="security" class="bg-white rounded-xl shadow-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Security Settings</h3>
            <form method="POST" action="{{ route('admin.settings.update', 'security') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Session Lifetime (minutes)</label>
                        <input type="number" name="session_lifetime" value="{{ config('session.lifetime', 120) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Two-Factor Authentication</p>
                            <p class="text-sm text-gray-500">Require 2FA for admin accounts</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="require_2fa" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Email Verification Required</p>
                            <p class="text-sm text-gray-500">Require users to verify their email</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="require_email_verification" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-700">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
