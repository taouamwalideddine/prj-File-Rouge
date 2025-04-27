@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Pending Teachers</h3>
            <p class="text-2xl">{{ $pendingTeachers }}</p>
            <a href="{{ route('admin.teachers.pending') }}" class="text-blue-600 text-sm">View All</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Banned Users</h3>
            <p class="text-2xl">{{ $bannedUsers }}</p>
            <a href="{{ route('admin.users') }}" class="text-blue-600 text-sm">View All</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Total Quizzes</h3>
            <p class="text-2xl">{{ $quizzesCount }}</p>
            <a href="{{ route('admin.quizzes') }}" class="text-blue-600 text-sm">Manage</a>
        </div>
    </div>
</div>
@endsection
