<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <style>
        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .quiz-card:hover .card-overlay {
            opacity: 0.8;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(79, 70, 229, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0);
            }
        }

        .notification-badge {
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.1);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-indigo-600 text-white p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold">QuizHub</h1>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <span class="absolute -top-1 -right-1 bg-red-500 text-xs text-white rounded-full w-5 h-5 flex items-center justify-center notification-badge">2</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-indigo-200 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>

                <div class="flex items-center space-x-2">
                    <span>Student Name</span>
                    <div class="w-8 h-8 rounded-full bg-indigo-400 flex items-center justify-center">
                        <span class="text-sm font-bold">S</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <div class="w-64 bg-white shadow-md min-h-screen pt-4">
            <div class="px-4 py-2">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition-all">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Dashboard
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                My Classes
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Available Quizzes
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                My Results
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Notifications
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Student Dashboard</h2>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transform transition-transform hover:scale-105">Request to Join a Class</button>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-sm mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Notifications</h3>
                <div class="border-t border-gray-200 pt-3">
                    <div class="bg-indigo-50 p-2 rounded-md my-2 cursor-pointer hover:bg-indigo-100 transition-all">
                        <p class="text-indigo-600">You have been accepted to "Mathematics 101" class! Click to view.</p>
                    </div>
                    <div class="bg-indigo-50 p-2 rounded-md my-2 cursor-pointer hover:bg-indigo-100 transition-all">
                        <p class="text-indigo-600">New quiz "Algebra Basics" is available in your class. Click to participate.</p>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-4">My Classes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow hover-lift transition-transform p-5">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Mathematics 101</h4>
                    <div class="text-gray-500 mb-1">Teacher: Prof. Johnson</div>
                    <div class="text-gray-500 mb-1">Members: 32 students</div>
                    <div class="text-gray-500 mb-4">Available Quizzes: 3</div>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">View Class</button>
                </div>

                <div class="bg-white rounded-lg shadow hover-lift transition-transform p-5">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">History Fundamentals</h4>
                    <div class="text-gray-500 mb-1">Teacher: Dr. Smith</div>
                    <div class="text-gray-500 mb-1">Members: 28 students</div>
                    <div class="text-gray-500 mb-4">Available Quizzes: 2</div>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">View Class</button>
                </div>
            </div>

<h3 class="text-lg font-bold text-gray-800 mb-4">Available Quizzes</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow overflow-hidden hover-lift transition-transform quiz-card">
        <div class="h-36 bg-indigo-600 relative">
            <div class="absolute inset-0 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 p-4">
                <h4 class="text-lg font-bold text-white">Algebra Basics</h4>
                <p class="text-indigo-100">Mathematics 101</p>
            </div>
            <div class="card-overlay absolute inset-0 bg-indigo-800 bg-opacity-30 flex items-center justify-center">
                <span class="text-white font-bold text-xl">Preview</span>
            </div>
        </div>
        <div class="p-4">
            <div class="text-gray-500 mb-1">Questions: 10</div>
            <div class="text-gray-500 mb-4">Time Limit: 15 minutes</div>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transform transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75 quiz-btn w-full">Take Quiz</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden hover-lift transition-transform quiz-card">
        <div class="h-36 bg-red-500 relative">
            <div class="absolute inset-0 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 p-4">
                <h4 class="text-lg font-bold text-white">World War I</h4>
                <p class="text-red-100">History Fundamentals</p>
            </div>
            <div class="card-overlay absolute inset-0 bg-red-800 bg-opacity-30 flex items-center justify-center">
                <span class="text-white font-bold text-xl">Preview</span>
            </div>
        </div>
        <div class="p-4">
            <div class="text-gray-500 mb-1">Questions: 15</div>
            <div class="text-gray-500 mb-4">Time Limit: 20 minutes</div>
            <button class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-md shadow-sm transform transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 quiz-btn w-full">Take Quiz</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden hover-lift transition-transform quiz-card">
        <div class="h-36 bg-green-500 relative">
            <div class="absolute inset-0 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 p-4">
                <h4 class="text-lg font-bold text-white">Public Quiz</h4>
                <p class="text-green-100">General Knowledge</p>
            </div>
            <div class="card-overlay absolute inset-0 bg-green-800 bg-opacity-30 flex items-center justify-center">
                <span class="text-white font-bold text-xl">Preview</span>
            </div>
        </div>
        <div class="p-4">
            <div class="text-gray-500 mb-1">Questions: 20</div>
            <div class="text-gray-500 mb-4">Time Limit: 30 minutes</div>
            <button class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md shadow-sm transform transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 quiz-btn w-full">Take Quiz</button>
        </div>
    </div>
</div>

<h3 class="text-lg font-bold text-gray-800 mb-4 mt-8">Upcoming Quizzes</h3>
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quiz Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Trigonometry Basics</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mathematics 101</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">March 20, 2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25 minutes</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Upcoming</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">World War II</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">History Fundamentals</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">March 25, 2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">30 minutes</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Upcoming</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<h3 class="text-lg font-bold text-gray-800 mb-4 mt-8">Recent Results</h3>
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quiz Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Introduction to Functions</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mathematics 101</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">March 10, 2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">85%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="text-indigo-600 hover:text-indigo-900 transition-all">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Ancient Civilizations</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">History Fundamentals</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">March 8, 2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">92%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="text-indigo-600 hover:text-indigo-900 transition-all">View Details</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<footer class="mt-12 py-6 border-t border-gray-200">
    <div class="text-center text-gray-500 text-sm">
        <p>© 2025 QuizHub. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
