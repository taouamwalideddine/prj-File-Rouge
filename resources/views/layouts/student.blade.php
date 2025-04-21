<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body class="bg-gray-50">
    <nav class="bg-indigo-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('student.dashboard') }}" class="text-xl font-bold">QuizHub</a>
            <div class="flex items-center space-x-4">
                <span>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-indigo-200">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
