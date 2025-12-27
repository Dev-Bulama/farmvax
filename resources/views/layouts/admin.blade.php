<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'FarmVax') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out lg:translate-x-0">

        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-6 bg-gray-800">
            <div class="flex items-center">
                <i class="fas fa-heartbeat text-green-500 text-2xl mr-2"></i>
                <span class="text-xl font-bold">FarmVax</span>
            </div>
            <button @click="sidebarOpen = false" class="lg:hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 px-4">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-green-600' : 'hover:bg-gray-800' }}">
                <i class="fas fa-dashboard mr-3"></i>
                <span>Dashboard</span>
            </a>

            <!-- User Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 mb-2 rounded-lg hover:bg-gray-800">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        <span>Users</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 space-y-1">
                    <a href="{{ route('admin.users.index', ['role' => 'farmer']) }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/users*') && request('role') == 'farmer' ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-tractor mr-2 text-sm"></i> Farmers
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'animal_health_professional']) }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/users*') && request('role') == 'animal_health_professional' ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-user-md mr-2 text-sm"></i> Professionals
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'volunteer']) }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/users*') && request('role') == 'volunteer' ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-hands-helping mr-2 text-sm"></i> Volunteers
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/users*') && request('role') == 'admin' ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-user-shield mr-2 text-sm"></i> Admins
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.ads.index') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.ads.*') ? 'bg-green-600' : 'hover:bg-gray-800' }}">
                <i class="fas fa-bullhorn mr-3"></i>
                <span>Advertisements</span>
            </a>

            <a href="{{ route('admin.outbreak-alerts.index') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.outbreak-alerts.*') ? 'bg-green-600' : 'hover:bg-gray-800' }}">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <span>Outbreak Alerts</span>
            </a>

            <a href="{{ route('admin.bulk-messages.index') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.bulk-messages.*') ? 'bg-green-600' : 'hover:bg-gray-800' }}">
                <i class="fas fa-envelope-open-text mr-3"></i>
                <span>Bulk Messaging</span>
            </a>

            <a href="{{ url('/chat/conversations') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->is('chat*') ? 'bg-green-600' : 'hover:bg-gray-800' }}">
                <i class="fas fa-comments mr-3"></i>
                <span>Live Chat</span>
            </a>

            <!-- Settings -->
            <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 mb-2 rounded-lg hover:bg-gray-800">
                    <div class="flex items-center">
                        <i class="fas fa-cog mr-3"></i>
                        <span>Settings</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 space-y-1">
                    <a href="{{ route('admin.settings.index') }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/settings') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-sliders-h mr-2 text-sm"></i> General
                    </a>
                    <a href="{{ route('admin.settings.email') }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/settings/email') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-envelope mr-2 text-sm"></i> Email
                    </a>
                    <a href="{{ route('admin.settings.sms') }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/settings/sms') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-sms mr-2 text-sm"></i> SMS
                    </a>
                    <a href="{{ route('admin.settings.ai') }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/settings/ai') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-robot mr-2 text-sm"></i> AI Chatbot
                    </a>
                    <a href="{{ route('admin.settings.professional-types') }}"
                       class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/settings/professional-types') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-briefcase mr-2 text-sm"></i> Professional Types
                    </a>
                </div>
            </div>
        </nav>

        <!-- User Menu -->
        <div class="absolute bottom-0 w-64 p-4 bg-gray-800">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center w-full text-left">
                    <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center mr-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-400">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                    <i class="fas fa-chevron-up"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                     class="absolute bottom-full left-0 w-full mb-2 bg-gray-700 rounded-lg shadow-lg">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-t-lg">
                        <i class="fas fa-user-edit mr-2"></i> Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-600 rounded-b-lg">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:pl-64">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6">
            <button @click="sidebarOpen = true" class="lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>

            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-800">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50">
                        <div class="p-4 border-b">
                            <h3 class="font-semibold">Notifications</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <div class="p-4 text-center text-gray-500">
                                No new notifications
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <a href="{{ url('/chat/conversations') }}" class="p-2 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-envelope text-xl"></i>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
