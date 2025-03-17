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

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0.2), rgba(255,255,255,0));
            transform: translateX(-100%);
            transition: transform 0.6s ease;
            pointer-events: none;
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
            &copy; 2025 Quizhub
        </div>
    </div>

    <!-- Right Panel - Forms -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-50 p-5">
        <div class="w-full max-w-md form-container bg-white p-8">
            <div class="text-center mb-8">
                <h1 class="text-xl font-semibold flex items-center justify-center">
                    <span>Quizhub</span><span class="logo-dot font-bold">.</span>
                </h1>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="form-section active animate__animated animate__fadeIn">
                <h2 class="text-2xl font-semibold mb-4">Login to your Account</h2>
                <p class="text-gray-500 mb-8">Please enter your credentials to access your account</p>

                <form action="#" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="#" onclick="showForm('reset-password-form')" class="text-sm text-blue-600 hover:underline link-hover">Forgot password?</a>
                        </div>
                        <input type="password" name="password" id="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Login
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="#" onclick="showForm('register-form')" class="font-medium text-blue-600 hover:underline link-hover">Register Account</a>
                    </p>
                </div>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-section animate__animated animate__fadeIn">
                <h2 class="text-2xl font-semibold mb-4">Create an Account</h2>
                <p class="text-gray-500 mb-8">Join Quizhub and start your learning journey</p>

                <form action="#" class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first-name" id="first-name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last-name" id="last-name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label for="register-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="register-email" id="register-email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="user-type" class="block text-sm font-medium text-gray-700 mb-1">I am a</label>
                        <select id="user-type" name="user-type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>

                    <div>
                        <label for="register-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="register-password" id="register-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="confirm-password" id="confirm-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:underline link-hover">Terms and Conditions</a></label>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="#" onclick="showForm('login-form')" class="font-medium text-blue-600 hover:underline link-hover">Login</a>
                    </p>
                </div>
            </div>

            <!-- Reset Password Form -->
            <div id="reset-password-form" class="form-section animate__animated animate__fadeIn">
                <h2 class="text-2xl font-semibold mb-4">Reset Password</h2>
                <p class="text-gray-500 mb-8">Please enter your email to receive a password reset link</p>

                <form action="#" class="space-y-6">
                    <div>
                        <label for="reset-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="reset-email" id="reset-email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <button type="button" onclick="showForm('change-password-form')" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <a href="#" onclick="showForm('login-form')" class="text-sm text-blue-600 hover:underline link-hover">Back to Login</a>
                </div>
            </div>

            <div id="change-password-form" class="form-section animate__animated animate__fadeIn">
                <h2 class="text-2xl font-semibold mb-4">Change Password</h2>
                <p class="text-gray-500 mb-8">Please enter your new password</p>

                <form action="#" class="space-y-6">
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <input type="password" name="new-password" id="new-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                    <label for="confirm-new-password" class="text-sm font-medium text-gray-700">Confirm New Password</label>
                    </div>

                    <div>
                        <button type="button" onclick="showForm('login-form')" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Change Password
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
            // Hide all forms
            document.querySelectorAll('.form-section').forEach(form => {
                form.classList.remove('active');
            });

            // Show the selected form
            document.getElementById(formId).classList.add('active');
        }

        function selectRole(element, role) {

            document.querySelectorAll('.role-option').forEach(option => {
                option.classList.remove('selected');
            });

            element.classList.add('selected');

            document.getElementById('role').value = role;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            setTimeout(() => {
                document.querySelector('.form-section.active').style.opacity = "1";
            }, 100);
        });
    </script>
</body>
</html>
