<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OutbreakAlert;
use App\Models\OutbreakAlertNotification;
use App\Models\User;
use Illuminate\Http\Request;

class OutbreakAlertController extends Controller
{
    public function index()
    {
        $alerts = OutbreakAlert::with('reporter')->latest()->paginate(20);

        $stats = [
            'total' => OutbreakAlert::count(),
            'active' => OutbreakAlert::where('status', 'active')->count(),
            'critical' => OutbreakAlert::where('severity', 'critical')->count(),
            'total_cases' => OutbreakAlert::sum('confirmed_cases'),
        ];

        return view('admin.outbreak-alerts.index', compact('alerts', 'stats'));
    }

    public function create()
    {
        return view('admin.outbreak-alerts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'disease_name' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'location_state' => 'required|string',
            'location_lga' => 'nullable|string',
            'location_village' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'radius_km' => 'required|integer|min:1|max:500',
            'outbreak_date' => 'required|date',
            'precautions' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'affected_animals' => 'nullable|array',
            'confirmed_cases' => 'required|integer|min:0',
            'deaths' => 'required|integer|min:0',
        ]);

        $validated['reported_by'] = auth()->id();
        $validated['status'] = 'active';

        $alert = OutbreakAlert::create($validated);

        // Send notifications to affected farmers
        $this->sendNotifications($alert);

        return redirect()->route('admin.outbreak-alerts.index')
            ->with('success', 'Outbreak alert created and notifications sent');
    }

    public function edit($id)
    {
        $alert = OutbreakAlert::findOrFail($id);

        return view('admin.outbreak-alerts.edit', compact('alert'));
    }

    public function update(Request $request, $id)
    {
        $alert = OutbreakAlert::findOrFail($id);

        $validated = $request->validate([
            'disease_name' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'location_state' => 'required|string',
            'location_lga' => 'nullable|string',
            'location_village' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'radius_km' => 'required|integer|min:1|max:500',
            'outbreak_date' => 'required|date',
            'status' => 'required|in:active,contained,resolved',
            'precautions' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'affected_animals' => 'nullable|array',
            'confirmed_cases' => 'required|integer|min:0',
            'deaths' => 'required|integer|min:0',
        ]);

        $alert->update($validated);

        return redirect()->route('admin.outbreak-alerts.index')
            ->with('success', 'Outbreak alert updated successfully');
    }

    public function destroy($id)
    {
        OutbreakAlert::findOrFail($id)->delete();

        return redirect()->route('admin.outbreak-alerts.index')
            ->with('success', 'Outbreak alert deleted successfully');
    }

    private function sendNotifications(OutbreakAlert $alert)
    {
        // Get all farmers
        $farmers = User::where('role', 'farmer')
            ->where('account_status', 'active')
            ->get();

        foreach ($farmers as $farmer) {
            // Check if farmer is in affected area
            if ($alert->isUserInRadius($farmer)) {
                // Create notification records
                OutbreakAlertNotification::create([
                    'outbreak_alert_id' => $alert->id,
                    'user_id' => $farmer->id,
                    'channel' => 'email',
                    'status' => 'pending'
                ]);

                // If SMS is enabled
                if ($farmer->phone) {
                    OutbreakAlertNotification::create([
                        'outbreak_alert_id' => $alert->id,
                        'user_id' => $farmer->id,
                        'channel' => 'sms',
                        'status' => 'pending'
                    ]);
                }

                // Here you would integrate with actual email/SMS sending
                // For now, we'll just mark as sent
                // Mail::to($farmer->email)->send(new OutbreakAlertMail($alert));
                // SMS::send($farmer->phone, $message);
            }
        }
    }

    public function notifications($id)
    {
        $alert = OutbreakAlert::with(['notifications.user'])->findOrFail($id);

        return view('admin.outbreak-alerts.notifications', compact('alert'));
    }
}
