@extends('layouts.student')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Quiz Result Header -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $result->quiz->title }}</h1>
                        <p class="text-gray-600 mt-1">Completed: {{ $result->completed_at->format('M j, Y g:i A') }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="text-4xl font-bold
                            @if($result->score_percentage >= 70) text-green-600
                            @elseif($result->score_percentage >= 50) text-yellow-600
                            @else text-red-600 @endif">
                            {{ $result->score_percentage }}%
                        </div>
                        <p class="text-gray-500 text-right">Score</p>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-4 mb-6">
                    <div class="h-4 rounded-full
                        @if($result->score_percentage >= 70) bg-green-500
                        @elseif($result->score_percentage >= 50) bg-yellow-500
                        @else bg-red-500 @endif"
                        style="width: {{ $result->score_percentage }}%">
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-blue-600">Correct Answers</p>
                        <p class="text-2xl font-bold">{{ $result->correct_answers_count }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Total Questions</p>
                        <p class="text-2xl font-bold">{{ $result->total_questions }}</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-sm text-purple-600">Points Earned</p>
                        <p class="text-2xl font-bold">{{ $result->score }}/{{ $result->total_points }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Breakdown -->
        <div class="space-y-6">
            @foreach($result->quiz->questions as $index => $question)
                @php
                    $userAnswer = $result->answer_details[$question->id] ?? null;
                    $isCorrect = $userAnswer['is_correct'] ?? false;
                    $userAnswerContent = $userAnswer['content'] ?? 'No answer provided';
                    $correctAnswer = $question->answers->where('is_correct', true)->first();
                @endphp

                <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4
                    @if($isCorrect) border-green-500
                    @else border-red-500 @endif">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    @if($isCorrect)
                                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @else
                                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800">
                                        Question {{ $index + 1 }}: {{ $question->content }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Points: {{ $question->points }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($isCorrect) bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                @if($isCorrect) +{{ $question->points }} pts
                                @else 0 pts @endif
                            </span>
                        </div>

                        <!-- User's Answer -->
                        <div class="mt-4 pl-10">
                            <p class="text-sm font-medium text-gray-700">Your answer:</p>
                            <div class="mt-1 p-3 rounded-lg
                                @if($isCorrect) bg-green-50 border border-green-200
                                @else bg-red-50 border border-red-200 @endif">
                                <p>{{ $userAnswerContent }}</p>
                            </div>
                        </div>

                        <!-- Correct Answer (if wrong) -->
                        @if(!$isCorrect && $correctAnswer)
                            <div class="mt-4 pl-10">
                                <p class="text-sm font-medium text-gray-700">Correct answer:</p>
                                <div class="mt-1 p-3 rounded-lg bg-green-50 border border-green-200">
                                    <p>{{ $correctAnswer->content }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Actions -->
        <div class="mt-8 flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('student.dashboard') }}"
               class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-center">
                Back to Dashboard
            </a>
            <a href="{{ route('student.classrooms.show', $result->quiz->classroom) }}"
               class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center">
                Return to Class
            </a>
        </div>
    </div>
</div>
@endsection
