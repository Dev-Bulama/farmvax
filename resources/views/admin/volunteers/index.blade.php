<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers - FarmVax Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#11455B',
                        secondary: '#2FCB6E',
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
                <div class="w-10 h-10 bg-gradient-to-br from-secondary to-primary rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
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
                <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center">
                    <span class="text-white text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-300">Administrator</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.professionals.pending') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pending Approvals
            </a>
            <a href="{{ route('admin.farmers') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Farmers
            </a>
            <a href="{{ route('admin.professionals.index') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Professionals
            </a>
            <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-3 py-3 text-sm font-semibold text-white bg-secondary/20 rounded-lg border-l-4 border-secondary">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Volunteers
            </a>
            <a href="{{ route('admin.service-requests.index') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Service Requests
            </a>
            <a href="{{ route('admin.farm-records.index') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Farm Records
            </a>
            <a href="{{ route('admin.statistics') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Statistics
            </a>
        </nav>

        <div class="px-3 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
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
                            <h1 class="text-2xl font-black text-primary">Volunteers</h1>
                            <p class="text-sm text-gray-600 hidden sm:block">Community volunteers</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">

            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-xl bg-secondary p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-semibold text-gray-600">Total Volunteers</p>
                        <p class="text-3xl font-black text-secondary">{{ $volunteers->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase hidden md:table-cell">Contact</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase hidden lg:table-cell">Organization</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase hidden xl:table-cell">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($volunteers as $volunteer)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-secondary/10 rounded-full flex items-center justify-center">
                                            <span class="text-secondary font-black text-lg">{{ substr($volunteer->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $volunteer->user->name }}</div>
                                            <div class="text-sm text-gray-600">{{ $volunteer->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm hidden md:table-cell">{{ $volunteer->user->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm hidden lg:table-cell">{{ $volunteer->organization ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $volunteer->status === 'active' ? 'bg-secondary/10 text-secondary' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($volunteer->status ?? 'active') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm hidden xl:table-cell">{{ $volunteer->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="mt-2 text-sm font-medium text-gray-500">No volunteers registered</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($volunteers->hasPages())
                <div class="px-4 py-3 border-t">{{ $volunteers->links() }}</div>
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