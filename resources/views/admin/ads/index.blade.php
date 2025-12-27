@extends('layouts.admin')

@section('title', 'Advertisements')
@section('page-title', 'Advertisement Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Advertisements</h2>
    <a href="{{ route('admin.ads.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
        <i class="fas fa-plus mr-2"></i> Create Ad
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @forelse($ads ?? [] as $ad)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($ad->image_url)
                <img src="{{ asset($ad->image_url) }}" alt="{{ $ad->title }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-6">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="text-lg font-semibold">{{ $ad->title }}</h3>
                    <span class="px-2 py-1 text-xs rounded-full {{ $ad->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($ad->status) }}
                    </span>
                </div>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($ad->description, 100) }}</p>
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <div>
                        <i class="fas fa-eye mr-1"></i> {{ $ad->views ?? 0 }} views
                    </div>
                    <div>
                        <i class="fas fa-mouse-pointer mr-1"></i> {{ $ad->clicks ?? 0 }} clicks
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-xs text-gray-500">
                        {{ $ad->start_date->format('M d') }} - {{ $ad->end_date->format('M d, Y') }}
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.ads.edit', $ad->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this ad?')" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-2 bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-bullhorn text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">No advertisements created yet</p>
            <a href="{{ route('admin.ads.create') }}" class="inline-block mt-4 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Create Your First Ad
            </a>
        </div>
    @endforelse
</div>

@if(isset($ads) && $ads->hasPages())
    <div class="mt-6">
        {{ $ads->links() }}
    </div>
@endif
@endsection
