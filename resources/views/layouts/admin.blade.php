<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">QuizHub Admin</a>
            <div class="flex space-x-4">
                <a href="{{ route('admin.users') }}" class="hover:text-gray-300">Users</a>
                <a href="{{ route('admin.teachers.pending') }}" class="hover:text-gray-300">Teacher Requests</a>
                <a href="{{ route('admin.quizzes') }}" class="hover:text-gray-300">Quizzes</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-gray-300">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
