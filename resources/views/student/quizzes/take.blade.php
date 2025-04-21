@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ $quiz->title }}</h1>
            <div class="text-gray-600">
                @if($quiz->expires_at)
                    Expires: {{ $quiz->expires_at->format('M j, Y g:i A') }}
                @else
                    No expiration
                @endif
            </div>
        </div>

        <form action="{{ route('student.quizzes.submit', $quiz) }}" method="POST">
            @csrf

            <div class="space-y-8">
                @foreach($quiz->questions as $question)
                    <div class="question-card p-4 border rounded-lg">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-medium">{{ $loop->iteration }}. {{ $question->content }}</h3>
                            <span class="text-sm text-gray-500">{{ $question->points }} points</span>
                        </div>

                        <div class="space-y-2">
                            @foreach($question->answers as $answer)
                                <label class="block">
                                    <input type="radio"
                                           name="answers[{{ $question->id }}]"
                                           value="{{ $answer->id }}"
                                           class="mr-2">
                                    {{ $answer->content }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Submit Quiz
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
