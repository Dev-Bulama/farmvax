<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AnimalHealthProfessional;
use App\Models\Volunteer;
use App\Models\Livestock;
use App\Models\FarmRecord;
use App\Models\ServiceRequest;
use App\Models\VaccinationHistory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // Calculate all statistics
        $stats = [
            'total_users' => User::count(),
            'total_farmers' => User::where('role', 'farmer')->count(),
            'total_professionals' => AnimalHealthProfessional::where('approval_status', 'approved')->count(),
            'pending_professionals' => AnimalHealthProfessional::where('approval_status', 'pending')->count(),
            'total_volunteers' => Volunteer::count(),
            'total_livestock' => DB::table('livestock')->count(),
            'total_farm_records' => DB::table('farm_records')->count(),
            'pending_service_requests' => DB::table('service_requests')->where('status', 'pending')->count(),
        ];

        // Get pending professionals with user relationship
        $pendingProfessionals = AnimalHealthProfessional::with('user')
            ->where('approval_status', 'pending')
            ->orderBy('submitted_at', 'desc')
            ->take(5)
            ->get();

        // Get recent users
        $recentUsers = User::whereIn('role', ['farmer', 'animal_health_professional', 'volunteer'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingProfessionals', 'recentUsers'));
    }

    /**
     * Show all farmers
     */
    public function farmers()
    {
        $farmers = User::where('role', 'farmer')
            ->withCount('livestock')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.farmers.index', compact('farmers'));
    }

    /**
     * Show all professionals
     */
    public function professionals()
    {
        $professionals = AnimalHealthProfessional::with('user')
            ->where('approval_status', 'approved')
            ->orderBy('approved_at', 'desc')
            ->paginate(20);

        return view('admin.professionals.index', compact('professionals'));
    }

    /**
     * Show pending professionals
     */
    public function pendingProfessionals()
    {
        $pendingProfessionals = AnimalHealthProfessional::with('user')
            ->where('approval_status', 'pending')
            ->orderBy('submitted_at', 'desc')
            ->paginate(20);

        return view('admin.professionals.pending', compact('pendingProfessionals'));
    }

    /**
     * Review professional application
     */
    public function reviewProfessional($id)
    {
        $professional = AnimalHealthProfessional::with('user')
            ->findOrFail($id);

        return view('admin.professionals.review', compact('professional'));
    }

    /**
     * Approve professional
     */
    public function approveProfessional($id)
    {
        $professional = AnimalHealthProfessional::findOrFail($id);
        
        $professional->update([
            'approval_status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('admin.professionals.pending')
            ->with('success', 'Professional application approved successfully!');
    }

    /**
     * Reject professional
     */
    public function rejectProfessional(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $professional = AnimalHealthProfessional::findOrFail($id);
        
        $professional->update([
            'approval_status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()
            ->route('admin.professionals.pending')
            ->with('success', 'Professional application rejected.');
    }

    /**
     * Show all volunteers
     */
    public function volunteers()
    {
        $volunteers = Volunteer::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.volunteers.index', compact('volunteers'));
    }

    /**
     * Show volunteer details
     */
    public function showVolunteer($id)
    {
        $volunteer = Volunteer::with(['user', 'enrolledFarmers'])
            ->findOrFail($id);

        return view('admin.volunteers.show', compact('volunteer'));
    }

    /**
     * Deactivate volunteer
     */
    public function deactivateVolunteer($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        
        $volunteer->update([
            'status' => 'inactive',
            'is_active' => false,
        ]);

        return redirect()
            ->route('admin.volunteers.index')
            ->with('success', 'Volunteer deactivated successfully.');
    }

    /**
     * Show all service requests
     */
    public function serviceRequests()
    {
        $serviceRequests = DB::table('service_requests')
            ->join('users', 'service_requests.user_id', '=', 'users.id')
            ->select('service_requests.*', 'users.name as farmer_name', 'users.email as farmer_email')
            ->orderBy('service_requests.created_at', 'desc')
            ->paginate(20);

        // Calculate stats
        $stats = [
            'total_requests' => DB::table('service_requests')->count(),
            'pending_requests' => DB::table('service_requests')->where('status', 'pending')->count(),
            'completed_requests' => DB::table('service_requests')->where('status', 'completed')->count(),
        ];

        return view('admin.service-requests.index', compact('serviceRequests', 'stats'));
    }

    /**
     * Show all farm records
     */
    public function farmRecords()
    {
        $farmRecords = DB::table('farm_records')
            ->join('users', 'farm_records.user_id', '=', 'users.id')
            ->select('farm_records.*', 'users.name as creator_name')
            ->orderBy('farm_records.created_at', 'desc')
            ->paginate(20);

        return view('admin.farm-records.index', compact('farmRecords'));
    }

    /**
     * Show pending farm records
     */
    public function pendingFarmRecords()
    {
        $farmRecords = DB::table('farm_records')
            ->join('users', 'farm_records.user_id', '=', 'users.id')
            ->select('farm_records.*', 'users.name as creator_name')
            ->where('farm_records.status', 'submitted')
            ->orderBy('farm_records.created_at', 'desc')
            ->paginate(20);

        return view('admin.farm-records.pending', compact('farmRecords'));
    }

    /**
     * Show farm record details
     */
    public function showFarmRecord($id)
    {
        $record = DB::table('farm_records')
            ->join('users', 'farm_records.user_id', '=', 'users.id')
            ->select('farm_records.*', 'users.name as creator_name', 'users.email as creator_email')
            ->where('farm_records.id', $id)
            ->first();

        if (!$record) {
            abort(404);
        }

        return view('admin.farm-records.show', compact('record'));
    }

    /**
     * Approve farm record
     */
    public function approveFarmRecord($id)
    {
        DB::table('farm_records')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.farm-records.pending')
            ->with('success', 'Farm record approved successfully!');
    }

    /**
     * Reject farm record
     */
    public function rejectFarmRecord(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        DB::table('farm_records')
            ->where('id', $id)
            ->update([
                'status' => 'rejected',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'admin_notes' => $request->rejection_reason,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.farm-records.pending')
            ->with('success', 'Farm record rejected.');
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show statistics page
     */
    public function statistics()
    {
        // User statistics
        $userStats = [
            'total_users' => User::count(),
            'total_farmers' => User::where('role', 'farmer')->count(),
            'total_professionals' => AnimalHealthProfessional::where('approval_status', 'approved')->count(),
            'total_volunteers' => Volunteer::count(),
        ];

        // Livestock statistics
        $livestockStats = [
            'total_livestock' => DB::table('livestock')->count(),
            'total_cattle' => DB::table('livestock')->where('type', 'cattle')->count(),
            'total_goats' => DB::table('livestock')->where('type', 'goat')->count(),
            'total_sheep' => DB::table('livestock')->where('type', 'sheep')->count(),
            'total_poultry' => DB::table('livestock')->where('type', 'poultry')->count(),
        ];

        // Service statistics
        $serviceStats = [
            'total_vaccinations' => DB::table('vaccination_history')->count(),
            'pending_requests' => DB::table('service_requests')->where('status', 'pending')->count(),
            'completed_requests' => DB::table('service_requests')->where('status', 'completed')->count(),
        ];

        // Monthly growth (last 6 months)
        $monthlyGrowth = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyGrowth[] = [
                'month' => $date->format('M Y'),
                'users' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        return view('admin.statistics', compact(
            'userStats',
            'livestockStats',
            'serviceStats',
            'monthlyGrowth'
        ));
    }

    /**
     * Show analytics page
     */
    public function analytics()
    {
        return $this->statistics();
    }
}