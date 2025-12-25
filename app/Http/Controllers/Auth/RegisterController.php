<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AnimalHealthProfessional;
use App\Models\Volunteer;
use App\Models\FarmerEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Show farmer registration form.
     */
    public function showFarmerForm()
    {
        return view('auth.register-farmer');
    }

    /**
     * Show animal health professional registration form.
     */
    public function showProfessionalForm()
    {
        return view('auth.register-professional');
    }

    /**
     * Show volunteer registration form.
     */
    public function showVolunteerForm()
    {
        return view('auth.register-volunteer');
    }

    /**
     * Register a farmer.
     */
    public function registerFarmer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'terms' => ['required', 'accepted'],
            'enrolled_by' => ['nullable', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'farmer',
        ]);

        // Create enrollment record
        FarmerEnrollment::create([
            'farmer_id' => $user->id,
            'enrolled_by' => $request->enrolled_by,
            'enrollment_method' => $request->enrolled_by ? 'volunteer' : 'self',
            'location' => $request->address,
            'notes' => $request->enrolled_by ? 'Enrolled by volunteer' : 'Self-registered',
        ]);

        // If enrolled by volunteer, increment their count
        if ($request->enrolled_by) {
            $volunteer = User::find($request->enrolled_by);
            if ($volunteer && $volunteer->volunteer) {
                $volunteer->volunteer->incrementFarmersEnrolled();
            }
        }

        // Log in the user
        auth()->login($user);

        return redirect()->route('individual.dashboard')
            ->with('success', 'Welcome to FarmVax! Your account has been created successfully.');
    }

    /**
     * Register an animal health professional.
     */
    public function registerProfessional(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'professional_type' => ['required', 'in:veterinarian,paraveterinarian,community_animal_health_worker,others'],
            'license_number' => ['nullable', 'string', 'max:100'],
            'experience_years' => ['nullable', 'integer', 'min:0'],
            'organization' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'assigned_territory' => ['nullable', 'string', 'max:255'],
            'application_notes' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'terms' => ['required', 'accepted'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'animal_health_professional',
        ]);

        // Create professional profile
        AnimalHealthProfessional::create([
            'user_id' => $user->id,
            'professional_type' => $request->professional_type,
            'license_number' => $request->license_number,
            'organization' => $request->organization,
            'experience_years' => $request->experience_years ?? 0,
            'specialization' => $request->specialization,
            'assigned_territory' => $request->assigned_territory,
            'contact_phone' => $request->phone,
            'contact_email' => $request->email,
            'approval_status' => 'pending',
            'submitted_at' => now(),
            'application_notes' => $request->application_notes,
        ]);

        // Log in the user
        auth()->login($user);

        return redirect()->route('professional.dashboard')
            ->with('info', 'Thank you for applying! Your application is being reviewed by our admin team. You will receive an email once approved.');
    }

    /**
     * Register a volunteer.
     */
    public function registerVolunteer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'organization' => ['nullable', 'string', 'max:255'],
            'assigned_area' => ['nullable', 'string', 'max:255'],
            'motivation' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'terms' => ['required', 'accepted'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'volunteer',
        ]);

        // Create volunteer profile (auto-approved)
        Volunteer::create([
            'user_id' => $user->id,
            'organization' => $request->organization,
            'assigned_area' => $request->assigned_area,
            'motivation' => $request->motivation,
            'contact_phone' => $request->phone,
            'contact_email' => $request->email,
            'farmers_enrolled' => 0,
            'is_active' => true,
            'approval_status' => 'approved', // Auto-approve volunteers
            'approved_at' => now(),
            'submitted_at' => now(),
        ]);

        // Log in the user
        auth()->login($user);

        return redirect()->route('volunteer.dashboard')
            ->with('success', 'Welcome to FarmVax! Your volunteer account has been created successfully. You can now start enrolling farmers.');
    }
}