<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataCollectorProfile;
use App\Models\VerificationDocument;
use App\Models\AlertPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Show Individual registration form
     *
     * @return \Illuminate\View\View
     */
    public function showIndividualForm()
    {
        return view('auth.register-individual');
    }

    /**
     * Show Data Collector registration form
     *
     * @return \Illuminate\View\View
     */
    public function showDataCollectorForm()
    {
        return view('auth.register-data-collector');
    }

    /**
     * Register Individual
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerIndividual(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'individual',
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country ?? 'Nigeria',
                'status' => 'active',
                'is_approved' => true,
            ]);

            // Create default alert preferences
            AlertPreference::create([
                'user_id' => $user->id,
                'primary_phone' => $request->phone,
                'primary_email' => $request->email,
            ]);

            DB::commit();

            // Log the user in
            auth()->login($user);

            return redirect()->route('individual.dashboard')
                ->with('success', 'Registration successful! Welcome to FarmVax.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Register Data Collector
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerDataCollector(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            // Basic Information
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',

            // Profile Image
            'profile_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',

            // Professional Information
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'employee_id' => 'nullable|string|max:100',
            'reason_for_applying' => 'required|string|min:50',
            'experience' => 'nullable|string',
            'education_level' => 'nullable|string|max:100',

            // ID Card Information
            'id_card_type' => 'required|string|max:100',
            'id_card_number' => 'required|string|max:100',
            'id_card_document' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120',

            // Certificates (optional, multiple files)
            'certificates.*' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',

            // Verification Document (Government/Organization authorization)
            'verification_document' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120',

            // Reference Information
            'reference_name' => 'nullable|string|max:255',
            'reference_phone' => 'nullable|string|max:20',
            'reference_email' => 'nullable|email|max:255',

            // Territory
            'assigned_territory' => 'nullable|string|max:255',
            'coverage_area' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Upload profile image
            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('profiles', 'public');
            }

            // Create user account (not approved yet)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'data_collector',
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country ?? 'Nigeria',
                'bio' => $request->bio,
                'profile_image' => $profileImagePath,
                'status' => 'active',
                'is_approved' => false, // Requires admin approval
            ]);

            // Upload ID card document
            $idCardPath = null;
            if ($request->hasFile('id_card_document')) {
                $idCardPath = $request->file('id_card_document')->store('documents/id-cards', 'public');
            }

            // Upload verification document
            $verificationDocPath = null;
            if ($request->hasFile('verification_document')) {
                $verificationDocPath = $request->file('verification_document')->store('documents/verification', 'public');
            }

            // Upload certificates (multiple files)
            $certificatePaths = [];
            if ($request->hasFile('certificates')) {
                foreach ($request->file('certificates') as $certificate) {
                    $path = $certificate->store('documents/certificates', 'public');
                    $certificatePaths[] = $path;
                }
            }

            // Create Data Collector Profile
            $profile = DataCollectorProfile::create([
                'user_id' => $user->id,
                'organization' => $request->organization,
                'position' => $request->position,
                'employee_id' => $request->employee_id,
                'reason_for_applying' => $request->reason_for_applying,
                'experience' => $request->experience,
                'education_level' => $request->education_level,
                'id_card_type' => $request->id_card_type,
                'id_card_number' => $request->id_card_number,
                'id_card_document' => $idCardPath,
                'certificates' => $certificatePaths,
                'verification_document' => $verificationDocPath,
                'reference_name' => $request->reference_name,
                'reference_phone' => $request->reference_phone,
                'reference_email' => $request->reference_email,
                'assigned_territory' => $request->assigned_territory,
                'coverage_area' => $request->coverage_area,
                'approval_status' => 'pending',
                'submitted_at' => now(),
            ]);

            // Create verification documents records
            
            // 1. ID Card Document
            if ($idCardPath) {
                VerificationDocument::create([
                    'user_id' => $user->id,
                    'data_collector_profile_id' => $profile->id,
                    'document_type' => $request->id_card_type,
                    'document_name' => 'ID Card - ' . $request->id_card_type,
                    'file_path' => $idCardPath,
                    'file_type' => $request->file('id_card_document')->getClientOriginalExtension(),
                    'file_size' => $request->file('id_card_document')->getSize(),
                    'document_number' => $request->id_card_number,
                    'category' => 'identification',
                    'is_primary' => true,
                    'verification_status' => 'pending',
                ]);
            }

            // 2. Verification/Authorization Document
            if ($verificationDocPath) {
                VerificationDocument::create([
                    'user_id' => $user->id,
                    'data_collector_profile_id' => $profile->id,
                    'document_type' => 'Authorization Letter',
                    'document_name' => 'Government/Organization Verification',
                    'file_path' => $verificationDocPath,
                    'file_type' => $request->file('verification_document')->getClientOriginalExtension(),
                    'file_size' => $request->file('verification_document')->getSize(),
                    'category' => 'authorization',
                    'verification_status' => 'pending',
                ]);
            }

            // 3. Certificates (multiple)
            if (!empty($certificatePaths)) {
                foreach ($request->file('certificates') as $index => $certificate) {
                    VerificationDocument::create([
                        'user_id' => $user->id,
                        'data_collector_profile_id' => $profile->id,
                        'document_type' => 'Professional Certificate',
                        'document_name' => 'Certificate ' . ($index + 1),
                        'file_path' => $certificatePaths[$index],
                        'file_type' => $certificate->getClientOriginalExtension(),
                        'file_size' => $certificate->getSize(),
                        'category' => 'professional',
                        'verification_status' => 'pending',
                    ]);
                }
            }

            // Create default alert preferences
            AlertPreference::create([
                'user_id' => $user->id,
                'primary_phone' => $request->phone,
                'primary_email' => $request->email,
            ]);

            DB::commit();

            // Log the user in
            auth()->login($user);

            // Redirect to pending approval page
            return redirect()->route('pending-approval')
                ->with('success', 'Registration successful! Your application is pending admin approval. You will be notified once approved.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Clean up uploaded files on error
            if (isset($profileImagePath)) Storage::disk('public')->delete($profileImagePath);
            if (isset($idCardPath)) Storage::disk('public')->delete($idCardPath);
            if (isset($verificationDocPath)) Storage::disk('public')->delete($verificationDocPath);
            if (!empty($certificatePaths)) {
                foreach ($certificatePaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            return redirect()->back()
                ->with('error', 'Registration failed: ' . $e->getMessage())
                ->withInput();
        }
    }
}