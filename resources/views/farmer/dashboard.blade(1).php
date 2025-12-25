<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    @include('farmer.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-green-600">Farmer Dashboard</h1>
                        <p class="text-sm text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ now()->format('l, F j, Y') }}</p>
                        <p class="text-xs text-gray-400">{{ now()->format('g:i A') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-green-600 text-white hover:bg-green-700">
                <svg id="menu-open-icon" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-close-icon" class="h-6 w-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </header>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-md p-4">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Total Livestock -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-green-600 p-3">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">My Livestock</p>
                            <p class="text-2xl font-bold text-green-600">{{ $stats['total_livestock'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Healthy Animals -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-teal-600 p-3">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Healthy</p>
                            <p class="text-2xl font-bold text-teal-600">{{ $stats['healthy_livestock'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Vaccinations Due -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-yellow-500 p-3">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Vaccinations Due</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $stats['vaccinations_due'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Service Requests -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-blue-600 p-3">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Requests</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $stats['pending_requests'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('individual.livestock.create') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-green-100 p-3">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Add New Livestock</h3>
                                <p class="text-xs text-gray-500">Register a new animal</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('individual.service-requests.create') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-blue-100 p-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Request Service</h3>
                                <p class="text-xs text-gray-500">Vaccination, treatment, etc.</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('individual.farm-records.step1') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 rounded-md bg-purple-100 p-3">
                                <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Submit Farm Record</h3>
                                <p class="text-xs text-gray-500">Update farm information</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Recent Livestock -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-green-600">Recent Livestock</h2>
                        <a href="{{ route('individual.livestock.index') }}" class="text-sm text-green-600 hover:underline">View All</a>
                    </div>
                    <div class="p-6">
                        @if(isset($recentLivestock) && $recentLivestock->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentLivestock as $animal)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <span class="text-green-600 font-bold text-xs">{{ strtoupper(substr($animal->type, 0, 2)) }}</span>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $animal->tag_number ?? 'No Tag' }}</p>
                                    <p class="text-xs text-gray-600">{{ ucfirst($animal->type) }} - {{ ucfirst($animal->breed ?? 'Unknown') }}</p>
                                </div>
                                <div>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $animal->health_status === 'healthy' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($animal->health_status ?? 'Unknown') }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No livestock registered yet</p>
                            <a href="{{ route('individual.livestock.create') }}" class="mt-2 inline-block text-sm text-green-600 hover:underline">Add your first animal</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Service Requests -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-green-600">Service Requests</h2>
                        <a href="{{ route('individual.service-requests.index') }}" class="text-sm text-green-600 hover:underline">View All</a>
                    </div>
                    <div class="p-6">
                        @if(isset($recentRequests) && $recentRequests->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentRequests as $request)
                            <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ ucfirst($request->service_type ?? 'Service') }}</p>
                                    <p class="text-xs text-gray-600 mt-1">{{ Str::limit($request->description ?? 'No description', 50) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $request->created_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    @php
                                        $status = $request->status ?? 'pending';
                                        $colors = ['pending' => 'bg-yellow-100 text-yellow-800', 'in_progress' => 'bg-blue-100 text-blue-800', 'completed' => 'bg-green-100 text-green-800'];
                                    @endphp
                                    <span class="px-2 py-1 text-xs rounded-full {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No service requests</p>
                            <a href="{{ route('individual.service-requests.create') }}" class="mt-2 inline-block text-sm text-green-600 hover:underline">Request a service</a>
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