<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate login credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if account is active
            if ($user->status !== 'active') {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Your account has been suspended. Please contact support.');
            }

            // Check if user can access the system (for data collectors, check approval)
            if (!$user->canAccessSystem()) {
                // For data collectors awaiting approval
                if ($user->role === 'data_collector' && !$user->is_approved) {
                    return redirect()->route('pending-approval')
                        ->with('info', 'Your application is pending admin approval.');
                }

                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'You do not have permission to access the system.');
            }

            // Redirect to appropriate dashboard based on role
            return $this->redirectToDashboard($user);
        }

        // Login failed
        return redirect()->back()
            ->withErrors(['email' => 'These credentials do not match our records.'])
            ->withInput($request->only('email'));
    }

    /**
     * Redirect user to their appropriate dashboard
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToDashboard($user)
    {
        $message = 'Welcome back, ' . $user->name . '!';

        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard')->with('success', $message),
            'data_collector' => redirect()->route('data-collector.dashboard')->with('success', $message),
            'individual' => redirect()->route('individual.dashboard')->with('success', $message),
            default => redirect()->route('home')->with('error', 'Invalid user role.'),
        };
    }

    /**
     * Log the user out
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}