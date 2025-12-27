@extends('layouts.admin')

@section('title', 'Create User')
@section('page-title', 'Create New User')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        <option value="">Select Role</option>
                        <option value="farmer">Farmer</option>
                        <option value="animal_health_professional">Professional</option>
                        <option value="volunteer">Volunteer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea name="address" rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">{{ old('address') }}</textarea>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <select name="country_id" id="country_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Country</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                    <select name="state_id" id="state_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">LGA</label>
                    <select name="lga_id" id="lga_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select LGA</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                <select name="account_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-secondary text-white rounded-lg hover:bg-secondary/90">
                <i class="fas fa-save mr-2"></i> Create User
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Load countries on page load
    fetch('/api/countries')
        .then(response => response.json())
        .then(data => {
            const countrySelect = document.getElementById('country_id');
            data.forEach(country => {
                countrySelect.innerHTML += `<option value="${country.id}">${country.name}</option>`;
            });
        });

    // Load states when country changes
    document.getElementById('country_id').addEventListener('change', function() {
        const countryId = this.value;
        const stateSelect = document.getElementById('state_id');
        const lgaSelect = document.getElementById('lga_id');

        stateSelect.innerHTML = '<option value="">Select State</option>';
        lgaSelect.innerHTML = '<option value="">Select LGA</option>';

        if (countryId) {
            fetch(`/api/states/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(state => {
                        stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                    });
                });
        }
    });

    // Load LGAs when state changes
    document.getElementById('state_id').addEventListener('change', function() {
        const stateId = this.value;
        const lgaSelect = document.getElementById('lga_id');

        lgaSelect.innerHTML = '<option value="">Select LGA</option>';

        if (stateId) {
            fetch(`/api/lgas/${stateId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(lga => {
                        lgaSelect.innerHTML += `<option value="${lga.id}">${lga.name}</option>`;
                    });
                });
        }
    });
</script>
@endpush
@endsection
