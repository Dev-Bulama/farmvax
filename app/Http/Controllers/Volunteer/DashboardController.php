<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\FarmerEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    /**
     * Show volunteer dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $volunteer = $user->volunteer;

        // Get stats
        $totalFarmersEnrolled = $volunteer->farmers_enrolled ?? 0;
        $recentEnrollments = FarmerEnrollment::where('enrolled_by', $user->id)
            ->with('farmer')
            ->latest()
            ->take(5)
            ->get();

        return view('volunteer.dashboard', compact('user', 'volunteer', 'totalFarmersEnrolled', 'recentEnrollments'));
    }

    /**
     * Show volunteer profile.
     */
    // public function profile()
    // {
    //     $user = auth()->user();
    //     $volunteer = $user->volunteer;

    //     return view('volunteer.profile', compact('user', 'volunteer'));
    // }

    /**
     * Show enroll farmer form.
     */
    public function showEnrollForm()
    {
        $user = auth()->user();
        
        return view('volunteer.enroll-farmer', compact('user'));
    }

    /**
     * Enroll a new farmer.
     */
    public function enrollFarmer(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Create farmer user
        $farmer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'farmer',
        ]);

        // Create enrollment record
        FarmerEnrollment::create([
            'farmer_id' => $farmer->id,
            'enrolled_by' => auth()->id(),
            'enrollment_method' => 'volunteer',
            'location' => $request->address,
            'notes' => 'Enrolled by volunteer: ' . auth()->user()->name,
        ]);

        // Increment volunteer's farmers enrolled count
        $volunteer = auth()->user()->volunteer;
        $volunteer->increment('farmers_enrolled');

        return redirect()->route('volunteer.dashboard')
            ->with('success', 'Farmer enrolled successfully! Login credentials have been sent to their email.');
    }

    /**
     * Show farmers enrolled by this volunteer.
     */
    public function myFarmers()
    {
        $user = auth()->user();
        
        $farmers = FarmerEnrollment::where('enrolled_by', $user->id)
            ->with('farmer')
            ->latest()
            ->paginate(10);

        return view('volunteer.my-farmers', compact('user', 'farmers'));
    }

    /**
     * Show specific farmer details.
     */
    public function showFarmer($id)
    {
        $enrollment = FarmerEnrollment::where('enrolled_by', auth()->id())
            ->where('farmer_id', $id)
            ->with('farmer')
            ->firstOrFail();

        return view('volunteer.show-farmer', compact('enrollment'));
    }

    /**
     * Show volunteer activity log.
     */
    // public function activity()
    // {
    //     $user = auth()->user();
        
    //     $activities = FarmerEnrollment::where('enrolled_by', $user->id)
    //         ->with('farmer')
    //         ->latest()
    //         ->paginate(20);

    //     return view('volunteer.activity', compact('user', 'activities'));
    // }
    // public function profile()
    // {
    //     return view('volunteer.profile');
    // }

    public function activity()
    {
        $totalEnrolled = auth()->user()->enrolledFarmers()->count();
        $thisMonth = auth()->user()->enrolledFarmers()
            ->whereMonth('created_at', now()->month)
            ->count();
        $thisWeek = auth()->user()->enrolledFarmers()
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->count();
        $today = auth()->user()->enrolledFarmers()
            ->whereDate('created_at', now())
            ->count();
        $recentActivity = auth()->user()->enrolledFarmers()
            ->with('farmer')
            ->latest()
            ->take(20)
            ->get();

        return view('volunteer.activity', compact(
            'totalEnrolled',
            'thisMonth',
            'thisWeek',
            'today',
            'recentActivity'
        ));
    }
public function profile()
   {
       return view('volunteer.profile');
   }
}