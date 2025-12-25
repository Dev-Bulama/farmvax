<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/farmvax-brand.css') }}">
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            
            <!-- Logo & Title -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16" style="background: linear-gradient(135deg, #61CE70 0%, #058283 100%);" class="rounded-full flex items-center justify-center">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold brand-teal">Volunteer Registration</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Help enroll farmers and receive outbreak alerts
                </p>
            </div>

            <!-- Registration Form -->
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" method="POST" action="{{ route('register.volunteer') }}">
                @csrf
                <input type="hidden" name="role" value="volunteer">

                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-md p-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="space-y-4">
                    
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            required
                            value="{{ old('name') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="John Doe"
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
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
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
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="+234 xxx xxx xxxx"
                        >
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="address" 
                            id="address" 
                            rows="2"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="Address, LGA, State"
                        >{{ old('address') }}</textarea>
                    </div>

                    <!-- Organization (Optional) -->
                    <div>
                        <label for="organization" class="block text-sm font-medium text-gray-700">
                            Organization <span class="text-gray-500 text-xs">(if applicable)</span>
                        </label>
                        <input 
                            type="text" 
                            name="organization" 
                            id="organization"
                            value="{{ old('organization') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="e.g., Community Development Association"
                        >
                    </div>

                    <!-- Assigned Area -->
                    <div>
                        <label for="assigned_area" class="block text-sm font-medium text-gray-700">
                            Area Where You'll Volunteer
                        </label>
                        <input 
                            type="text" 
                            name="assigned_area" 
                            id="assigned_area"
                            value="{{ old('assigned_area') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="e.g., Gwagwalada, FCT"
                        >
                    </div>

                    <!-- Motivation -->
                    <div>
                        <label for="motivation" class="block text-sm font-medium text-gray-700">
                            Why do you want to volunteer? <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="motivation" 
                            id="motivation" 
                            rows="4"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="Tell us why you want to help farmers and your community..."
                        >{{ old('motivation') }}</textarea>
                    </div>

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
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
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
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="Re-enter password"
                        >
                    </div>

                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <div class="flex">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800">
                                <strong>As a volunteer, you can:</strong>
                            </p>
                            <ul class="mt-2 text-sm text-blue-700 list-disc list-inside">
                                <li>Enroll farmers to the platform</li>
                                <li>Receive outbreak alerts in your area</li>
                                <li>Help your community stay informed</li>
                                <li>Track your impact (farmers enrolled)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        id="terms" 
                        required
                        class="mt-1 h-4 w-4 text-brand-green focus:ring-brand-green border-gray-300 rounded"
                    >
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the <a href="#" class="brand-teal hover:underline">Terms and Conditions</a> and <a href="#" class="brand-teal hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-green hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-green transition-all"
                    >
                        Register as Volunteer
                    </button>
                    <p class="mt-2 text-xs text-center text-gray-500">
                        Volunteer accounts are approved instantly
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
                        <a href="{{ route('register.professional') }}" class="brand-teal hover:underline text-xs">
                            Health Professional
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <script src="{{ asset('js/farmvax-mobile.js') }}"></script>
</body>
</html>