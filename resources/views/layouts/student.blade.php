<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('student.dashboard') }}" class="text-xl font-bold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    QuizHub
                </a>

                <div class="flex items-center space-x-6">
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('student.dashboard') }}" class="hover:text-indigo-200 transition-colors {{ request()->routeIs('student.dashboard') ? 'font-bold' : '' }}">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('student.classrooms') }}" class="hover:text-indigo-200 transition-colors {{ request()->routeIs('student.classrooms*') ? 'font-bold' : '' }}">
                            <i class="fas fa-users mr-2"></i>Classes
                        </a>
                        <a href="{{ route('student.quizzes') }}" class="hover:text-indigo-200 transition-colors {{ request()->routeIs('student.quizzes*') ? 'font-bold' : '' }}">
                            <i class="fas fa-question-circle mr-2"></i>Quizzes
                        </a>
                    </div>

                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                                 alt="User avatar" class="w-8 h-8 rounded-full">
                        </button>

                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-indigo-700 text-white md:hidden">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-around">
                <a href="{{ route('student.dashboard') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('student.dashboard') ? 'text-indigo-200' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="text-xs mt-1">Dashboard</span>
                </a>
                <a href="{{ route('student.classrooms') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('student.classrooms*') ? 'text-indigo-200' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="text-xs mt-1">Classes</span>
                </a>
                <a href="{{ route('student.quizzes') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('student.quizzes*') ? 'text-indigo-200' : '' }}">
                    <i class="fas fa-question-circle"></i>
                    <span class="text-xs mt-1">Quizzes</span>
                </a>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <script>
        document.getElementById('userMenuButton').addEventListener('click', function() {
            document.getElementById('userMenu').classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenu');
            const userMenuButton = document.getElementById('userMenuButton');

            if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

    </script>
</body>
</html>
