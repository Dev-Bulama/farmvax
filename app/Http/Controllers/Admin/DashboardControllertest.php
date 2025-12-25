<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataCollectorProfile;
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
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'individuals' => User::where('role', 'individual')->count(),
            'data_collectors' => User::where('role', 'data_collector')->count(),
            'pending_data_collectors' => DataCollectorProfile::where('approval_status', 'pending')->count(),
            'approved_data_collectors' => DataCollectorProfile::where('approval_status', 'approved')->count(),
            'farm_records' => FarmRecord::count(),
            'pending_farm_records' => FarmRecord::whereIn('status', ['submitted', 'under_review'])->count(),
            'service_requests' => ServiceRequest::count(),
            'vaccinations' => VaccinationHistory::count(),
        ];

        // Get pending approvals
        $pending_approvals = DataCollectorProfile::with('user')
            ->where('approval_status', 'pending')
            ->latest('submitted_at')
            ->take(5)
            ->get();

        // Get pending farm records (NEW!)
        $pending_farm_records = FarmRecord::with(['user', 'farmer'])
            ->whereIn('status', ['submitted', 'under_review'])
            ->latest('submitted_at')
            ->take(5)
            ->get();

        // Get recent registrations
        $recent_registrations = User::whereIn('role', ['individual', 'data_collector'])
            ->latest()
            ->take(5)
            ->get();

        // Get recent farm records
        $recent_farm_records = FarmRecord::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'pending_approvals',
            'pending_farm_records',
            'recent_registrations',
            'recent_farm_records'
        ));
    }

    /**
     * Show farm records list
     */
    public function farmRecords(Request $request)
    {
        $query = FarmRecord::with(['user', 'farmer']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by state
        if ($request->filled('state')) {
            $query->where('farmer_state', $request->state);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('farmer_name', 'like', "%{$search}%")
                  ->orWhere('farmer_phone', 'like', "%{$search}%")
                  ->orWhere('farmer_email', 'like', "%{$search}%");
            });
        }

        $farmRecords = $query->latest('submitted_at')->paginate(20);

        return view('admin.farm-records.index', compact('farmRecords'));
    }

    /**
     * Show farm record details for review
     */
    public function showFarmRecord($id)
    {
        $record = FarmRecord::with([
            'user', 
            'farmer', 
            'approvedBy',
            'livestock',
            'vaccinationHistory',
            'serviceRequests',
            'alertPreferences'
        ])->findOrFail($id);

        return view('admin.farm-records.show', compact('record'));
    }

    /**
     * Approve farm record
     */
    public function approveFarmRecord(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $record = FarmRecord::findOrFail($id);

            // Check if already approved
            if ($record->status === 'approved') {
                return redirect()->back()->with('info', 'This record is already approved.');
            }

            // Update record
            $record->status = 'approved';
            $record->approved_at = now();
            $record->approved_by = auth()->id();
            $record->admin_notes = $request->admin_notes;
            $record->save();

            // Update data collector stats if applicable
            if ($record->created_by_role === 'data_collector' && $record->user && $record->user->dataCollectorProfile) {
                DB::table('data_collector_profiles')
                    ->where('user_id', $record->user_id)
                    ->increment('approved_submissions');
                
                // Update accuracy rate
                $profile = $record->user->dataCollectorProfile;
                if ($profile->total_submissions > 0) {
                    $accuracy = ($profile->approved_submissions / $profile->total_submissions) * 100;
                    $profile->update(['accuracy_rate' => round($accuracy, 2)]);
                }
            }

            DB::commit();

            // TODO: Send notification to data collector/farmer

            return redirect()->route('admin.farm-records.index')
                ->with('success', 'Farm record approved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Approval failed: ' . $e->getMessage());
        }
    }

    /**
     * Reject farm record
     */
    public function rejectFarmRecord(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|min:10|max:1000',
        ], [
            'admin_notes.required' => 'Please provide a reason for rejection.',
            'admin_notes.min' => 'Rejection reason must be at least 10 characters.',
        ]);

        try {
            DB::beginTransaction();

            $record = FarmRecord::findOrFail($id);

            // Check if already rejected
            if ($record->status === 'rejected') {
                return redirect()->back()->with('info', 'This record is already rejected.');
            }

            // Update record
            $record->status = 'rejected';
            $record->approved_by = auth()->id();
            $record->admin_notes = $request->admin_notes;
            $record->save();

            DB::commit();

            // TODO: Send notification to data collector/farmer

            return redirect()->route('admin.farm-records.index')
                ->with('success', 'Farm record rejected. The submitter has been notified.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Rejection failed: ' . $e->getMessage());
        }
    }

    /**
     * Mark farm record as under review
     */
    public function markUnderReview($id)
    {
        try {
            $record = FarmRecord::findOrFail($id);

            if ($record->status === 'under_review') {
                return redirect()->back()->with('info', 'This record is already under review.');
            }

            $record->status = 'under_review';
            $record->save();

            return redirect()->back()->with('success', 'Record marked as under review.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }

    /**
     * Show pending farm records
     */
    public function pendingFarmRecords()
    {
        $records = FarmRecord::with(['user', 'farmer'])
            ->whereIn('status', ['submitted', 'under_review'])
            ->latest('submitted_at')
            ->paginate(20);

        return view('admin.farm-records.pending', compact('records'));
    }

    /**
     * Show service requests list
     */
    public function serviceRequests()
    {
        $serviceRequests = ServiceRequest::with(['user', 'livestock'])
            ->latest()
            ->paginate(20);

        return view('admin.service-requests.index', compact('serviceRequests'));
    }

    /**
     * Show analytics dashboard
     */
    public function analytics()
    {
        // Get comprehensive statistics
        $stats = [
            'total_users' => User::count(),
            'total_farmers' => User::where('role', 'individual')->count(),
            'total_collectors' => User::where('role', 'data_collector')->where('is_approved', true)->count(),
            'total_farm_records' => FarmRecord::count(),
            'total_livestock' => FarmRecord::sum('total_livestock_count'),
            'total_vaccinations' => VaccinationHistory::count(),
            'total_service_requests' => ServiceRequest::count(),
            'pending_service_requests' => ServiceRequest::where('status', 'pending')->count(),
            'completed_service_requests' => ServiceRequest::where('status', 'completed')->count(),
        ];

        // Get monthly registrations (last 6 months)
        $monthlyRegistrations = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get farm records by state
        $recordsByState = FarmRecord::selectRaw('farmer_state as state, COUNT(*) as count')
            ->whereNotNull('farmer_state')
            ->groupBy('farmer_state')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Get livestock distribution
        $livestockDistribution = FarmRecord::selectRaw('SUM(total_livestock_count) as total')
            ->first();

        return view('admin.analytics', compact('stats', 'monthlyRegistrations', 'recordsByState', 'livestockDistribution'));
    }
    /**
 * Show pending farm records
 */
public function pendingFarmRecords()
{
    // Get all pending and under_review farm records with pagination
    $records = \App\Models\FarmRecord::whereIn('status', ['submitted', 'under_review'])
        ->with('user')
        ->latest('submitted_at')
        ->paginate(20);

    return view('admin.farm-records.pending', compact('records'));
}

/**
 * Show specific farm record
 */
public function showFarmRecord($id)
{
    $record = \App\Models\FarmRecord::with('user')->findOrFail($id);
    
    return view('admin.farm-records.show', compact('record'));
}

/**
 * Approve farm record
 */
public function approveFarmRecord($id)
{
    $record = \App\Models\FarmRecord::findOrFail($id);
    
    $record->update([
        'status' => 'approved',
        'approved_at' => now(),
        'approved_by' => auth()->id(),
    ]);

    return redirect()->route('admin.farm-records.pending')
        ->with('success', 'Farm record approved successfully!');
}

/**
 * Reject farm record
 */
public function rejectFarmRecord(Request $request, $id)
{
    $request->validate([
        'rejection_reason' => 'required|string|min:10',
    ]);

    $record = \App\Models\FarmRecord::findOrFail($id);
    
    $record->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
        'approved_at' => now(),
        'approved_by' => auth()->id(),
    ]);

    return redirect()->route('admin.farm-records.pending')
        ->with('success', 'Farm record rejected.');
}

/**
 * Mark farm record as under review
 */
public function markUnderReview($id)
{
    $record = \App\Models\FarmRecord::findOrFail($id);
    
    $record->update([
        'status' => 'under_review',
    ]);

    return redirect()->route('admin.farm-records.pending')
        ->with('success', 'Farm record marked as under review.');
}

/**
 * Show all farm records (approved, rejected, etc.)
 */
public function farmRecords()
{
    $records = \App\Models\FarmRecord::with('user')
        ->latest('created_at')
        ->paginate(20);

    return view('admin.farm-records.index', compact('records'));
}
}