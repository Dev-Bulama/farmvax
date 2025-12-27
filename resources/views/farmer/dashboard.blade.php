@extends('layouts.farmer')

@section('title', 'Farmer Dashboard')
@section('page-title', 'My Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Livestock</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['livestock'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-paw text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Vaccinations Due</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['vaccinations_due'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-syringe text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Service Requests</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['service_requests'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-hands-helping text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Health Score</p>
                <h3 class="text-2xl font-bold text-green-600">{{ $stats['health_score'] ?? 85 }}%</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-heartbeat text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

@if(isset($outbreakAlerts) && count($outbreakAlerts) > 0)
<div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
    <div class="flex items-center mb-2">
        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
        <h3 class="font-semibold text-red-800">Outbreak Alerts in Your Area</h3>
    </div>
    @foreach($outbreakAlerts as $alert)
        <div class="mt-2 p-3 bg-white rounded">
            <h4 class="font-semibold text-red-700">{{ $alert->disease_name }}</h4>
            <p class="text-sm text-gray-700">{{ $alert->description }}</p>
        </div>
    @endforeach
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Vaccination Reminders</h3>
        </div>
        <div class="p-6">
            @if(isset($upcomingVaccinations) && count($upcomingVaccinations) > 0)
                <div class="space-y-4">
                    @foreach($upcomingVaccinations as $vaccination)
                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded">
                            <div>
                                <p class="font-semibold">{{ $vaccination->vaccine_name }}</p>
                                <p class="text-sm text-gray-600">{{ $vaccination->livestock->name ?? 'N/A' }}</p>
                            </div>
                            <span class="text-sm text-yellow-700">{{ $vaccination->due_date->format('M d, Y') }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No upcoming vaccinations</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Recent Activity</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <p class="text-gray-500 text-center py-4">No recent activity</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <a href="{{ route('individual.livestock.create') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-plus text-green-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">Add Livestock</span>
    </a>

    <a href="{{ route('individual.service-requests.create') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-hands-helping text-blue-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">Request Service</span>
    </a>

    <a href="{{ url('/chat') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-comments text-purple-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">Chat</span>
    </a>

    <a href="{{ route('individual.profile') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-user text-gray-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">My Profile</span>
    </a>
</div>
@endsection
