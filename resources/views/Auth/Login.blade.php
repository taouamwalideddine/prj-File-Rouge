<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizhub - Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3b5998 0%, #192f6a 100%);
            position: relative;
            overflow: hidden;
        }

        .gradient-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0) 70%);
            transform: translate(-25%, -25%);
        }

        .quote-text {
            max-width: 300px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .logo-dot {
            color: #1e40af;
        }

        .form-section {
            display: none;
            animation-duration: 0.5s;
        }

        .form-section.active {
            display: block;
        }

        .btn-primary {
            background: linear-gradient(to right, #3b5998, #4a66ad);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 89, 152, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }


        .btn-primary:hover::after {
            transform: translateX(100%);
        }

        input {
            transition: all 0.3s ease;
        }

        input:focus {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 89, 152, 0.2);
        }

        .link-hover {
            position: relative;
            display: inline-block;
        }

        .link-hover::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: #3b5998;
            left: 0;
            bottom: -2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .link-hover:hover::after {
            transform: scaleX(1);
        }

        .form-container {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        @keyframes float {
            0% { transform: translateY(-20px); }
            50% { transform: translateY(10px); }
            100% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 7s ease-in-out infinite;
        }
    </style>
</head>
<body class="h-screen flex">
    <!-- Left Panel -->
    <div class="hidden md:flex md:w-1/2 gradient-bg flex-col justify-between p-10">
        <div>
            <h2 class="text-white text-3xl mb-2 floating">Quizhub</h2>
        </div>

        <div class="quote-text mb-20">
            <p class="text-sm">
                "L'éducation n'est pas une préparation à la vie, c'est la vie même. Le processus d'apprentissage est continu et la salle de classe s'étend bien au-delà des quatre murs."
            </p>
            <p class="text-sm mt-3">- John Dewey</p>
        </div>

        <div class="text-white text-xs opacity-70">
            © 2025 Quizhub
        </div>
    </div>

    <!-- Right Panel -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-50 p-5">
        <div class="w-full max-w-md form-container bg-white p-8">
            <div class="text-center mb-8">
                <h1 class="text-xl font-semibold flex items-center justify-center">
                    <span>Quizhub</span><span class="logo-dot font-bold">.</span>
                </h1>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="form-section @if($activeForm === 'login-form') active animate__animated animate__fadeIn @endif">
                <h2 class="text-2xl font-semibold mb-4">Login to your Account</h2>
                <p class="text-gray-500 mb-8">Please enter your credentials</p>

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" required
                               value="{{ old('email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="#" onclick="showForm('reset-password-form')" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                        </div>
                        <input type="password" name="password" id="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Login
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="#" onclick="showForm('register-form')" class="font-medium text-blue-600 hover:underline">Register</a>
                    </p>
                </div>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-section @if($activeForm === 'register-form') active animate__animated animate__fadeIn @endif">
                <h2 class="text-2xl font-semibold mb-4">Create Account</h2>
                <p class="text-gray-500 mb-8">Join as student or teacher</p>

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="name" required
                               value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" required
                               value="{{ old('email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Account Type</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="role" value="student" {{ old('role', 'student') == 'student' ? 'checked' : '' }} class="h-4 w-4 text-blue-600">
                                <span class="ml-2">Student</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="role" value="teacher" {{ old('role') == 'teacher' ? 'checked' : '' }} class="h-4 w-4 text-blue-600">
                                <span class="ml-2">Teacher</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Register
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <a href="#" onclick="showForm('login-form')" class="text-sm text-blue-600 hover:underline">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm(formId) {
            document.querySelectorAll('.form-section').forEach(el => {
                el.classList.remove('active', 'animate__fadeIn');
            });
            document.getElementById(formId).classList.add('active', 'animate__fadeIn');
        }
    </script>
</body>
</html>
