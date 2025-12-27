@extends('layouts.admin')

@section('title', 'Bulk Messaging')
@section('page-title', 'Bulk Message Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Bulk Messages</h2>
    <a href="{{ route('admin.bulk-messages.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
        <i class="fas fa-envelope-open-text mr-2"></i> New Message
    </a>
</div>

<div class="space-y-4">
    @forelse($messages ?? [] as $message)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <h3 class="text-lg font-semibold mr-3">{{ $message->title }}</h3>
                        <span class="px-2 py-1 text-xs rounded-full {{ $message->status == 'sent' ? 'bg-green-100 text-green-800' : ($message->status == 'sending' ? 'bg-blue-100 text-blue-800' : ($message->status == 'failed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                            {{ ucfirst($message->status) }}
                        </span>
                        <span class="ml-2 px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                            {{ strtoupper($message->type) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-3">{{ Str::limit($message->message, 150) }}</p>
                </div>
            </div>
            
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="text-center p-3 bg-gray-50 rounded">
                    <div class="text-2xl font-bold text-gray-900">{{ $message->total_recipients ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Total Recipients</div>
                </div>
                <div class="text-center p-3 bg-green-50 rounded">
                    <div class="text-2xl font-bold text-green-600">{{ $message->sent_count ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Sent</div>
                </div>
                <div class="text-center p-3 bg-red-50 rounded">
                    <div class="text-2xl font-bold text-red-600">{{ $message->failed_count ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Failed</div>
                </div>
                <div class="text-center p-3 bg-blue-50 rounded">
                    <div class="text-2xl font-bold text-blue-600">{{ round((($message->sent_count ?? 0) / max($message->total_recipients ?? 1, 1)) * 100) }}%</div>
                    <div class="text-xs text-gray-500">Success Rate</div>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-500">
                <div>
                    <i class="fas fa-calendar mr-1"></i> {{ $message->created_at->format('M d, Y g:i A') }}
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.bulk-messages.show', $message->id) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-envelope-open-text text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">No bulk messages sent yet</p>
            <a href="{{ route('admin.bulk-messages.create') }}" class="inline-block mt-4 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Send Your First Message
            </a>
        </div>
    @endforelse
</div>

@if(isset($messages) && $messages->hasPages())
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endif
@endsection
