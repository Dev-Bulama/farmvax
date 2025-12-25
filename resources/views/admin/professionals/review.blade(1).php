<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Professional - FarmVax Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-purple-600">Review Professional Application</h1>
                        <p class="text-sm text-gray-600">Review and approve/reject application</p>
                    </div>
                    <a href="{{ route('admin.professionals.pending') }}" class="text-sm text-purple-600 hover:underline">
                        ← Back to Pending Applications
                    </a>
                </div>
            </div>
        </header>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mx-4 sm:mx-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-md p-4">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mx-4 sm:mx-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-md p-4">
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="px-4 sm:px-6 lg:px-8 py-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Professional Details -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- User Information Card -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-900">Applicant Information</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-2xl font-bold text-blue-600">
                                        {{ substr($professional->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $professional->user->name }}</h3>
                                    <div class="mt-2 space-y-1">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Email:</span> {{ $professional->user->email }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Phone:</span> {{ $professional->user->phone ?? 'N/A' }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Address:</span> {{ $professional->user->address ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Details Card -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-900">Professional Details</h2>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Professional Type</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $professional->professional_type_text }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">License Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->license_number ?? 'N/A' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Organization</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->organization ?? 'N/A' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Experience</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->experience_years ?? 0 }} years</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Specialization</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->specialization ?? 'N/A' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Assigned Territory</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->assigned_territory ?? 'N/A' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Contact Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->contact_phone ?? 'N/A' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Contact Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $professional->contact_email ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Application Notes Card -->
                    @if($professional->application_notes)
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-900">Application Notes</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $professional->application_notes }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Verification Documents Card -->
                    @if($professional->verification_documents)
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-900">Verification Documents</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-2">
                                @php
                                    $docs = is_string($professional->verification_documents) 
                                        ? json_decode($professional->verification_documents, true) 
                                        : $professional->verification_documents;
                                @endphp
                                
                                @if(is_array($docs) && count($docs) > 0)
                                    @foreach($docs as $doc)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm text-gray-700">{{ is_string($doc) ? $doc : ($doc['name'] ?? 'Document') }}</span>
                                        </div>
                                        @if(is_array($doc) && isset($doc['path']))
                                        <a href="{{ asset('storage/' . $doc['path']) }}" target="_blank" class="text-purple-600 hover:text-purple-700 text-sm">
                                            View
                                        </a>
                                        @endif
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500">No documents uploaded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right Column - Actions -->
                <div class="space-y-6">
                    
                    <!-- Status Card -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Application Status</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm text-gray-600">Current Status:</span>
                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full {{ $professional->status_badge_class }}">
                                    {{ ucfirst($professional->approval_status) }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Submitted:</span>
                                <span class="ml-2 text-sm text-gray-900">
                                    {{ $professional->submitted_at ? $professional->submitted_at->format('M d, Y') : 'N/A' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Days Pending:</span>
                                <span class="ml-2 text-sm text-gray-900">
                                    {{ $professional->submitted_at ? $professional->submitted_at->diffInDays(now()) : 'N/A' }} days
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Approve Action -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-green-600 mb-4">Approve Application</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Approving this application will grant the professional access to the system.
                        </p>
                        <form method="POST" action="{{ route('admin.professionals.approve', $professional->id) }}">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition">
                                <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Approve Application
                            </button>
                        </form>
                    </div>

                    <!-- Reject Action -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-red-600 mb-4">Reject Application</h3>
                        <form method="POST" action="{{ route('admin.professionals.reject', $professional->id) }}" id="rejectForm">
                            @csrf
                            <div class="mb-4">
                                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                    Reason for Rejection <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    id="rejection_reason" 
                                    name="rejection_reason" 
                                    rows="4" 
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                    placeholder="Please provide a detailed reason for rejection..."
                                ></textarea>
                                <p class="mt-1 text-xs text-gray-500">This will be sent to the applicant.</p>
                            </div>
                            <button type="submit" onclick="return confirm('Are you sure you want to reject this application? This action cannot be undone.')" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition">
                                <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Reject Application
                            </button>
                        </form>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="mailto:{{ $professional->user->email }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md transition">
                                <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Applicant
                            </a>
                            @if($professional->user->phone)
                            <a href="tel:{{ $professional->user->phone }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md transition">
                                <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Call Applicant
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
// Form validation
document.getElementById('rejectForm').addEventListener('submit', function(e) {
    const reason = document.getElementById('rejection_reason').value.trim();
    if (reason.length < 10) {
        e.preventDefault();
        alert('Please provide a detailed reason (at least 10 characters) for rejection.');
        return false;
    }
});
</script>

</body>
</html>