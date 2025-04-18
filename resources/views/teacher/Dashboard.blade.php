@extends('layouts.teacher')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- classroom card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Your Classroom</h3>
        <p class="text-2xl font-bold text-indigo-600">{{ $classroom->name }}</p>
        <p class="mt-2">{{ $studentCount }} students</p>
        <a href="{{ route('teacher.classroom') }}" class="text-indigo-600 hover:underline mt-2 block">Manage Classroom</a>
    </div>

    <!-- pending requests -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Pending Requests</h3>
        <p class="text-2xl font-bold text-indigo-600">{{ $pendingRequests }}</p>
        <a href="{{ route('teacher.requests') }}" class="text-indigo-600 hover:underline mt-2 block">View Requests</a>
    </div>

    <!-- quiz cards -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Active Quizzes</h3>
        <p class="text-2xl font-bold text-indigo-600">{{ $quizzes->count() }}</p>
        <a href="{{ route('teacher.quizzes') }}" class="text-indigo-600 hover:underline mt-2 block">Manage Quizzes</a>
    </div>
</div>

<div class="mt-8 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Recent Quizzes</h2>
    @forelse($recentQuizzes as $quiz)
        <div class="border-b py-3">
            <h3 class="font-medium">{{ $quiz->title }}</h3>
            <p class="text-sm text-gray-500">{{ $quiz->created_at->diffForHumans() }}</p>
            <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="text-indigo-600 text-sm hover:underline">View Quiz</a>
        </div>
    @empty
        <p class="text-gray-500">No quizzes created yet</p>
    @endforelse
    <div class="mt-4">
        <a href="{{ route('teacher.quizzes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Create New Quiz
        </a>
    </div>
</div>
@endsection
