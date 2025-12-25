<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AnimalHealthProfessional;
use App\Models\Volunteer;
use App\Models\Livestock;
use App\Models\ServiceRequest;
use App\Models\FarmRecord;
use App\Models\VaccinationHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'farmers' => User::where('role', 'farmer')->count(),
            'professionals' => User::where('role', 'animal_health_professional')->count(),
            'pending_approvals' => AnimalHealthProfessional::where('approval_status', 'pending')->count(),
            'total_livestock' => Livestock::count(),
            'total_farm_records' => FarmRecord::count(),
            'volunteers' => User::where('role', 'volunteer')->count(),
            'pending_requests' => ServiceRequest::where('status', 'pending')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $pendingProfessionals = AnimalHealthProfessional::where('approval_status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'pendingProfessionals'));
    }

    /**
     * Pending Professionals
     */
    public function pendingProfessionals()
    {
        $professionals = AnimalHealthProfessional::where('approval_status', 'pending')
            ->with('user')
            ->orderBy('submitted_at', 'desc')
            ->paginate(20);

        return view('admin.professionals.pending', compact('professionals'));
    }

    /**
     * Review Professional Application
     */
    public function reviewProfessional($id)
    {
        $professional = AnimalHealthProfessional::with('user')->findOrFail($id);
        
        return view('admin.professionals.review', compact('professional'));
    }

    /**
     * Approve Professional
     */
    public function approveProfessional($id)
    {
        $professional = AnimalHealthProfessional::findOrFail($id);
        
        $professional->update([
            'approval_status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.professionals.pending')
            ->with('success', 'Professional approved successfully!');
    }

    /**
     * Reject Professional
     */
    public function rejectProfessional(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $professional = AnimalHealthProfessional::findOrFail($id);
        
        $professional->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.professionals.pending')
            ->with('success', 'Professional application rejected.');
    }

    /**
     * All Professionals (Approved)
     */
    public function professionals()
    {
        $professionals = AnimalHealthProfessional::where('approval_status', 'approved')
            ->with('user')
            ->orderBy('approved_at', 'desc')
            ->paginate(20);

        return view('admin.professionals.index', compact('professionals'));
    }

    /**
     * All Farmers
     */
    public function farmers()
    {
        $farmers = User::where('role', 'farmer')
            ->withCount('livestock')
            ->withCount('serviceRequests')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.farmers.index', compact('farmers'));
    }

    /**
     * All Volunteers
     */
    public function volunteers()
    {
        $volunteers = User::where('role', 'volunteer')
            ->with('volunteer')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.volunteers.index', compact('volunteers'));
    }

    /**
     * All Users
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * All Service Requests
     */
    public function serviceRequests()
    {
        $requests = ServiceRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.service-requests.index', compact('requests'));
    }

    /**
     * All Farm Records
     */
    public function farmRecords()
    {
        $records = FarmRecord::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.farm-records.index', compact('records'));
    }

    /**
     * Show Farm Record
     */
    public function showFarmRecord($id)
    {
        $record = FarmRecord::with('user')->findOrFail($id);

        return view('admin.farm-records.show', compact('record'));
    }

    /**
     * Statistics & Analytics
     */
    public function statistics()
    {
        $stats = [
            'total_users' => User::count(),
            'farmers' => User::where('role', 'farmer')->count(),
            'professionals' => User::where('role', 'animal_health_professional')->count(),
            'volunteers' => User::where('role', 'volunteer')->count(),
            'total_livestock' => Livestock::count(),
            'cattle' => Livestock::where('type', 'cattle')->count(),
            'goats' => Livestock::where('type', 'goat')->count(),
            'sheep' => Livestock::where('type', 'sheep')->count(),
            'poultry' => Livestock::where('type', 'poultry')->count(),
            'total_vaccinations' => VaccinationHistory::count(),
            'pending_requests' => ServiceRequest::where('status', 'pending')->count(),
            'completed_requests' => ServiceRequest::where('status', 'completed')->count(),
        ];

        // Monthly growth
        $monthlyUsers = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        return view('admin.statistics', compact('stats', 'monthlyUsers'));
    }
}