@extends('layouts.dashboard')

@section('main')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <h1 class="text-2xl font-bold text-zinc-800 mb-6">Post Freelance Project</h1>
        
        <form id="freelanceForm" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <!-- Project Title -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Project Title</label>
                <input type="text" name="title" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="e.g., Need a Logo Designer for My Brand" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Project Description</label>
                <textarea name="description" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" rows="6" placeholder="Describe your project requirements in detail..." required></textarea>
            </div>

            <!-- Skills Required -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Skills Required</label>
                <input type="text" name="skills_required" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="e.g., Graphic Design, Logo Design, Adobe Photoshop">
            </div>

            <!-- Pricing Type -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Pricing Type</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="flex items-center p-4 border-2 border-zinc-200 rounded-lg cursor-pointer hover:border-purple-600 transition-colors has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                        <input type="radio" name="pricing_type" value="fixed" class="w-4 h-4 text-purple-600" checked>
                        <div class="ml-3">
                            <span class="block text-sm font-medium text-zinc-800">Fixed Price</span>
                            <span class="block text-xs text-zinc-500">Pay a fixed amount for the project</span>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Experience Level</label>
                <select name="experience_level" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                    <option value="entry">Entry Level</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="expert">Expert</option>
                </select>
            </div>

            <!-- Project Duration -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Project Duration</label>
                <select name="project_duration" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                    <option value="less_than_1_month">Less than 1 month</option>
                    <option value="1_3_months">1-3 months</option>
                    <option value="3_6_months">3-6 months</option>
                    <option value="more_than_6_months">More than 6 months</option>
                </select>
            </div>

            <!-- Deadline -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Application Deadline</label>
                <input type="date" name="deadline" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" required>
            </div>

            <!-- Target Location -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Location (Optional)</label>
                <input type="text" name="location" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="e.g., Lagos, Nigeria (Remote if empty)">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Category</label>
                <select name="category" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                    <option value="design">Design</option>
                    <option value="development">Development</option>
                    <option value="writing">Writing</option>
                    <option value="marketing">Marketing</option>
                    <option value="video">Video & Animation</option>
                    <option value="music">Music & Audio</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Total Budget -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Total Budget (₦)</label>
                <input type="number" name="estimated_cost" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600" placeholder="Total budget for this project" min="1" required>
            </div>

            <!-- Payment Method -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-2">Payment Method</label>
                <select name="payment_method" class="w-full p-3 rounded-lg border border-zinc-200 focus:outline-none focus:border-purple-600">
                    <option value="wallet">Wallet Balance</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="w-full bg-purple-600 text-white py-4 rounded-lg hover:bg-purple-700 font-medium transition-colors flex items-center justify-center gap-2">
                <span>Post Project</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </form>

        <!-- Success Message -->
        <div id="successMessage" class="hidden text-center py-8">
            <div class="text-6xl mb-4">✅</div>
            <h2 class="text-2xl font-bold text-zinc-800 mb-2">Project Posted!</h2>
            <p class="text-zinc-600 mb-4">Your freelance project has been posted successfully.</p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('dashboard.freelance.my-tasks') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
                    View My Projects
                </a>
                <a href="{{ route('dashboard.freelance.create') }}" class="border border-purple-600 text-purple-600 px-6 py-2 rounded-lg hover:bg-purple-50">
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
    const form = document.getElementById('freelanceForm');
    const pricingTypeRadios = document.querySelectorAll('input[name="pricing_type"]');
    const fixedPriceInput = document.querySelector('input[name="fixed_price"]');
    const hourlyRateInput = document.querySelector('input[name="hourly_rate"]');
    
    // Toggle price inputs based on pricing type
    pricingTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'fixed') {
                fixedPriceInput.parentElement.parentElement.classList.remove('hidden');
                hourlyRateInput.parentElement.parentElement.classList.add('hidden');
                fixedPriceInput.setAttribute('required', 'required');
                hourlyRateInput.removeAttribute('required');
            } else {
                fixedPriceInput.parentElement.parentElement.classList.add('hidden');
                hourlyRateInput.parentElement.parentElement.classList.remove('hidden');
                hourlyRateInput.setAttribute('required', 'required');
                fixedPriceInput.removeAttribute('required');
            }
        });
    });

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Posting...</span>';
        
        const formData = new FormData(form);
        formData.append('type', 'freelance_task');
        
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
                submitBtn.innerHTML = '<span>Post Project</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
            }
        } catch (error) {
            document.getElementById('errorMessage').classList.remove('hidden');
            document.getElementById('errorText').textContent = 'Network error. Please try again.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Post Project</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
        }
    });
});
</script>
@endsection
