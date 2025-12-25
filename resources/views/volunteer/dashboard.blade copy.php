<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/farmvax-brand.css') }}">
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-brand-green">
                
                <!-- Logo -->
                <div class="flex items-center h-16 flex-shrink-0 px-4 bg-brand-green">
                    <span class="text-xl font-bold text-white">FarmVax</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                    <a href="{{ route('volunteer.dashboard') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white bg-green-600 rounded-md">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('volunteer.enroll.farmer') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-green-600">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Enroll Farmer
                    </a>

                    <a href="{{ route('volunteer.my-farmers') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-green-600">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        My Farmers
                    </a>

                    <a href="{{ route('volunteer.activity') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-green-600">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Activity
                    </a>

                    <a href="{{ route('volunteer.profile') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-green-600">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>
                </nav>

                <!-- Logout -->
                <div class="flex-shrink-0 px-2 py-4 border-t border-green-600">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-green-600">
                            <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold brand-teal">Volunteer Dashboard</h1>
                            <p class="text-sm text-gray-600">Welcome back, {{ $user->name }}!</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mx-4 sm:mx-6 lg:mx-8 mt-4">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-md p-4">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <!-- Main Content Area -->
            <main class="px-4 sm:px-6 lg:px-8 py-8">

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    
                    <!-- Total Farmers Enrolled -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-brand-green p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Farmers Enrolled</p>
                                <p class="text-2xl font-bold brand-teal">{{ $totalFarmersEnrolled }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-green-500 p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Status</p>
                                <p class="text-2xl font-bold text-green-600">Active</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Action -->
                    <div class="bg-brand-green rounded-lg shadow p-6 text-white">
                        <h3 class="text-lg font-bold mb-2">Ready to Help?</h3>
                        <p class="text-sm mb-4 opacity-90">Enroll a new farmer to the platform</p>
                        <a href="{{ route('volunteer.enroll.farmer') }}" class="inline-block bg-white text-brand-green px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
                            Enroll Farmer
                        </a>
                    </div>

                </div>

                <!-- Recent Enrollments -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-bold brand-teal">Recent Enrollments</h2>
                    </div>
                    <div class="p-6">
                        @if($recentEnrollments->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentEnrollments as $enrollment)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-brand-green flex items-center justify-center text-white font-bold">
                                        {{ substr($enrollment->farmer->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-900">{{ $enrollment->farmer->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $enrollment->farmer->email }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">{{ $enrollment->created_at->diffForHumans() }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->location }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('volunteer.my-farmers') }}" class="text-brand-teal hover:underline font-medium">
                                View All Farmers →
                            </a>
                        </div>
                        @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No farmers enrolled yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by enrolling your first farmer!</p>
                            <div class="mt-6">
                                <a href="{{ route('volunteer.enroll.farmer') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-green hover:opacity-90">
                                    Enroll Farmer
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </main>

        </div>

    </div>

    <script src="{{ asset('js/farmvax-mobile.js') }}"></script>
</body>
</html>