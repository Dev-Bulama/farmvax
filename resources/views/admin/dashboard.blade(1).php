<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
<!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-purple-600 text-white hover:bg-purple-700">
                <svg id="menu-open-icon" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-close-icon" class="h-6 w-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64" style="background-color: #7C3AED;">
                
                <!-- Logo -->
                <div class="flex items-center h-16 flex-shrink-0 px-4">
                    <span class="text-xl font-bold text-white">FarmVax Admin</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white bg-purple-700 rounded-md">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.professionals.pending') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pending Approvals
                        @if(isset($stats['pending_professionals']) && $stats['pending_professionals'] > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            {{ $stats['pending_professionals'] }}
                        </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.farmers') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Farmers
                    </a>

                    <a href="{{ route('admin.professionals.index') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Professionals
                    </a>

                    <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Volunteers
                    </a>

                    <a href="{{ route('admin.service-requests.index') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Service Requests
                    </a>

                    <a href="{{ route('admin.farm-records.index') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Farm Records
                    </a>

                    <a href="{{ route('admin.statistics') }}" class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
                        <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Statistics
                    </a>
                </nav>

                <!-- Logout -->
                <div class="flex-shrink-0 px-2 py-4 border-t border-purple-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-purple-700">
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
                            <h1 class="text-2xl font-bold text-purple-600">Admin Dashboard</h1>
                            <p class="text-sm text-gray-600">System Overview & Management</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ now()->format('l, F j, Y') }}</p>
                            <p class="text-xs text-gray-400">{{ now()->format('g:i A') }}</p>
                        </div>
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

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    
                    <!-- Total Users -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-purple-600 p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Users</p>
                                <p class="text-2xl font-bold text-purple-600">{{ $stats['total_users'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Farmers -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-green-600 p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Farmers</p>
                                <p class="text-2xl font-bold text-green-600">{{ $stats['total_farmers'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Professionals -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-blue-600 p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Professionals</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $stats['total_professionals'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Approvals -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-yellow-500 p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Pending Approvals</p>
                                <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_professionals'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Secondary Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-sm text-gray-600">Total Livestock</p>
                        <p class="text-xl font-bold text-gray-900">{{ $stats['total_livestock'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-sm text-gray-600">Farm Records</p>
                        <p class="text-xl font-bold text-gray-900">{{ $stats['total_farm_records'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-sm text-gray-600">Volunteers</p>
                        <p class="text-xl font-bold text-gray-900">{{ $stats['total_volunteers'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-sm text-gray-600">Pending Requests</p>
                        <p class="text-xl font-bold text-gray-900">{{ $stats['pending_service_requests'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Pending Professional Applications Alert -->
                @if(isset($pendingProfessionals) && $pendingProfessionals->count() > 0)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                {{ $pendingProfessionals->count() }} Professional Application(s) Awaiting Review
                            </h3>
                            <div class="mt-2">
                                <a href="{{ route('admin.professionals.pending') }}" class="text-sm font-medium text-yellow-800 hover:text-yellow-900 underline">
                                    Review Applications →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <!-- Recent Users -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-purple-600">Recent Registrations</h2>
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-purple-600 hover:underline">View All</a>
                        </div>
                        <div class="p-6">
                            @if(isset($recentUsers) && $recentUsers->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentUsers as $user)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full {{ $user->role === 'farmer' ? 'bg-green-100' : ($user->role === 'animal_health_professional' ? 'bg-blue-100' : 'bg-purple-100') }} flex items-center justify-center font-bold {{ $user->role === 'farmer' ? 'text-green-600' : ($user->role === 'animal_health_professional' ? 'text-blue-600' : 'text-purple-600') }}">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-600">{{ $user->email }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs px-2 py-1 rounded-full {{ $user->role === 'farmer' ? 'bg-green-100 text-green-800' : ($user->role === 'animal_health_professional' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                            {{ $user->role_display_name }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-center text-gray-500 py-8">No recent registrations</p>
                            @endif
                        </div>
                    </div>

                    <!-- Pending Professionals -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-purple-600">Pending Professional Applications</h2>
                            <a href="{{ route('admin.professionals.pending') }}" class="text-sm text-purple-600 hover:underline">View All</a>
                        </div>
                        <div class="p-6">
                            @if(isset($pendingProfessionals) && $pendingProfessionals->count() > 0)
                            <div class="space-y-4">
                                @foreach($pendingProfessionals as $professional)
                                <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center font-bold text-yellow-600">
                                        {{ substr($professional->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $professional->user->name }}</p>
                                        <p class="text-xs text-gray-600">{{ $professional->professional_type_text }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Submitted {{ $professional->submitted_at->diffForHumans() }}</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.professionals.review', $professional->id) }}" class="text-xs bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700">
                                            Review
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No pending applications</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

            </main>

        </div>

    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('mobile-overlay');
    const menuButton = document.getElementById('mobile-menu-button');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const menuCloseIcon = document.getElementById('menu-close-icon');

    menuButton.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        menuOpenIcon.classList.toggle('hidden');
        menuCloseIcon.classList.toggle('hidden');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        menuOpenIcon.classList.remove('hidden');
        menuCloseIcon.classList.add('hidden');
    });

    if (window.innerWidth < 768) {
        const navLinks = sidebar.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            });
        });
    }
});
</script>
</body>
</html>