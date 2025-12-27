@extends('layouts.admin')

@section('title', 'Create Outbreak Alert')
@section('page-title', 'Create New Outbreak Alert')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.outbreak-alerts.store') }}" method="POST">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Disease Name</label>
                <input type="text" name="disease_name" value="{{ old('disease_name') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Severity</label>
                    <select name="severity" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high" selected>High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Affected Species</label>
                    <input type="text" name="affected_species" value="{{ old('affected_species') }}"
                           placeholder="e.g., Cattle, Poultry"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                    <select name="state_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">All States</option>
                        @foreach($states ?? [] as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">LGA</label>
                    <select name="lga_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">All LGAs</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Radius (km)</label>
                <input type="number" name="radius" value="{{ old('radius', '10') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Alert users within this radius</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notification Channels</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="channels[]" value="sms" checked class="w-4 h-4 text-red-600">
                        <span class="ml-2">SMS</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="channels[]" value="email" checked class="w-4 h-4 text-red-600">
                        <span class="ml-2">Email</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="channels[]" value="push" checked class="w-4 h-4 text-red-600">
                        <span class="ml-2">Push Notification</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.outbreak-alerts.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                <i class="fas fa-exclamation-triangle mr-2"></i> Create Alert
            </button>
        </div>
    </form>
</div>
@endsection
