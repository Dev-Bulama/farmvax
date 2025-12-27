<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Health Professional Registration - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/farmvax-brand.css') }}">
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            
            <!-- Logo & Title -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-brand-teal rounded-full flex items-center justify-center">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold brand-teal">Animal Health Professional</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Register to provide veterinary services and support to farmers
                </p>
            </div>

            <!-- Registration Form -->
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" method="POST" action="{{ route('register.professional') }}">
                @csrf
                <input type="hidden" name="role" value="animal_health_professional">

                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-md p-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-medium brand-teal mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                required
                                value="{{ old('name') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="Dr. John Doe"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required
                                value="{{ old('email') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="john@example.com"
                            >
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                id="phone" 
                                required
                                value="{{ old('phone') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="+234 xxx xxx xxxx"
                            >
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Address <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="address"
                                id="address"
                                rows="2"
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="Street address, village name"
                            >{{ old('address') }}</textarea>
                        </div>

                        <!-- Country -->
                        <div class="md:col-span-2">
                            <label for="country_id" class="block text-sm font-medium text-gray-700">
                                Country <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="country_id"
                                id="country_id"
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                            >
                                <option value="">Select Country</option>
                            </select>
                        </div>

                        <!-- State -->
                        <div>
                            <label for="state_id" class="block text-sm font-medium text-gray-700">
                                State <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="state_id"
                                id="state_id"
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                            >
                                <option value="">Select State</option>
                            </select>
                        </div>

                        <!-- LGA -->
                        <div>
                            <label for="lga_id" class="block text-sm font-medium text-gray-700">
                                Local Government Area <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="lga_id"
                                id="lga_id"
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                            >
                                <option value="">Select LGA</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Professional Information -->
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium brand-teal mb-4">Professional Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Professional Type -->
                        <div class="md:col-span-2">
                            <label for="professional_type" class="block text-sm font-medium text-gray-700">
                                Professional Type <span class="text-red-500">*</span>
                            </label>
                            <select 
                                name="professional_type" 
                                id="professional_type" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                            >
                                <option value="">Select your professional type</option>
                                <option value="veterinarian" {{ old('professional_type') == 'veterinarian' ? 'selected' : '' }}>
                                    Veterinarian
                                </option>
                                <option value="paraveterinarian" {{ old('professional_type') == 'paraveterinarian' ? 'selected' : '' }}>
                                    Paraveterinarian
                                </option>
                                <option value="community_animal_health_worker" {{ old('professional_type') == 'community_animal_health_worker' ? 'selected' : '' }}>
                                    Community Animal Health Worker
                                </option>
                                <option value="others" {{ old('professional_type') == 'others' ? 'selected' : '' }}>
                                    Others
                                </option>
                            </select>
                        </div>

                        <!-- License Number -->
                        <div>
                            <label for="license_number" class="block text-sm font-medium text-gray-700">
                                License Number <span class="text-gray-500 text-xs">(if applicable)</span>
                            </label>
                            <input 
                                type="text" 
                                name="license_number" 
                                id="license_number"
                                value="{{ old('license_number') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="VET/XXX/XXXX"
                            >
                        </div>

                        <!-- Years of Experience -->
                        <div>
                            <label for="experience_years" class="block text-sm font-medium text-gray-700">
                                Years of Experience
                            </label>
                            <input 
                                type="number" 
                                name="experience_years" 
                                id="experience_years" 
                                min="0"
                                value="{{ old('experience_years', 0) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="0"
                            >
                        </div>

                        <!-- Organization -->
                        <div>
                            <label for="organization" class="block text-sm font-medium text-gray-700">
                                Organization/Employer
                            </label>
                            <input 
                                type="text" 
                                name="organization" 
                                id="organization"
                                value="{{ old('organization') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="e.g., Ministry of Agriculture"
                            >
                        </div>

                        <!-- Specialization -->
                        <div>
                            <label for="specialization" class="block text-sm font-medium text-gray-700">
                                Specialization
                            </label>
                            <input 
                                type="text" 
                                name="specialization" 
                                id="specialization"
                                value="{{ old('specialization') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="e.g., Cattle, Poultry"
                            >
                        </div>

                        <!-- Assigned Territory -->
                        <div class="md:col-span-2">
                            <label for="assigned_territory" class="block text-sm font-medium text-gray-700">
                                Preferred Service Area/Territory
                            </label>
                            <input 
                                type="text" 
                                name="assigned_territory" 
                                id="assigned_territory"
                                value="{{ old('assigned_territory') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="e.g., Abuja Municipal, FCT"
                            >
                        </div>

                        <!-- Application Notes -->
                        <div class="md:col-span-2">
                            <label for="application_notes" class="block text-sm font-medium text-gray-700">
                                Additional Information
                            </label>
                            <textarea 
                                name="application_notes" 
                                id="application_notes" 
                                rows="3"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="Tell us more about your experience and why you want to join FarmVax..."
                            >{{ old('application_notes') }}</textarea>
                        </div>

                    </div>
                </div>

                <!-- Account Security -->
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium brand-teal mb-4">Account Security</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="Minimum 8 characters"
                            >
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-brand-teal"
                                placeholder="Re-enter password"
                            >
                        </div>

                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start pt-4">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        id="terms" 
                        required
                        class="mt-1 h-4 w-4 text-brand-teal focus:ring-brand-teal border-gray-300 rounded"
                    >
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the <a href="#" class="brand-teal hover:underline">Terms and Conditions</a> and <a href="#" class="brand-teal hover:underline">Privacy Policy</a>. I understand my application will be reviewed before approval.
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-teal hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-teal transition-all"
                    >
                        Submit Application
                    </button>
                    <p class="mt-2 text-xs text-center text-gray-500">
                        Your application will be reviewed by our admin team
                    </p>
                </div>

                <!-- Already have account -->
                <div class="text-center text-sm">
                    <span class="text-gray-600">Already have an account?</span>
                    <a href="{{ route('login') }}" class="brand-teal hover:underline font-medium ml-1">
                        Sign in
                    </a>
                </div>

                <!-- Register as different role -->
                <div class="text-center text-sm pt-4 border-t border-gray-200">
                    <p class="text-gray-600 mb-2">Register as:</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('register.farmer') }}" class="brand-teal hover:underline text-xs">
                            Farmer
                        </a>
                        <span class="text-gray-400">|</span>
                        <a href="{{ route('register.volunteer') }}" class="brand-teal hover:underline text-xs">
                            Volunteer
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <script src="{{ asset('js/farmvax-mobile.js') }}"></script>

    <!-- Cascading Location Dropdowns Script -->
    <script>
        // Load countries on page load
        fetch('/api/countries')
            .then(response => response.json())
            .then(data => {
                const countrySelect = document.getElementById('country_id');
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.id;
                    option.textContent = country.name;
                    countrySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading countries:', error));

        // Load states when country changes
        document.getElementById('country_id').addEventListener('change', function() {
            const countryId = this.value;
            const stateSelect = document.getElementById('state_id');
            const lgaSelect = document.getElementById('lga_id');

            // Reset dependent dropdowns
            stateSelect.innerHTML = '<option value="">Select State</option>';
            lgaSelect.innerHTML = '<option value="">Select LGA</option>';

            if (countryId) {
                fetch(`/api/states/${countryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(state => {
                            const option = document.createElement('option');
                            option.value = state.id;
                            option.textContent = state.name;
                            stateSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error loading states:', error));
            }
        });

        // Load LGAs when state changes
        document.getElementById('state_id').addEventListener('change', function() {
            const stateId = this.value;
            const lgaSelect = document.getElementById('lga_id');

            // Reset LGA dropdown
            lgaSelect.innerHTML = '<option value="">Select LGA</option>';

            if (stateId) {
                fetch(`/api/lgas/${stateId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(lga => {
                            const option = document.createElement('option');
                            option.value = lga.id;
                            option.textContent = lga.name;
                            lgaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error loading LGAs:', error));
            }
        });
    </script>

    <!-- Chat Bubble Widget -->
    @include('components.chat-bubble')
</body>
</html>