@extends('layouts.admin')

@section('title', 'Outbreak Alerts')
@section('page-title', 'Outbreak Alert Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Outbreak Alerts</h2>
    <a href="{{ route('admin.outbreak-alerts.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
        <i class="fas fa-exclamation-triangle mr-2"></i> Create Alert
    </a>
</div>

<div class="space-y-4">
    @forelse($alerts ?? [] as $alert)
        <div class="bg-white rounded-lg shadow p-6 border-l-4 {{ $alert->severity == 'high' ? 'border-red-500' : ($alert->severity == 'medium' ? 'border-yellow-500' : 'border-blue-500') }}">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <h3 class="text-lg font-semibold mr-3">{{ $alert->disease_name }}</h3>
                        <span class="px-2 py-1 text-xs rounded-full {{ $alert->severity == 'high' ? 'bg-red-100 text-red-800' : ($alert->severity == 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ ucfirst($alert->severity) }} Severity
                        </span>
                        <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $alert->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($alert->status) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-3">{{ $alert->description }}</p>
                    <div class="grid grid-cols-3 gap-4 text-sm text-gray-500">
                        <div>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ $alert->state->name ?? 'All Locations' }}
                        </div>
                        <div>
                            <i class="fas fa-paw mr-1"></i>
                            {{ $alert->affected_species ?? 'All Species' }}
                        </div>
                        <div>
                            <i class="fas fa-users mr-1"></i>
                            {{ $alert->notified_count ?? 0 }} notified
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-2 ml-4">
                    <a href="{{ route('admin.outbreak-alerts.edit', $alert->id) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.outbreak-alerts.destroy', $alert->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this alert?')" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-exclamation-triangle text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">No outbreak alerts created</p>
            <a href="{{ route('admin.outbreak-alerts.create') }}" class="inline-block mt-4 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Create First Alert
            </a>
        </div>
    @endforelse
</div>

@if(isset($alerts) && $alerts->hasPages())
    <div class="mt-6">
        {{ $alerts->links() }}
    </div>
@endif
@endsection
