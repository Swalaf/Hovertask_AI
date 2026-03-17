@extends('layouts.main')

@section('title', 'Post Advert - Hovertask')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Create New Campaign</h1>
        
        <form id="advertForm" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <!-- Campaign Type -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Campaign Type</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <label class="flex items-center p-4 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-[#2C418F] transition-colors has-[:checked]:border-[#2C418F] has-[:checked]:bg-[#2C418F]/5">
                        <input type="radio" name="type" value="advert" class="w-4 h-4 text-[#2C418F]" checked onchange="updateFormFields()">
                        <div class="ml-3">
                            <span class="block text-sm font-medium text-zinc-800">Advert Campaign</span>
                            <span class="block text-xs text-zinc-500">Post ads on social media</span>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-[#2C418F] transition-colors has-[:checked]:border-[#2C418F] has-[:checked]:bg-[#2C418F]/5">
                        <input type="radio" name="type" value="engagement" class="w-4 h-4 text-[#2C418F]" onchange="updateFormFields()">
                        <div class="ml-3">
                            <span class="block text-sm font-medium text-zinc-800">Engagement Task</span>
                            <span class="block text-xs text-zinc-500">Likes, comments, shares</span>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border-2 border-purple-200 rounded-lg cursor-pointer hover:border-purple-600 transition-colors has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                        <input type="radio" name="type" value="freelance_task" class="w-4 h-4 text-purple-600" onchange="updateFormFields()">
                        <div class="ml-3">
                            <span class="block text-sm font-medium text-zinc-800">Freelance Task</span>
                            <span class="block text-xs text-zinc-500">Post freelance work</span>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border-2 border-blue-200 rounded-lg cursor-pointer hover:border-blue-600 transition-colors has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                        <input type="radio" name="type" value="job_task" class="w-4 h-4 text-blue-600" onchange="updateFormFields()">
                        <div class="ml-3">
                            <span class="block text-sm font-medium text-zinc-800">Job Task</span>
                            <span class="block text-xs text-zinc-500">Post job opportunities</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- ==================== ADVERT CAMPAIGN FIELDS ==================== -->
            <div id="advertFields" class="campaign-fields">
                <div class="border-t border-b border-zinc-200 py-4 my-4">
                    <h3 class="text-lg font-semibold text-zinc-800 mb-4">📢 Advert Details</h3>
                    
                    <!-- Platform Selection -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Select Platform</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            @php
                            $platforms = [
                                ['name' => 'whatsapp', 'label' => 'WhatsApp', 'icon' => '💬', 'price' => 100],
                                ['name' => 'facebook', 'label' => 'Facebook', 'icon' => '📘', 'price' => 150],
                                ['name' => 'instagram', 'label' => 'Instagram', 'icon' => '📸', 'price' => 150],
                                ['name' => 'x', 'label' => 'X (Twitter)', 'icon' => '🐦', 'price' => 150],
                                ['name' => 'tiktok', 'label' => 'TikTok', 'icon' => '🎵', 'price' => 150],
                            ];
                            @endphp
                            @foreach($platforms as $platform)
                            <label class="flex flex-col items-center p-3 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-[#2C418F] transition-colors has-[:checked]:border-[#2C418F] has-[:checked]:bg-[#2C418F]/5">
                                <input type="radio" name="platforms" value="{{ $platform['name'] }}" class="sr-only" data-price="{{ $platform['price'] }}">
                                <span class="text-2xl mb-1">{{ $platform['icon'] }}</span>
                                <span class="text-xs font-medium text-zinc-700">{{ $platform['label'] }}</span>
                                <span class="text-xs text-green-600">₦{{ $platform['price'] }}/post</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Upload Advert Image/Video</label>
                        <div class="border-2 border-dashed border-zinc-300 rounded-lg p-6 text-center hover:border-[#2C418F] transition-colors">
                            <input type="file" name="file_path" id="fileInput" class="hidden" accept="image/*,video/*">
                            <label for="fileInput" class="cursor-pointer">
                                <div class="text-4xl mb-2">📁</div>
                                <p class="text-sm text-zinc-600">Click to upload image or video</p>
                                <p class="text-xs text-zinc-400">PNG, JPG, MP4 (Max 10MB)</p>
                            </label>
                        </div>
                        <div id="filePreview" class="mt-2 hidden">
                            <p class="text-sm green-600">File selected: <span id="fileName"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== ENGAGEMENT TASK FIELDS ==================== -->
            <div id="engagementFields" class="campaign-fields hidden">
                <div class="border-t border-b border-zinc-200 py-4 my-4">
                    <h3 class="text-lg font-semibold text-zinc-800 mb-4">👍 Engagement Task Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Number of Participants</label>
                            <input type="number" name="number_of_participants" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., 100" min="1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Payment Per Task (₦)</label>
                            <input type="number" name="payment_per_task" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., 100" min="1">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Task Deadline</label>
                        <input type="date" name="deadline" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                    </div>
                </div>
            </div>

            <!-- ==================== FREELANCE TASK FIELDS ==================== -->
            <div id="freelanceFields" class="campaign-fields hidden">
                <div class="border-t border-b border-purple-200 py-4 my-4">
                    <h3 class="text-lg font-semibold text-purple-800 mb-4">💼 Freelance Project Details</h3>
                    
                    <!-- Skills Required -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Skills Required</label>
                        <input type="text" name="skills_required" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="e.g., Graphic Design, Logo Design, Adobe Photoshop">
                    </div>

                    <!-- Pricing Type -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Pricing Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center p-4 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-purple-600 transition-colors has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                <input type="radio" name="pricing_type" value="fixed" class="w-4 h-4 text-purple-600" checked>
                                <div class="ml-3">
                                    <span class="block text-sm font-medium text-zinc-800">Fixed Price</span>
                                    <span class="block text-xs text-zinc-500">Pay a fixed amount</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-purple-600 transition-colors has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                <input type="radio" name="pricing_type" value="hourly" class="w-4 h-4 text-purple-600">
                                <div class="ml-3">
                                    <span class="block text-sm font-medium text-zinc-800">Hourly Rate</span>
                                    <span class="block text-xs text-zinc-500">Pay per hour</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Budget -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Fixed Price (₦)</label>
                            <input type="number" name="fixed_price" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="e.g., 50000" min="1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Hourly Rate (₦)</label>
                            <input type="number" name="hourly_rate" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="e.g., 5000" min="1">
                        </div>
                    </div>

                    <!-- Experience Level -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Experience Level</label>
                        <select name="experience_level" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                            <option value="entry">Entry Level</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="expert">Expert</option>
                        </select>
                    </div>

                    <!-- Project Duration -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Project Duration</label>
                        <select name="project_duration" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                            <option value="less_than_1_month">Less than 1 month</option>
                            <option value="1_3_months">1-3 months</option>
                            <option value="3_6_months">3-6 months</option>
                            <option value="more_than_6_months">More than 6 months</option>
                        </select>
                    </div>

                    <!-- Deadline -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Application Deadline</label>
                        <input type="date" name="deadline" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                    </div>
                </div>
            </div>

            <!-- ==================== JOB TASK FIELDS ==================== -->
            <div id="jobFields" class="campaign-fields hidden">
                <div class="border-t border-b border-blue-200 py-4 my-4">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">💼 Job Opportunity Details</h3>
                    
                    <!-- Company Name -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Company Name</label>
                        <input type="text" name="company_name" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="Your company name">
                    </div>

                    <!-- Job Type -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Job Type</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @php
                            $jobTypes = [
                                ['value' => 'full-time', 'label' => 'Full-time'],
                                ['value' => 'part-time', 'label' => 'Part-time'],
                                ['value' => 'contract', 'label' => 'Contract'],
                                ['value' => 'internship', 'label' => 'Internship'],
                            ];
                            @endphp
                            @foreach($jobTypes as $type)
                            <label class="flex items-center p-3 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-blue-600 transition-colors has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                                <input type="radio" name="job_type" value="{{ $type['value'] }}" class="w-4 h-4 text-blue-600" @if($type['value'] === 'full-time') checked @endif>
                                <span class="ml-2 text-sm font-medium text-zinc-700">{{ $type['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Salary Range -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Minimum Salary (₦)</label>
                            <input type="number" name="salary_range_min" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., 100000" min="0">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Maximum Salary (₦)</label>
                            <input type="number" name="salary_range_max" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., 200000" min="0">
                        </div>
                    </div>

                    <!-- Job Location -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Job Location</label>
                        <input type="text" name="job_location" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., Lagos, Nigeria or Remote">
                    </div>

                    <!-- Qualifications -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Required Qualifications</label>
                        <textarea name="qualifications_required" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" rows="3" placeholder="List required qualifications..."></textarea>
                    </div>

                    <!-- Benefits -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Job Benefits (Optional)</label>
                        <textarea name="job_benefits" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" rows="2" placeholder="e.g., Health insurance, Remote work..."></textarea>
                    </div>

                    <!-- Application Deadline -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Application Deadline</label>
                        <input type="date" name="application_deadline" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600">
                    </div>
                </div>
            </div>

            <!-- ==================== COMMON FIELDS (All Campaign Types) ==================== -->
            
            <!-- Campaign Title -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Campaign Title</label>
                <input type="text" name="title" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., Promote my new product on WhatsApp" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Description</label>
                <textarea name="description" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" rows="4" placeholder="Describe your campaign requirements..." required></textarea>
            </div>

            <!-- Number of Posts/Participants (for Advert & Engagement) -->
            <div id="postsField" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Number of Posts/Participants</label>
                    <input type="number" name="no_of_status_post" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., 100" min="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Payment Per Task (₦)</label>
                    <input type="number" name="payment_per_task" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., 100" min="1">
                </div>
            </div>

            <!-- Budget -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Estimated Total Budget (₦)</label>
                <input type="number" name="estimated_cost" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="Total budget for this campaign" min="1" required>
                <p class="text-xs text-zinc-500 mt-1">Calculated: Number of posts × Payment per task</p>
            </div>

            <!-- Target Audience -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Gender (Optional)</label>
                    <select name="gender" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                        <option value="">Any</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Location (Optional)</label>
                    <input type="text" name="location" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]" placeholder="e.g., Lagos, Nigeria">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Category</label>
                    <select name="category" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                        <option value="">Select category</option>
                        <option value="technology">Technology</option>
                        <option value="marketing">Marketing</option>
                        <option value="design">Design</option>
                        <option value="development">Development</option>
                        <option value="writing">Writing</option>
                        <option value="video">Video & Animation</option>
                        <option value="music">Music & Audio</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <!-- Payment Method -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Payment Method</label>
                <select name="payment_method" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-[#2C418F]">
                    <option value="wallet">Wallet Balance</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="ussd">USSD</option>
                </select>
            </div>

            <!-- Campaign Summary -->
            <div class="bg-[#2C418F]/5 rounded-xl p-4 border border-[#2C418F]/20">
                <h3 class="font-semibold text-zinc-800 mb-3">Campaign Summary</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Campaign Type:</span>
                        <span id="summaryType" class="font-medium">Advert Campaign</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Platform:</span>
                        <span id="summaryPlatform" class="font-medium">Not selected</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Number of Posts:</span>
                        <span id="summaryPosts" class="font-medium">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Payment Per Task:</span>
                        <span id="summaryPayment" class="font-medium">₦0</span>
                    </div>
                    <div class="flex justify-between border-t border-zinc-200 pt-2 mt-2">
                        <span class="text-zinc-800 font-medium">Total Budget:</span>
                        <span id="summaryTotal" class="font-bold text-[#2C418F]">₦0</span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="w-full bg-[#2C418F] text-white py-4 rounded-lg hover:bg-[#1a2d6b] font-medium transition-colors flex items-center justify-center gap-2">
                <span>Create Campaign</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </form>

        <!-- Success Message -->
        <div id="successMessage" class="hidden text-center py-8">
            <div class="text-6xl mb-4">✅</div>
            <h2 class="text-2xl font-bold text-zinc-800 mb-2">Campaign Created!</h2>
            <p class="text-zinc-600 mb-4">Your campaign has been created successfully.</p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('dashboard.earn.adverts') }}" class="bg-[#2C418F] text-white px-6 py-2 rounded-lg hover:bg-[#1a2d6b]">
                    View Campaigns
                </a>
                <a href="{{ route('dashboard.advertise.post') }}" class="border border-[#2C418F] text-[#2C418F] px-6 py-2 rounded-lg hover:bg-[#2C418F]/5">
                    Create Another
                </a>
            </div>
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-50 border border-red-200 rounded-lg p-4 mt-4">
            <p class="text-red-600 text-sm" id="errorText"></p>
        </div>
    </div>
</div>

<script>
// Global function to update summary
function updateSummary() {
    // Get selected platform (radio buttons)
    const selectedPlatform = document.querySelector('input[name="platforms"]:checked');
    const platform = selectedPlatform ? selectedPlatform.value : 'Not selected';
    
    // Get visible inputs - find inputs that are not inside hidden elements
    const allPostsInputs = document.querySelectorAll('input[name="no_of_status_post"]');
    const allPaymentInputs = document.querySelectorAll('input[name="payment_per_task"]');
    
    // Get the first visible input (not disabled and not inside hidden parent)
    let noOfPosts = null;
    let paymentPerTask = null;
    
    for (const input of allPostsInputs) {
        if (!input.disabled && input.offsetParent !== null) {
            noOfPosts = input;
            break;
        }
    }
    
    for (const input of allPaymentInputs) {
        if (!input.disabled && input.offsetParent !== null) {
            paymentPerTask = input;
            break;
        }
    }
    
    const posts = noOfPosts ? (parseInt(noOfPosts.value) || 0) : 0;
    const payment = paymentPerTask ? (parseInt(paymentPerTask.value) || 0) : 0;
    const total = posts * payment;

    const summaryPlatform = document.getElementById('summaryPlatform');
    const summaryPosts = document.getElementById('summaryPosts');
    const summaryPayment = document.getElementById('summaryPayment');
    const summaryTotal = document.getElementById('summaryTotal');
    
    if (summaryPlatform) summaryPlatform.textContent = platform.charAt(0).toUpperCase() + platform.slice(1);
    if (summaryPosts) summaryPosts.textContent = posts;
    if (summaryPayment) summaryPayment.textContent = '₦' + payment.toLocaleString();
    if (summaryTotal) summaryTotal.textContent = '₦' + total.toLocaleString();
    
    // Auto-calculate estimated cost - find visible estimated_cost input and update it
    const allEstimatedInputs = document.querySelectorAll('input[name="estimated_cost"]');
    for (const estimatedCost of allEstimatedInputs) {
        if (!estimatedCost.disabled && estimatedCost.offsetParent !== null) {
            estimatedCost.value = total;
            break;
        }
    }
}

function updateFormFields() {
    const type = document.querySelector('input[name="type"]:checked').value;
    
    // Hide all campaign-specific fields
    document.querySelectorAll('.campaign-fields').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Show/hide common fields based on type
    const postsField = document.getElementById('postsField');
    const summaryType = document.getElementById('summaryType');
    
    // Update summary type
    const typeLabels = {
        'advert': 'Advert Campaign',
        'engagement': 'Engagement Task',
        'freelance_task': 'Freelance Task',
        'job_task': 'Job Task'
    };
    summaryType.textContent = typeLabels[type] || type;
    
    // Show appropriate fields
    if (type === 'advert') {
        document.getElementById('advertFields').classList.remove('hidden');
        postsField.classList.remove('hidden');
    } else if (type === 'engagement') {
        document.getElementById('engagementFields').classList.remove('hidden');
        postsField.classList.remove('hidden');
    } else if (type === 'freelance_task') {
        document.getElementById('freelanceFields').classList.remove('hidden');
        postsField.classList.add('hidden');
    } else if (type === 'job_task') {
        document.getElementById('jobFields').classList.remove('hidden');
        postsField.classList.add('hidden');
    }
    
    updateSummary();
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('advertForm');
    const typeRadios = document.querySelectorAll('input[name="type"]');
    const platformRadios = document.querySelectorAll('input[name="platforms"]');
    const noOfPosts = document.querySelector('input[name="no_of_status_post"]');
    const paymentPerTask = document.querySelector('input[name="payment_per_task"]');
    const fileInput = document.getElementById('fileInput');
    
    // Initialize summary on page load
    updateSummary();
    
    platformRadios.forEach(radio => {
        radio.addEventListener('change', updateSummary);
    });

    if (noOfPosts) noOfPosts.addEventListener('input', updateSummary);
    if (paymentPerTask) paymentPerTask.addEventListener('input', updateSummary);

    // File preview
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                document.getElementById('filePreview').classList.remove('hidden');
                document.getElementById('fileName').textContent = file.name;
            }
        });
    }

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Creating...</span>';
        
        const formData = new FormData(form);
        
        try {
            const response = await fetch('{{ route('dashboard.advertise.create') }}', {
                method: 'POST',
                credentials: 'include', // Include cookies for session auth
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok) {
                form.classList.add('hidden');
                document.getElementById('successMessage').classList.remove('hidden');
            } else {
                // Check if it's a wallet balance issue
                if (data.insufficient_balance) {
                    // Store form data in localStorage for restoration after funding
                    localStorage.setItem('pending_advert_data', JSON.stringify(Object.fromEntries(formData)));
                    localStorage.setItem('pending_advert_type', formData.get('type'));
                    
                    if (confirm(data.message + ' Would you like to fund your wallet now?')) {
                        window.location.href = data.redirect_url + '?amount=' + data.additional_required + '&return_to=' + encodeURIComponent(window.location.pathname);
                    }
                } else {
                    document.getElementById('errorMessage').classList.remove('hidden');
                    if (data.errors) {
                        const errors = Object.values(data.errors).flat().join(', ');
                        document.getElementById('errorText').textContent = errors;
                    } else if (data.error) {
                        document.getElementById('errorText').textContent = data.error;
                    } else {
                        document.getElementById('errorText').textContent = 'An error occurred. Please try again.';
                    }
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Create Campaign</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
                }
            }
        } catch (error) {
            document.getElementById('errorMessage').classList.remove('hidden');
            document.getElementById('errorText').textContent = 'Network error. Please try again.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Create Campaign</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
        }
    });
    
    // Initialize form with default selection
    updateFormFields();
    
    // Restore form data if returning from wallet funding
    const pendingData = localStorage.getItem('pending_advert_data');
    if (pendingData) {
        const data = JSON.parse(pendingData);
        Object.keys(data).forEach(key => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = data[key];
            }
        });
        // Update form fields based on restored type
        updateFormFields();
        
        // Clear stored data
        localStorage.removeItem('pending_advert_data');
        localStorage.removeItem('pending_advert_type');
        
        // Show info message
        alert('Your form data has been restored. Please review and submit again.');
    }
});
</script>
@endsection
