@extends('layouts.dashboard')

@section('main')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Post a Job</h1>
        
        <form id="jobForm" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <!-- Job Title -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Job Title</label>
                <input type="text" name="title" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., Senior Software Engineer" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Job Description</label>
                <textarea name="description" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" rows="6" placeholder="Describe the job responsibilities and requirements..." required></textarea>
            </div>

            <!-- Company Name -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Company Name</label>
                <input type="text" name="company_name" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="Your company name" required>
            </div>

            <!-- Job Type -->
            <div>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Minimum Salary (₦)</label>
                    <input type="number" name="salary_range_min" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., 100000" min="0">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Maximum Salary (₦)</label>
                    <input type="number" name="salary_range_max" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., 200000" min="0">
                </div>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Job Location</label>
                <input type="text" name="job_location" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="e.g., Lagos, Nigeria or Remote">
            </div>

            <!-- Qualifications -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Required Qualifications</label>
                <textarea name="qualifications_required" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" rows="4" placeholder="List the required qualifications and skills..."></textarea>
            </div>

            <!-- Benefits -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Job Benefits (Optional)</label>
                <textarea name="job_benefits" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" rows="3" placeholder="List benefits (e.g., Health insurance, Remote work, etc.)"></textarea>
            </div>

            <!-- Application Deadline -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Application Deadline</label>
                <input type="date" name="application_deadline" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" required>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Job Category</label>
                <select name="category" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600">
                    <option value="technology">Technology</option>
                    <option value="marketing">Marketing</option>
                    <option value="sales">Sales</option>
                    <option value="design">Design</option>
                    <option value="hr">Human Resources</option>
                    <option value="finance">Finance</option>
                    <option value="education">Education</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Total Budget -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Total Budget (₦)</label>
                <input type="number" name="estimated_cost" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600" placeholder="Total budget for this job posting" min="1" required>
            </div>

            <!-- Payment Method -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Payment Method</label>
                <select name="payment_method" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-blue-600">
                    <option value="wallet">Wallet Balance</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="w-full bg-blue-600 text-white py-4 rounded-lg hover:bg-blue-700 font-medium transition-colors flex items-center justify-center gap-2">
                <span>Post Job</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </form>

        <!-- Success Message -->
        <div id="successMessage" class="hidden text-center py-8">
            <div class="text-6xl mb-4">✅</div>
            <h2 class="text-2xl font-bold text-zinc-800 mb-2">Job Posted!</h2>
            <p class="text-zinc-600 mb-4">Your job has been posted successfully.</p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('dashboard.jobs.my-jobs') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    View My Jobs
                </a>
                <a href="{{ route('dashboard.jobs.create') }}" class="border border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50">
                    Post Another
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('jobForm');
    
    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Posting...</span>';
        
        const formData = new FormData(form);
        formData.append('type', 'job_task');
        
        try {
            const response = await fetch('/api/v1/advertise/create', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + '{{ auth()->user()->api_token ?? "" }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok) {
                form.classList.add('hidden');
                document.getElementById('successMessage').classList.remove('hidden');
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
                submitBtn.innerHTML = '<span>Post Job</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
            }
        } catch (error) {
            document.getElementById('errorMessage').classList.remove('hidden');
            document.getElementById('errorText').textContent = 'Network error. Please try again.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Post Job</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
        }
    });
});
</script>
@endsection
