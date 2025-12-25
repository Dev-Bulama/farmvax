<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers - FarmVax Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    @include('admin.partials.sidebar')

    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <h1 class="text-2xl font-bold text-indigo-600">Volunteers</h1>
                <p class="text-sm text-gray-600">Community volunteers</p>
            </div>
        </header>

        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-indigo-600 p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Volunteers</p>
                        <p class="text-2xl font-bold text-indigo-600">{{ $volunteers->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organization</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($volunteers as $volunteer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <span class="text-indigo-600 font-bold">{{ substr($volunteer->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium">{{ $volunteer->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $volunteer->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $volunteer->user->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $volunteer->organization ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 text-xs font-semibold rounded-full {{ $volunteer->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($volunteer->status ?? 'active') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $volunteer->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <p class="text-sm text-gray-500">No volunteers registered</p>
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

</body>
</html>