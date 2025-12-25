<?php

namespace App\Http\Controllers\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the user's profile
     */
    public function show()
    {
        $user = auth()->user();
        
        return view('individual.profile', compact('user'));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()->route('individual.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('individual.profile')
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Show request to become data collector form
     */
    public function requestCollector()
    {
        $user = auth()->user();
        
        // Check if user already has a data collector profile
        if ($user->dataCollectorProfile) {
            return redirect()->route('individual.profile')
                ->with('info', 'You already have a data collector request pending or approved.');
        }
        
        return view('individual.request-collector', compact('user'));
    }

    /**
     * Submit request to become data collector
     */
    public function submitCollectorRequest(Request $request)
    {
        $user = auth()->user();
        
        // Check if user already has a data collector profile
        if ($user->dataCollectorProfile) {
            return redirect()->route('individual.profile')
                ->with('info', 'You already have a data collector request pending or approved.');
        }

        $validated = $request->validate([
            'organization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'assigned_territory' => 'nullable|string|max:255',
            'reason' => 'required|string|min:50',
        ]);

        // Create data collector profile with pending status
        $user->dataCollectorProfile()->create([
            'organization' => $validated['organization'],
            'experience_years' => $validated['experience_years'] ?? 0,
            'assigned_territory' => $validated['assigned_territory'],
            'approval_status' => 'pending',
            'submitted_at' => now(),
            'application_notes' => $validated['reason'],
        ]);

        return redirect()->route('individual.profile')
            ->with('success', 'Your request to become a data collector has been submitted for review!');
    }
}