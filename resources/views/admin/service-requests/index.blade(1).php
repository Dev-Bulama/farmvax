<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests - FarmVax Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    @include('admin.partials.sidebar')

    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <h1 class="text-2xl font-bold text-orange-600">Service Requests</h1>
                <p class="text-sm text-gray-600">Farmer service requests</p>
            </div>
        </header>

        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600">Total Requests</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_requests'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_requests'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600">Completed</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['completed_requests'] ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Farmer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Urgency</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($serviceRequests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium">{{ $request->farmer_name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $request->farmer_email ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ ucfirst($request->service_type ?? 'N/A') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ Str::limit($request->description ?? 'N/A', 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $urgency = $request->urgency_level ?? 'low';
                                        $colors = ['low' => 'bg-green-100 text-green-800', 'medium' => 'bg-yellow-100 text-yellow-800', 'high' => 'bg-orange-100 text-orange-800', 'emergency' => 'bg-red-100 text-red-800'];
                                    @endphp
                                    <span class="px-2 text-xs font-semibold rounded-full {{ $colors[$urgency] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($urgency) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $request->status ?? 'pending';
                                        $statusColors = ['pending' => 'bg-yellow-100 text-yellow-800', 'in_progress' => 'bg-blue-100 text-blue-800', 'completed' => 'bg-green-100 text-green-800', 'cancelled' => 'bg-gray-100 text-gray-800'];
                                    @endphp
                                    <span class="px-2 text-xs font-semibold rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($request->created_at)->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-sm text-gray-500">No service requests</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($serviceRequests->hasPages())
                <div class="px-4 py-3 border-t">{{ $serviceRequests->links() }}</div>
                @endif
            </div>
        </main>
    </div>
</div>

</body>
</html>