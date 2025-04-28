@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500">Students</p>
                    <h3 class="text-2xl font-bold">{{ $classroom->acceptedStudents()->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500">Active Quizzes</p>
                    <h3 class="text-2xl font-bold">{{ $classroom->quizzes()->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500">Pending Requests</p>
                    <h3 class="text-2xl font-bold">{{ $classroom->pendingRequests()->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden lg:col-span-2">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Recent Quizzes</h2>
                    <a href="{{ route('teacher.quizzes') }}" class="text-indigo-600 hover:text-indigo-800">View All</a>
                </div>

                <div class="space-y-4">
                    @forelse($recentQuizzes as $quiz)
                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium">{{ $quiz->title }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Created: {{ $quiz->created_at->format('M d, Y') }}
                                    @if($quiz->expires_at)
                                        • Expires: {{ $quiz->expires_at->format('M d, Y') }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('teacher.quizzes.show', $quiz) }}"
                                   class="text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">No quizzes created yet</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-6">Quick Actions</h2>

                <div class="space-y-4">
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="flex items-center p-3 border rounded-lg hover:bg-indigo-50 transition-colors">
                        <div class="p-2 rounded-full bg-indigo-100 text-indigo-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span>Create New Quiz</span>
                    </a>

                    <a href="{{ route('teacher.classroom') }}"
                       class="flex items-center p-3 border rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <span>Manage Classroom</span>
                    </a>

                    <a href="{{ route('teacher.requests') }}"
                       class="flex items-center p-3 border rounded-lg hover:bg-amber-50 transition-colors">
                        <div class="p-2 rounded-full bg-amber-100 text-amber-600 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span>View Join Requests</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
