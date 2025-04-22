@extends('layouts.student')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-indigo-600 rounded-xl shadow-md text-white p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="mt-2">Check your active quizzes and class updates</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('student.classrooms') }}"
                   class="inline-block bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100">
                    View All Classes
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">Active Quizzes</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($availableQuizzes as $quiz)
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium">{{ $quiz->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $quiz->classroom->name }}
                                @if($quiz->expires_at)
                                    • Expires: {{ $quiz->expires_at->format('M d, Y') }}
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('student.quizzes.take', $quiz) }}"
                           class="text-white bg-indigo-600 px-3 py-1 rounded text-sm hover:bg-indigo-700">
                            Start
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 col-span-2">No active quizzes available</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Results & Classes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-6">Recent Results</h2>

                <div class="space-y-4">
                    @forelse($recentResults as $result)
                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium">{{ $result->quiz->title }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Completed: {{ $result->completed_at->format('M d, Y') }}
                                </p>
                            </div>
                            <div class="flex items-center">
                                <span class="text-lg font-bold
                                    @if($result->score_percentage >= 70) text-green-600
                                    @elseif($result->score_percentage >= 50) text-amber-600
                                    @else text-red-600 @endif">
                                    {{ $result->score_percentage }}%
                                </span>
                                <a href="{{ route('student.quiz.results', $result) }}"
                                   class="ml-2 text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">No quiz results yet</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- your Classes -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-6">Your Classes</h2>

                <div class="space-y-4">
                    @forelse($joinedClassrooms as $classroom)
                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium">{{ $classroom->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Teacher: {{ $classroom->teacher->name }}
                                </p>
                            </div>
                            <a href="{{ route('student.classrooms.show', $classroom) }}"
                               class="text-indigo-600 hover:text-indigo-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">You haven't joined any classes yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
