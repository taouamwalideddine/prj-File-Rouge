@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium mb-2">Total Users</h3>
            <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium mb-2">Pending Teachers</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_teachers'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium mb-2">Active Quizzes</h3>
            <p class="text-3xl font-bold">{{ $stats['active_quizzes'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
        <div class="space-y-4">
            @foreach($recentActivity as $activity)
                <div class="border-b pb-2 last:border-0">
                    <p class="text-gray-800">{{ $activity->description }}</p>
                    <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.users') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Manage Users
            </a>
            <a href="{{ route('admin.teachers.pending') }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                Review Teacher Requests
            </a>
            <a href="{{ route('admin.quizzes') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Manage Quizzes
            </a>
        </div>
    </div>
</div>
@endsection
