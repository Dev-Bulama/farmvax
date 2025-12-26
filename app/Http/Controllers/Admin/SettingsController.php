<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ProfessionalType;
use App\Models\Specialization;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function general()
    {
        $settings = Setting::where('group', 'general')->get();

        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:1024',
        ]);

        foreach ($validated as $key => $value) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('public/settings');
                Setting::set($key, Storage::url($path), 'image', 'general');
            } elseif ($value !== null) {
                Setting::set($key, $value, 'string', 'general');
            }
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'General settings updated successfully');
    }

    public function email()
    {
        $settings = Setting::where('group', 'email')->get();

        return view('admin.settings.email', compact('settings'));
    }

    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|numeric',
            'smtp_username' => 'required|string',
            'smtp_password' => 'nullable|string',
            'smtp_encryption' => 'required|in:tls,ssl',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            if ($value !== null) {
                Setting::set($key, $value, 'string', 'email');
            }
        }

        // Update .env file
        $this->updateEnvFile([
            'MAIL_HOST' => $validated['smtp_host'],
            'MAIL_PORT' => $validated['smtp_port'],
            'MAIL_USERNAME' => $validated['smtp_username'],
            'MAIL_ENCRYPTION' => $validated['smtp_encryption'],
            'MAIL_FROM_ADDRESS' => $validated['from_email'],
            'MAIL_FROM_NAME' => $validated['from_name'],
        ]);

        return redirect()->route('admin.settings.email')
            ->with('success', 'Email settings updated successfully');
    }

    public function sms()
    {
        $settings = Setting::where('group', 'sms')->get();

        return view('admin.settings.sms', compact('settings'));
    }

    public function updateSms(Request $request)
    {
        $validated = $request->validate([
            'sms_provider' => 'required|string',
            'sms_api_key' => 'required|string',
            'sms_api_secret' => 'nullable|string',
            'sms_from_number' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value, 'string', 'sms');
        }

        return redirect()->route('admin.settings.sms')
            ->with('success', 'SMS settings updated successfully');
    }

    public function ai()
    {
        $settings = Setting::where('group', 'ai')->get();

        return view('admin.settings.ai', compact('settings'));
    }

    public function updateAi(Request $request)
    {
        $validated = $request->validate([
            'ai_enabled' => 'required|boolean',
            'ai_provider' => 'required|string',
            'ai_api_key' => 'required|string',
            'ai_model' => 'required|string',
            'ai_temperature' => 'required|numeric|min:0|max:2',
            'ai_max_tokens' => 'required|integer|min:1|max:4000',
        ]);

        Setting::set('ai_enabled', $validated['ai_enabled'], 'boolean', 'ai');
        Setting::set('ai_provider', $validated['ai_provider'], 'string', 'ai');
        Setting::set('ai_api_key', $validated['ai_api_key'], 'string', 'ai');
        Setting::set('ai_model', $validated['ai_model'], 'string', 'ai');
        Setting::set('ai_temperature', $validated['ai_temperature'], 'string', 'ai');
        Setting::set('ai_max_tokens', $validated['ai_max_tokens'], 'string', 'ai');

        return redirect()->route('admin.settings.ai')
            ->with('success', 'AI settings updated successfully');
    }

    public function professional()
    {
        $professionalTypes = ProfessionalType::all();
        $specializations = Specialization::all();
        $serviceAreas = ServiceArea::all();

        return view('admin.settings.professional', compact('professionalTypes', 'specializations', 'serviceAreas'));
    }

    public function storeProfessionalType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProfessionalType::create($validated);

        return redirect()->route('admin.settings.professional')
            ->with('success', 'Professional type added successfully');
    }

    public function storeSpecialization(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Specialization::create($validated);

        return redirect()->route('admin.settings.professional')
            ->with('success', 'Specialization added successfully');
    }

    public function storeServiceArea(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ServiceArea::create($validated);

        return redirect()->route('admin.settings.professional')
            ->with('success', 'Service area added successfully');
    }

    public function deleteProfessionalType($id)
    {
        ProfessionalType::findOrFail($id)->delete();

        return redirect()->route('admin.settings.professional')
            ->with('success', 'Professional type deleted successfully');
    }

    public function deleteSpecialization($id)
    {
        Specialization::findOrFail($id)->delete();

        return redirect()->route('admin.settings.professional')
            ->with('success', 'Specialization deleted successfully');
    }

    public function deleteServiceArea($id)
    {
        ServiceArea::findOrFail($id)->delete();

        return redirect()->route('admin.settings.professional')
            ->with('success', 'Service area deleted successfully');
    }

    private function updateEnvFile(array $data)
    {
        $envFile = base_path('.env');
        $str = file_get_contents($envFile);

        foreach ($data as $key => $value) {
            $str = preg_replace(
                "/^{$key}=.*/m",
                "{$key}=\"{$value}\"",
                $str
            );
        }

        file_put_contents($envFile, $str);
    }
}
