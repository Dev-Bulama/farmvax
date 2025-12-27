@extends('layouts.volunteer')

@section('title', 'Volunteer Dashboard')
@section('page-title', 'Volunteer Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Farmers Enrolled</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['farmers_enrolled'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Points</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_points'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-star text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Badges Earned</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['badges'] ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-award text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Leaderboard Rank</p>
                <h3 class="text-2xl font-bold text-purple-600">#{{ $stats['rank'] ?? 'N/A' }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-trophy text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="mb-6 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-xl font-bold mb-2">Next Badge: Silver Contributor</h3>
            <p class="text-purple-100 text-sm">Enroll 5 more farmers to unlock</p>
        </div>
        <div class="text-6xl opacity-50">
            <i class="fas fa-medal"></i>
        </div>
    </div>
    <div class="mt-4">
        <div class="w-full bg-purple-900 rounded-full h-2">
            <div class="bg-yellow-400 h-2 rounded-full" style="width: 60%"></div>
        </div>
        <p class="text-xs text-purple-100 mt-1">60% Complete</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-lg font-semibold">Recently Enrolled Farmers</h3>
            <a href="{{ route('volunteer.my-farmers') }}" class="text-purple-600 hover:text-purple-800 text-sm">View All →</a>
        </div>
        <div class="p-6">
            @if(isset($recentEnrollments) && count($recentEnrollments) > 0)
                <div class="space-y-4">
                    @foreach($recentEnrollments as $enrollment)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $enrollment->farmer->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span class="text-green-600 font-semibold">+10 pts</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No enrollments yet</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Leaderboard - Top Volunteers</h3>
        </div>
        <div class="p-6">
            @if(isset($leaderboard) && count($leaderboard) > 0)
                <div class="space-y-3">
                    @foreach($leaderboard as $index => $volunteer)
                        <div class="flex items-center justify-between p-3 {{ $volunteer->id == auth()->id() ? 'bg-purple-50 border border-purple-200' : 'bg-gray-50' }} rounded">
                            <div class="flex items-center">
                                <span class="w-8 h-8 flex items-center justify-center font-bold {{ $index < 3 ? 'text-yellow-600' : 'text-gray-600' }}">
                                    #{{ $index + 1 }}
                                </span>
                                <p class="ml-3 font-semibold">{{ $volunteer->name }}</p>
                            </div>
                            <span class="text-purple-600 font-semibold">{{ $volunteer->total_points ?? 0 }} pts</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No data available</p>
            @endif
        </div>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <a href="{{ route('volunteer.enroll.farmer') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-user-plus text-purple-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">Enroll Farmer</span>
    </a>

    <a href="{{ route('volunteer.my-farmers') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-users text-blue-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">My Farmers</span>
    </a>

    <a href="{{ route('volunteer.activity') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-chart-line text-green-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">My Activity</span>
    </a>

    <a href="{{ url('/chat') }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mb-3">
            <i class="fas fa-comments text-yellow-600 text-xl"></i>
        </div>
        <span class="font-semibold text-gray-700">Messages</span>
    </a>
</div>
@endsection
