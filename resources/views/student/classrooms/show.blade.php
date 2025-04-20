@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $classroom->name }}</h1>
        <p class="text-gray-600">Teacher: {{ $classroom->teacher->name }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-4">Available Quizzes</h2>

    @forelse($quizzes as $quiz)
        <div class="bg-white rounded-lg shadow p-6 mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-lg">{{ $quiz->title }}</h3>
                    <p class="text-gray-600">{{ $quiz->questions_count }} questions</p>
                    @if($quiz->expires_at)
                        <p class="text-sm text-gray-500">
                            Expires: {{ $quiz->expires_at->format('M j, Y g:i A') }}
                        </p>
                    @endif
                </div>
                <a href="{{ route('student.quizzes.take', $quiz) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Take Quiz
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No quizzes available in this class yet.</p>
    @endforelse
</div>
@endsection
