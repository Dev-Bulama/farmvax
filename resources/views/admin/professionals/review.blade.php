<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Professional - FarmVax Admin</title>
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
    
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>

    <!-- Sidebar (Same as Pending Approvals) -->
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
            <a href="{{ route('admin.professionals.pending') }}" class="flex items-center px-3 py-3 text-sm font-semibold text-white bg-secondary/20 rounded-lg border-l-4 border-secondary">
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
            <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-3 py-3 text-sm font-medium text-gray-200 hover:bg-white/10 rounded-lg transition">
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

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Header -->
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
                            <h1 class="text-xl sm:text-2xl font-black text-primary">Review Application</h1>
                            <p class="text-sm text-gray-600 hidden sm:block">Approve or reject professional application</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.professionals.pending') }}" class="text-sm font-semibold text-secondary hover:text-secondary/80 hidden sm:block">
                        ← Back to Pending
                    </a>
                </div>
            </div>
        </header>

        <!-- Messages -->
        @if(session('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex items-center">
                <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 flex items-center">
                <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column - Details -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- User Info Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-primary to-secondary">
                            <h2 class="text-lg font-bold text-white">Applicant Information</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 h-20 w-20 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-3xl font-black text-primary">{{ substr($professional->user->name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-black text-gray-900">{{ $professional->user->name }}</h3>
                                    <div class="mt-3 space-y-2">
                                        <p class="text-sm text-gray-600"><span class="font-semibold">Email:</span> {{ $professional->user->email }}</p>
                                        <p class="text-sm text-gray-600"><span class="font-semibold">Phone:</span> {{ $professional->user->phone ?? 'N/A' }}</p>
                                        <p class="text-sm text-gray-600"><span class="font-semibold">Address:</span> {{ $professional->user->address ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Details -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-primary">Professional Details</h2>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase">Type</dt>
                                    <dd class="mt-1"><span class="px-3 py-1 text-xs font-bold rounded-full bg-primary/10 text-primary">{{ $professional->professional_type_text }}</span></dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase">License</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900">{{ $professional->license_number ?? 'N/A' }}</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase">Organization</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900">{{ $professional->organization ?? 'N/A' }}</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase">Experience</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900">{{ $professional->experience_years ?? 0 }} years</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase">Specialization</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900">{{ $professional->specialization ?? 'N/A' }}</dd>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase">Territory</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900">{{ $professional->assigned_territory ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Application Notes -->
                    @if($professional->application_notes)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-primary">Application Notes</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $professional->application_notes }}</p>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right Column - Actions -->
                <div class="space-y-6">
                    
                    <!-- Status Card -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-bold text-primary mb-4">Status</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm text-gray-600">Current:</span>
                                <span class="ml-2 px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($professional->approval_status) }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Submitted:</span>
                                <span class="ml-2 text-sm font-bold text-gray-900">
                                    {{ $professional->submitted_at ? $professional->submitted_at->format('M d, Y') : 'N/A' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Days Pending:</span>
                                <span class="ml-2 text-sm font-bold text-gray-900">
                                    {{ $professional->submitted_at ? $professional->submitted_at->diffInDays(now()) : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Approve -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-bold text-secondary mb-3">Approve</h3>
                        <p class="text-sm text-gray-600 mb-4">Grant system access</p>
                        <form method="POST" action="{{ route('admin.professionals.approve', $professional->id) }}">
                            @csrf
                            <button type="submit" class="w-full bg-secondary text-white font-bold py-3 px-4 rounded-xl hover:bg-secondary/90 transition flex items-center justify-center">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Approve
                            </button>
                        </form>
                    </div>

                    <!-- Reject -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-bold text-red-600 mb-3">Reject</h3>
                        <form method="POST" action="{{ route('admin.professionals.reject', $professional->id) }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Reason <span class="text-red-500">*</span></label>
                                <textarea name="rejection_reason" rows="4" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500"
                                    placeholder="Provide reason..."></textarea>
                            </div>
                            <button type="submit" onclick="return confirm('Reject this application?')" class="w-full bg-red-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-red-700 transition flex items-center justify-center">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Reject
                            </button>
                        </form>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-bold text-primary mb-4">Contact</h3>
                        <div class="space-y-2">
                            <a href="mailto:{{ $professional->user->email }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition">
                                Email
                            </a>
                            @if($professional->user->phone)
                            <a href="tel:{{ $professional->user->phone }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition">
                                Call
                            </a>
                            @endif
                        </div>
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
    });
</script>

</body>
</html>