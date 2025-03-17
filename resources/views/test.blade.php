<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #052659, #021024);
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
    <!-- Navbar -->
    <nav class="gradient-bg text-white p-4 sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold">QuizHub</h1>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <span class="absolute -top-1 -right-1 bg-red-500 text-xs text-white rounded-full w-5 h-5 flex items-center justify-center notification-badge">2</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-#C1EBFF transition-all cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="font-medium">Student Name</span>
                    <div class="w-8 h-8 rounded-full bg-#7DA0CA flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold text-white">S</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 bg-#021024 shadow-lg min-h-screen pt-4">
            <div class="px-4 py-2">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md gradient-bg text-white hover:bg-indigo-700 transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-#C1EBFF hover:bg-#7DA0CA hover:bg-indtransition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>My Classes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-#C1EBFF hover:bg-#7DA0CA hover:text-white transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Available Quizzes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-#C1EBFF hover:bg-#7DA0CA hover:text-white transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>My Results</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-3 rounded-md text-#C1EBFF hover:bg-#7DA0CA hover:text-white transition-all flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span>Notifications</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-#021024">Student Dashboard</h2>
                <button class="gradient-bg hover:bg-#7DA0CA text-white font-medium py-2 px-6 rounded-md shadow-lg transform transition-transform hover:scale-105 pulse">Request to Join a Class</button>
            </div>

            <!-- Notifications -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <h3 class="text-xl font-bold text-#021024 mb-4">Notifications</h3>
                <div class="space-y-3">
                    <div class="bg-#C1EBFF p-4 rounded-md cursor-pointer hover:bg-#7DA0CA transition-all">
                        <p class="text-#021024">You have been accepted to "Mathematics 101" class! Click to view.</p>
                    </div>
                    <div class="bg-#C1EBFF p-4 rounded-md cursor-pointer hover:bg-#7DA0CA transition-all">
                        <p class="text-#021024">New quiz "Algebra Basics" is available in your class. Click to participate.</p>
                    </div>
                </div>
            </div>

            <!-- My Classes -->
            <h3 class="text-xl font-bold text-#021024 mb-6">My Classes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow hover-lift transition-transform p-6">
                    <h4 class="text-xl font-bold text-#021024 mb-2">Mathematics 101</h4>
                    <div class="text-#548383 mb-1">Teacher: Prof. Johnson</div>
                    <div class="text-#548383 mb-1">Members: 32 students</div>
                    <div class="text-#548383 mb-4">Available Quizzes: 3</div>
                    <button class="gradient-bg hover:bg-#7DA0CA text-white font-medium py-2 px-6 rounded-md shadow-lg transform transition-transform hover:scale-105">View Class</button>
                </div>
                <div class="bg-white rounded-lg shadow hover-lift transition-transform p-6">
                    <h4 class="text-xl font-bold text-#021024 mb-2">History Fundamentals</h4>
                    <div class="text-#548383 mb-1">Teacher: Dr. Smith</div>
                    <div class="text-#548383 mb-1">Members: 28 students</div>
                    <div class="text-#548383 mb-4">Available Quizzes: 2</div>
                    <button class="gradient-bg hover:bg-#7DA0CA text-white font-medium py-2 px-6 rounded-md shadow-lg transform transition-transform hover:scale-105">View Class</button>
                </div>
            </div>

            <!-- Available Quizzes -->
            <h3 class="text-xl font-bold text-#021024 mb-6">Available Quizzes</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow overflow-hidden hover-lift transition-transform quiz-card">
                    <div class="h-40 bg-#052659 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h4 class="text-xl font-bold text-white">Algebra Basics</h4>
                            <p class="text-#C1EBFF">Mathematics 101</p>
                        </div>
                        <div class="card-overlay absolute inset-0 bg-#021024 bg-opacity-30 flex items-center justify-center">
                            <span class="text-white font-bold text-xl">Preview</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-#548383 mb-1">Questions: 10</div>
                        <div class="text-#548383 mb-4">Time Limit: 15 minutes</div>
                        <button class="gradient-bg hover:bg-#7DA0CA text-white font-medium py-2 px-6 rounded-md shadow-lg transform transition-transform hover:scale-105 w-full">Take Quiz</button>
                    </div>
                </div>
                <!-- Repeat for other quizzes -->
            </div>

            <!-- Upcoming Quizzes -->
            <h3 class="text-xl font-bold text-#021024 mb-6">Upcoming Quizzes</h3>
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-#C1EBFF">
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Quiz Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Class</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-#C1EBFF">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-#021024">Trigonometry Basics</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">Mathematics 101</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">March 20, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">25 minutes</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Upcoming</span>
                                </td>
                            </tr>
                            <!-- Repeat for other quizzes -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Results -->
            <h3 class="text-xl font-bold text-#021024 mb-6">Recent Results</h3>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-#C1EBFF">
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Quiz Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Class</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-#021024 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-#C1EBFF">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-#021024">Introduction to Functions</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">Mathematics 101</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">March 10, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">85%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-#548383">
                                    <button class="text-#052659 hover:text-#7DA0CA transition-all">View Details</button>
                                </td>
                            </tr>
                            <!-- Repeat for other results -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-12 py-6 border-t border-#C1EBFF">
                <div class="text-center text-#548383 text-sm">
                    <p>© 2025 QuizHub. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
