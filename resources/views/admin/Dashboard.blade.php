<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-indigo-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold">QuizHub</h1>
                <span class="bg-indigo-900 px-2 py-1 rounded text-xs">Admin Panel</span>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <button class="flex items-center space-x-1">
                        <i class="fas fa-bell"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-4 h-4 text-xs flex items-center justify-center">3</span>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="/api/placeholder/40/40" class="w-8 h-8 rounded-full" alt="Admin Avatar">
                    <span>Admin User</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto py-6 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Users</p>
                        <h3 class="text-2xl font-bold">1,254</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Teachers</p>
                        <h3 class="text-2xl font-bold">162</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-chalkboard-teacher text-green-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Active Quizzes</p>
                        <h3 class="text-2xl font-bold">324</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-question-circle text-purple-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Banned Users</p>
                        <h3 class="text-2xl font-bold">17</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-ban text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-lg text-indigo-700">
                    <i class="fas fa-user-check mr-2"></i>
                    Validate Teachers
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Institution</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Sarah Johnson</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">sarah.johnson@example.com</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Springfield High School
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                2 days ago
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-100 text-green-600 px-3 py-1 rounded hover:bg-green-200 mr-2">
                                    <i class="fas fa-check mr-1"></i> Approve
                                </button>
                                <button class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200">
                                    <i class="fas fa-times mr-1"></i> Reject
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Michael Chen</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">m.chen@example.edu</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Westview College
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                1 day ago
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-100 text-green-600 px-3 py-1 rounded hover:bg-green-200 mr-2">
                                    <i class="fas fa-check mr-1"></i> Approve
                                </button>
                                <button class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200">
                                    <i class="fas fa-times mr-1"></i> Reject
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-lg text-red-700">
                    <i class="fas fa-ban mr-2"></i>
                    Ban Users
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-end gap-4 mb-6">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">User Search</label>
                        <input type="text" placeholder="Search by name or email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-search mr-2"></i> Search
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">John Smith</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">john.smith@example.com</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Student
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200">
                                        <i class="fas fa-ban mr-1"></i> Ban User
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Emma Wilson</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">emma.w@example.org</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Teacher
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Banned
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="bg-green-100 text-green-600 px-3 py-1 rounded hover:bg-green-200">
                                        <i class="fas fa-user-check mr-1"></i> Unban User
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-lg text-purple-700">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Remove Quizzes
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-end gap-4 mb-6">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quiz Search</label>
                        <input type="text" placeholder="Search by title or teacher" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-search mr-2"></i> Search
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quiz Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classroom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Advanced Biology Quiz</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="">
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-900">Dr. Robert Lee</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Biology 201
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    3 days ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200">
                                        <i class="fas fa-trash-alt mr-1"></i> Remove
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Algebra Midterm</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="">
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-900">Prof. Maria Garcia</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Mathematics 101
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    1 week ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200">
                                        <i class="fas fa-trash-alt mr-1"></i> Remove
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-lg text-yellow-700">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Flagged Content
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-comment text-yellow-500"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-700">
                                    <span class="font-medium">Comment by: </span>
                                    <span class="text-gray-900">Alex Thompson</span>
                                    <span class="text-gray-500 ml-2">2 hours ago</span>
                                </p>
                                <p class="mt-2 text-sm text-gray-700">
                                    "This quiz is totally stupid and useless. The teacher doesn't know what they're talking about."
                                </p>
                                <div class="mt-3 flex space-x-2">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                        <i class="fas fa-trash-alt mr-1"></i> Remove Comment
                                    </button>
                                    <button class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded text-xs hover:bg-yellow-200">
                                        <i class="fas fa-flag mr-1"></i> Keep but Send Warning
                                    </button>
                                    <button class="bg-green-100 text-green-600 px-3 py-1 rounded text-xs hover:bg-green-200">
                                        <i class="fas fa-check mr-1"></i> Dismiss Flag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-comment text-yellow-500"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-700">
                                    <span class="font-medium">Comment by: </span>
                                    <span class="text-gray-900">Jamie Lewis</span>
                                    <span class="text-gray-500 ml-2">Yesterday</span>
                                </p>
                                <p class="mt-2 text-sm text-gray-700">
                                    "The answer to question 5 is totally wrong. This is misleading students."
                                </p>
                                <div class="mt-3 flex space-x-2">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                        <i class="fas fa-trash-alt mr-1"></i> Remove Comment
                                    </button>
                                    <button class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded text-xs hover:bg-yellow-200">
                                        <i class="fas fa-flag mr-1"></i> Keep but Send Warning
                                    </button>
                                    <button class="bg-green-100 text-green-600 px-3 py-1 rounded text-xs hover:bg-green-200">
                                        <i class="fas fa-check mr-1"></i> Dismiss Flag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white shadow-inner mt-8 py-4">
        <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; 2025 QuizHub. All rights reserved.
        </div>
    </footer>
</body>
</html>
