<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccinations - FarmVax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2FCB6E',
                        secondary: '#058283',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen overflow-hidden">
    
    <div id="mobile-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>

    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 md:z-auto w-64 bg-primary flex flex-col">
        
        <div class="flex items-center justify-between h-16 px-4 bg-primary/90">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-gradient-to-br from-white/20 to-secondary rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <span class="text-white text-lg font-bold">FarmVax</span>
            </div>
            <button id="close-sidebar" class="md:hidden text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-4 py-3 bg-primary/80">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                    <span class="text-primary text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-white/80">Farmer</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('individual.dashboard') }}" class="flex items-center px-3 py-3 text-sm font-medium text-white/90 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('individual.livestock.index') }}" class="flex items-center px-3 py-3 text-sm font-medium text-white/90 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                My Livestock
            </a>
            <a href="{{ route('individual.vaccinations.index') }}" class="flex items-center px-3 py-3 text-sm font-semibold text-white bg-white/20 rounded-lg border-l-4 border-white">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Vaccinations
            </a>
            <a href="{{ route('individual.service-requests.index') }}" class="flex items-center px-3 py-3 text-sm font-medium text-white/90 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Service Requests
            </a>
            <a href="{{ route('individual.farm-records.create') }}" class="flex items-center px-3 py-3 text-sm font-medium text-white/90 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Farm Records
            </a>
            <a href="{{ route('individual.profile') }}" class="flex items-center px-3 py-3 text-sm font-medium text-white/90 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                My Profile
            </a>
        </nav>

        <div class="px-3 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-3 py-3 text-sm font-medium text-white/90 hover:bg-white/10 rounded-lg transition">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="bg-white shadow-sm z-10">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg text-primary hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-2xl font-black text-primary">Vaccination History</h1>
                            <p class="text-sm text-gray-600 hidden sm:block">Track vaccinations and upcoming schedules</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-semibold text-gray-600">Total Vaccinations</p>
                        <div class="p-2 bg-primary/10 rounded-lg">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-black text-primary">{{ $stats['total_vaccinations'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-semibold text-gray-600">Up to Date</p>
                        <div class="p-2 bg-secondary/10 rounded-lg">
                            <svg class="h-5 w-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-black text-secondary">{{ $stats['up_to_date'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-semibold text-gray-600">Due Soon</p>
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-black text-yellow-600">{{ $stats['due_soon'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-semibold text-gray-600">Overdue</p>
                        <div class="p-2 bg-red-100 rounded-lg">
                            <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-black text-red-600">{{ $stats['overdue'] ?? 0 }}</p>
                </div>
            </div>

            <!-- Vaccinations List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                @if(isset($vaccinations) && $vaccinations->count() > 0)
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Animal</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Vaccine</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Date Given</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Next Due</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Administered By</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($vaccinations as $vaccination)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center">
                                                <span class="text-primary font-black text-sm">{{ strtoupper(substr($vaccination->livestock->type ?? 'L', 0, 2)) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-bold text-gray-900">{{ $vaccination->livestock->tag_number ?? 'Unknown' }}</p>
                                                <p class="text-xs text-gray-500">{{ ucfirst($vaccination->livestock->type ?? 'Livestock') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-gray-900">{{ $vaccination->vaccine_name }}</p>
                                        <p class="text-xs text-gray-500">Batch: {{ $vaccination->batch_number ?? 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $vaccination->date_administered ? \Carbon\Carbon::parse($vaccination->date_administered)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $vaccination->next_due_date ? \Carbon\Carbon::parse($vaccination->next_due_date)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $vaccination->administered_by ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $nextDue = $vaccination->next_due_date ? \Carbon\Carbon::parse($vaccination->next_due_date) : null;
                                            $status = 'completed';
                                            $statusColor = 'bg-primary/10 text-primary';
                                            
                                            if ($nextDue) {
                                                if ($nextDue->isPast()) {
                                                    $status = 'overdue';
                                                    $statusColor = 'bg-red-100 text-red-800';
                                                } elseif ($nextDue->diffInDays(now()) <= 30) {
                                                    $status = 'due soon';
                                                    $statusColor = 'bg-yellow-100 text-yellow-800';
                                                }
                                            }
                                        @endphp
                                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusColor }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden p-4 space-y-4">
                        @foreach($vaccinations as $vaccination)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center flex-1">
                                    <div class="h-12 w-12 bg-primary/10 rounded-full flex items-center justify-center">
                                        <span class="text-primary font-black text-sm">{{ strtoupper(substr($vaccination->livestock->type ?? 'L', 0, 2)) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-bold text-gray-900">{{ $vaccination->livestock->tag_number ?? 'Unknown' }}</p>
                                        <p class="text-xs text-gray-500">{{ $vaccination->vaccine_name }}</p>
                                    </div>
                                </div>
                                @php
                                    $nextDue = $vaccination->next_due_date ? \Carbon\Carbon::parse($vaccination->next_due_date) : null;
                                    $status = 'completed';
                                    $statusColor = 'bg-primary/10 text-primary';
                                    
                                    if ($nextDue) {
                                        if ($nextDue->isPast()) {
                                            $status = 'overdue';
                                            $statusColor = 'bg-red-100 text-red-800';
                                        } elseif ($nextDue->diffInDays(now()) <= 30) {
                                            $status = 'due soon';
                                            $statusColor = 'bg-yellow-100 text-yellow-800';
                                        }
                                    }
                                @endphp
                                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusColor }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </div>
                            <div class="space-y-2 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Given:</span>
                                    <span class="font-semibold text-gray-900">{{ $vaccination->date_administered ? \Carbon\Carbon::parse($vaccination->date_administered)->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                @if($vaccination->next_due_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Next Due:</span>
                                    <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($vaccination->next_due_date)->format('M d, Y') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($vaccinations->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $vaccinations->links() }}
                    </div>
                    @endif

                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-bold text-gray-900">No vaccination records</h3>
                        <p class="mt-1 text-sm text-gray-500">Your vaccination history will appear here once you add livestock and schedule services.</p>
                        <div class="mt-6">
                            <a href="{{ route('individual.service-requests.create') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary/90 transition">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Request Vaccination Service
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </main>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const menuButton = document.getElementById('mobile-menu-button');
        const closeButton = document.getElementById('close-sidebar');

        menuButton.addEventListener('click', function() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        closeButton.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        if (window.innerWidth < 768) {
            const navLinks = sidebar.querySelectorAll('a');
            navLinks.forEach(link => link.addEventListener('click', closeSidebar));
        }
    });
</script>

</body>
</html>