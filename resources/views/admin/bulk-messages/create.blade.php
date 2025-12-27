@extends('layouts.admin')

@section('title', 'Create Bulk Message')
@section('page-title', 'Send Bulk Message')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.bulk-messages.store') }}" method="POST">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                <textarea name="message" rows="5" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">{{ old('message') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">SMS messages will be limited to 160 characters</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message Type</label>
                <select name="type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="email">Email</option>
                    <option value="sms">SMS</option>
                    <option value="both">Both Email & SMS</option>
                </select>
            </div>

            <div class="border-t pt-4">
                <h3 class="text-lg font-semibold mb-4">Target Recipients</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Target Roles</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="target_roles[]" value="farmer" class="w-4 h-4 text-green-600">
                            <span class="ml-2">Farmers</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="target_roles[]" value="animal_health_professional" class="w-4 h-4 text-green-600">
                            <span class="ml-2">Professionals</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="target_roles[]" value="volunteer" class="w-4 h-4 text-green-600">
                            <span class="ml-2">Volunteers</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State (Optional)</label>
                        <select name="state_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">All States</option>
                            @foreach($states ?? [] as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LGA (Optional)</label>
                        <select name="lga_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">All LGAs</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="border-t pt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="send_immediately" value="1" checked class="w-4 h-4 text-green-600">
                    <span class="ml-2 text-sm">Send immediately</span>
                </label>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.bulk-messages.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-paper-plane mr-2"></i> Send Message
            </button>
        </div>
    </form>
</div>
@endsection
