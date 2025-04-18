<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <div class="w-64 bg-gradient-to-b from-#021024 to-#052659 text-white p-4">
            <div class="flex items-center space-x-2 mb-8">
                <h2 class="text-xl font-bold">QuizHub</h2>
                <span class="text-xs bg-#7DA0CA px-2 py-1 rounded">Teacher</span>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('teacher.dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-#548383 transition {{ request()->routeIs('teacher.dashboard') ? 'bg-#548383' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('teacher.classroom') }}"
                   class="block px-4 py-2 rounded hover:bg-#548383 transition {{ request()->routeIs('teacher.classroom') ? 'bg-#548383' : '' }}">
                    My Classroom
                </a>
                <a href="{{ route('teacher.requests') }}"
                   class="block px-4 py-2 rounded hover:bg-#548383 transition {{ request()->routeIs('teacher.requests') ? 'bg-#548383' : '' }}">
                    Join Requests
                   @if(auth()->user()->classroom?->pendingRequests()->count() > 0)
                       <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                           {{ auth()->user()->classroom->pendingRequests()->count() }}
                       </span>
                   @endif
                </a>
                <a href="{{ route('teacher.quizzes') }}"
                   class="block px-4 py-2 rounded hover:bg-#548383 transition {{ request()->routeIs('teacher.quizzes*') ? 'bg-#548383' : '' }}">
                    My Quizzes
                </a>
            </nav>
        </div>

        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
