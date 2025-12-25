<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - FarmVax Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    @include('admin.partials.sidebar')
<!-- Mobile Overlay -->
    <div id="mobile-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>
    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <h1 class="text-2xl font-bold text-purple-600">System Statistics</h1>
                <p class="text-sm text-gray-600">Platform analytics and insights</p>
            </div>
        </header>

        <main class="px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- User Statistics -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-900 mb-4">User Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $userStats['total_users'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Farmers</p>
                        <p class="text-2xl font-bold text-green-600">{{ $userStats['total_farmers'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Professionals</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $userStats['total_professionals'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Volunteers</p>
                        <p class="text-2xl font-bold text-indigo-600">{{ $userStats['total_volunteers'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Livestock Statistics -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Livestock Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Total Livestock</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $livestockStats['total_livestock'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Cattle</p>
                        <p class="text-2xl font-bold text-brown-600">{{ $livestockStats['total_cattle'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Goats</p>
                        <p class="text-2xl font-bold text-amber-600">{{ $livestockStats['total_goats'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Sheep</p>
                        <p class="text-2xl font-bold text-slate-600">{{ $livestockStats['total_sheep'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Poultry</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $livestockStats['total_poultry'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Service Statistics -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Service Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Total Vaccinations</p>
                        <p class="text-2xl font-bold text-teal-600">{{ $serviceStats['total_vaccinations'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Pending Requests</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $serviceStats['pending_requests'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-600">Completed Requests</p>
                        <p class="text-2xl font-bold text-green-600">{{ $serviceStats['completed_requests'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Growth -->
            <div>
                <h2 class="text-lg font-bold text-gray-900 mb-4">Monthly User Growth</h2>
                <div class="bg-white rounded-lg shadow p-6">
                    @if(isset($monthlyGrowth) && count($monthlyGrowth) > 0)
                        @foreach($monthlyGrowth as $month)
                        <div class="mb-4">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $month['month'] }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ $month['users'] }} users</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ min(($month['users'] / max(array_column($monthlyGrowth, 'users'))) * 100, 100) }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500 py-4">No growth data available</p>
                    @endif
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>