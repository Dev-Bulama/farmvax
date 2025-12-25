<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/farmvax-brand.css') }}">
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            
            <!-- Logo & Title -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-brand-green rounded-full flex items-center justify-center">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold brand-teal">Farmer Registration</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Join FarmVax to manage your livestock and receive outbreak alerts
                </p>
            </div>

            <!-- Registration Form -->
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" method="POST" action="{{ route('register.farmer') }}">
                @csrf
                <input type="hidden" name="role" value="farmer">

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

                    <!-- Address/Location -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">
                            Farm Location/Address <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="address" 
                            id="address" 
                            rows="3"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-brand-green"
                            placeholder="Village, LGA, State"
                        >{{ old('address') }}</textarea>
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

                    <!-- Hidden field for enrollment tracking -->
                    @if(request()->has('enrolled_by'))
                    <input type="hidden" name="enrolled_by" value="{{ request('enrolled_by') }}">
                    @endif

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
                        Register as Farmer
                    </button>
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
                        <a href="{{ route('register.professional') }}" class="brand-teal hover:underline text-xs">
                            Health Professional
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
</body>
</html>