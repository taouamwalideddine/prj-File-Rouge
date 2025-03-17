<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4361ee, #3730a3);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .card-overlay {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .quiz-card:hover .card-overlay {
            opacity: 1;
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .notification-badge {
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <nav class="gradient-bg text-white p-4 sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold">QuizHub</h1>
            </div>
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <span class="font-medium">Teacher Name</span>
                    <div class="w-8 h-8 rounded-full bg-indigo-300 flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold text-white">T</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <div class="w-64 bg-white shadow-lg min-h-screen pt-4 border-r border-gray-200">
            <div class="px-4 py-2">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>My Classes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Create Quiz</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>Quiz Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Student Requests</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span>Notifications</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Teacher Dashboard</h2>
                <button class="gradient-bg hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow-lg transform transition-transform hover:scale-105 pulse">Create New Class</button>
            </div>
<div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Student Join Requests</h3>
                <div class="space-y-3">
                    <div class="bg-indigo-50 p-4 rounded-md flex items-center justify-between">
                        <p class="text-gray-800">John Smith requested to join "Mathematics 101"</p>
                        <div class="flex space-x-2">
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded">Accept</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">Decline</button>
                        </div>
                    </div>
                    <div class="bg-indigo-50 p-4 rounded-md flex items-center justify-between">
                        <p class="text-gray-800">Sarah Johnson requested to join "History Fundamentals"</p>
                        <div class="flex space-x-2">
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded">Accept</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">Decline</button>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-6">My Classes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow hover-lift transition-transform p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Mathematics 101</h4>
                    <div class="text-gray-600 mb-1">Students: 32</div>
                    <div class="text-gray-600 mb-1">Active Quizzes: 3</div>
                    <div class="text-gray-600 mb-4">Average Score: 78%</div>
                    <div class="flex space-x-3">
                        <button class="gradient-bg hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-lg transform transition-transform hover:scale-105">View Class</button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md shadow-lg transform transition-transform hover:scale-105">Add Quiz</button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow hover-lift transition-transform p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">History Fundamentals</h4>
                    <div class="text-gray-600 mb-1">Students: 28</div>
                    <div class="text-gray-600 mb-1">Active Quizzes: 2</div>
                    <div class="text-gray-600 mb-4">Average Score: 82%</div>
                    <div class="flex space-x-3">
                        <button class="gradient-bg hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-lg transform transition-transform hover:scale-105">View Class</button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md shadow-lg transform transition-transform hover:scale-105">Add Quiz</button>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-6">Recent Quiz Activities</h3>
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-indigo-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Quiz Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Class</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Participants</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Avg. Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-indigo-100">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">Algebra Basics</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mathematics 101</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mar 15, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">28/32</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">76%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">Trigonometry Practice</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mathematics 101</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mar 10, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">30/32</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">82%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">World War I</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">History Fundamentals</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mar 8, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">25/28</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">79%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">Renaissance Period</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">History Fundamentals</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mar 5, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">26/28</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">85%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="mt-12 py-6 border-t border-indigo-100">
                <div class="text-center text-gray-600 text-sm">
                    <p>© 2025 QuizHub. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
