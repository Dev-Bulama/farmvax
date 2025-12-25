<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show professional dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $professional = $user->animalHealthProfessional;

        // Check if approved
        if (!$professional || $professional->approval_status !== 'approved') {
            return redirect()->route('professional.pending-approval');
        }

        // Get stats
        $farmRecordsCount = $user->farmRecords()->count();
        $serviceRequestsCount = 0; // Will be implemented later

        return view('professional.dashboard', compact('user', 'professional', 'farmRecordsCount', 'serviceRequestsCount'));
    }

    /**
     * Show professional profile.
     */
    public function profile()
    {
        $user = auth()->user();
        $professional = $user->animalHealthProfessional;

        return view('professional.profile', compact('user', 'professional'));
    }

    /**
     * Show farm records managed by this professional.
     */
    public function farmRecords()
    {
        $user = auth()->user();
        $professional = $user->animalHealthProfessional;

        // Check if approved
        if (!$professional || $professional->approval_status !== 'approved') {
            return redirect()->route('professional.pending-approval')
                ->with('error', 'Your account must be approved to access farm records.');
        }

        $farmRecords = $user->farmRecords()
            ->with('farmer')
            ->latest()
            ->paginate(10);

        return view('professional.farm-records', compact('user', 'farmRecords'));
    }

    /**
     * Show service requests.
     */
    public function serviceRequests()
    {
        $user = auth()->user();
        $professional = $user->animalHealthProfessional;

        // Check if approved
        if (!$professional || $professional->approval_status !== 'approved') {
            return redirect()->route('professional.pending-approval')
                ->with('error', 'Your account must be approved to access service requests.');
        }

        // Service requests will be implemented later
        $serviceRequests = collect();

        return view('professional.service-requests', compact('user', 'serviceRequests'));
    }
}