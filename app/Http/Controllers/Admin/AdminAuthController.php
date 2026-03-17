<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.',
            ]);
        }

        // Check if user has admin role
        if (! $user->hasRole(['superadministrator', 'administrator', 'manager'])) {
            throw ValidationException::withMessages([
                'email' => 'You do not have admin access. Contact administrator.',
            ]);
        }

        // Attempt to login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Log the login activity
            if (class_exists('App\Models\ActivityLog')) {
                \App\Models\ActivityLog::logAuthActivity($user, 'login');
            }

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome back, '.$user->name.'!');
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        // Log the logout activity
        if (class_exists('App\Models\ActivityLog') && Auth::check()) {
            \App\Models\ActivityLog::logAuthActivity(Auth::user(), 'logout');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
