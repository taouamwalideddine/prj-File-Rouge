@extends('layouts.teacher')

@section('content')
<div class="container mx-auto p-4">
    @if(!$isApproved)
        <!-- Pending Approval View -->
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 text-center">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Awaiting Approval</h2>
            <p class="text-gray-600 mb-6">Your teacher account is currently under review by our administration team.</p>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            You'll receive an email notification once your account is approved. This typically takes 1-2 business days.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900">What you can do now:</h3>
                <ul class="mt-4 space-y-3 text-left">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Review the teacher guidelines</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Prepare your course materials</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Update your profile information</span>
                    </li>
                </ul>
            </div>
        </div>
        @else
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Your Classroom: {{ $classroom->name }}</h1>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                <svg class="-ml-1 mr-1.5 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                    <circle cx="4" cy="4" r="3" />
                </svg>
                Active
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Students Count -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Students</h3>
                        <p class="text-2xl font-bold">{{ $classroom->students()->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Quizzes -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Active Quizzes</h3>
                        <p class="text-2xl font-bold">{{ $classroom->quizzes()->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Pending Requests</h3>
                        <p class="text-2xl font-bold">{{ $classroom->pendingRequests()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
            <div class="space-y-4">
                @forelse($recentActivity as $activity)
                    <div class="border-b pb-4 last:border-0">
                        <div class="flex justify-between">
                            <p class="text-gray-800">{{ $activity->description }}</p>
                            <span class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No recent activity</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('teacher.quizzes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg shadow flex items-center justify-between transition-colors">
                <span>Create New Quiz</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="{{ route('teacher.classroom.manage') }}" class="bg-green-600 hover:bg-green-700 text-white p-4 rounded-lg shadow flex items-center justify-between transition-colors">
                <span>Manage Classroom</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                </svg>
            </a>
        </div>
    @endif
</div>
@endsection
