<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\Lga;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function countries()
    {
        $countries = Country::orderBy('name')->get(['id', 'name', 'code']);

        return response()->json($countries);
    }

    public function states($countryId = null)
    {
        $query = State::with('country')->orderBy('name');

        if ($countryId) {
            $query->where('country_id', $countryId);
        }

        $states = $query->get(['id', 'country_id', 'name', 'code']);

        return response()->json($states);
    }

    public function lgas($stateId = null)
    {
        $query = Lga::with('state')->orderBy('name');

        if ($stateId) {
            $query->where('state_id', $stateId);
        }

        $lgas = $query->get(['id', 'state_id', 'name']);

        return response()->json($lgas);
    }

    /**
     * Get location data by coordinates (GPS)
     */
    public function detectLocation(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // This would typically use a reverse geocoding API
        // For now, return a simple response
        // You can integrate with Google Maps API, OpenStreetMap, etc.

        return response()->json([
            'success' => true,
            'message' => 'Location detection would be implemented here with a geocoding service',
            'coordinates' => $validated,
            // Example response structure:
            // 'country' => 'Nigeria',
            // 'state' => 'Kano',
            // 'lga' => 'Kano Municipal',
        ]);
    }

    /**
     * Search locations by name
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $results = [
            'countries' => Country::where('name', 'like', "%{$query}%")
                ->limit(5)
                ->get(['id', 'name', 'code']),
            'states' => State::where('name', 'like', "%{$query}%")
                ->with('country:id,name')
                ->limit(10)
                ->get(['id', 'country_id', 'name', 'code']),
            'lgas' => Lga::where('name', 'like', "%{$query}%")
                ->with('state.country')
                ->limit(15)
                ->get(['id', 'state_id', 'name']),
        ];

        return response()->json($results);
    }
}
