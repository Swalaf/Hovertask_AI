<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    /**
     * Show the onboarding welcome page
     */
    public function index()
    {
        $user = auth()->user();

        // If already completed onboarding, redirect to dashboard
        if ($user->onboarding_status === 'completed') {
            return redirect()->route('dashboard');
        }

        // Start onboarding if not started
        if ($user->onboarding_status === 'pending') {
            $user->update([
                'onboarding_status' => 'in_progress',
                'onboarding_step' => 1,
            ]);
        }

        // Redirect to current step
        $step = $user->onboarding_step ?? 1;

        return redirect()->route('onboarding.step', ['step' => $step]);
    }

    /**
     * Process onboarding step 1: Profile Setup
     */
    public function step1(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user->update($validated);
        $user->update(['onboarding_step' => 2]);

        return redirect()->route('onboarding.step', ['step' => 2]);
    }

    /**
     * Process onboarding step 2: Account Type Selection
     */
    public function step2(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'how_you_want_to_use' => 'required|string|in:worker,advertiser,both',
        ]);

        $user->update($validated);
        $user->update(['onboarding_step' => 3]);

        return redirect()->route('onboarding.step', ['step' => 3]);
    }

    /**
     * Process onboarding step 3: Connect Social Accounts (Optional)
     */
    public function step3(Request $request)
    {
        $user = auth()->user();

        // Skip this step - social connections are optional
        $user->update(['onboarding_step' => 4]);

        return redirect()->route('onboarding.step', ['step' => 4]);
    }

    /**
     * Process onboarding step 4: Fund Wallet (Optional)
     */
    public function step4(Request $request)
    {
        $user = auth()->user();

        // Skip this step - funding is optional
        $user->update(['onboarding_step' => 5]);

        return redirect()->route('onboarding.step', ['step' => 5]);
    }

    /**
     * Process onboarding step 5: Complete & Start Earning
     */
    public function step5(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'onboarding_status' => 'completed',
            'onboarding_step' => 5,
            'onboarding_completed_at' => now(),
            'profile_completed' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome to Hovertask! Your account is now set up.');
    }

    /**
     * Show specific onboarding step
     */
    public function showStep($step)
    {
        $user = auth()->user();

        // If already completed onboarding, redirect to dashboard
        if ($user->onboarding_status === 'completed') {
            return redirect()->route('dashboard');
        }

        // Validate step number
        if ($step < 1 || $step > 5) {
            return redirect()->route('onboarding.index');
        }

        // Ensure user is on this step or earlier
        $currentStep = $user->onboarding_step ?? 1;
        if ($step > $currentStep) {
            return redirect()->route('onboarding.step', ['step' => $currentStep]);
        }

        return view("onboarding.step{$step}", [
            'step' => $step,
            'user' => $user,
        ]);
    }

    /**
     * Skip onboarding
     */
    public function skip()
    {
        $user = auth()->user();

        $user->update([
            'onboarding_status' => 'completed',
            'onboarding_step' => 5,
            'onboarding_completed_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }
}
