@extends('layouts.teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Your Quizzes</h2>
        <a href="{{ route('teacher.quizzes.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Create New Quiz
        </a>
    </div>

    @if($quizzes->isEmpty())
        <p class="text-gray-500">No quizzes created yet.</p>
    @else
        <div class="space-y-4">
            @foreach($quizzes as $quiz)
                <div class="border rounded-lg p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-medium">{{ $quiz->title }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $quiz->questions->count() }} questions |
                                {{ $quiz->classroom->name }}
                                @if($quiz->expires_at)
                                    | Expires: {{ $quiz->expires_at->format('M d, Y H:i') }}
                                @endif
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('teacher.quizzes.show', $quiz) }}"
                               class="text-indigo-600 hover:underline">
                                View
                            </a>
                            <form action="{{ route('teacher.quizzes.delete', $quiz) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this quiz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $quizzes->links() }}
        </div>
    @endif
</div>
@endsection
