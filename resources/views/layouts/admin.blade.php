<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">QuizHub Admin</a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-gray-300">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Admin Navigation -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">QuizHub Admin</a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-gray-300">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
