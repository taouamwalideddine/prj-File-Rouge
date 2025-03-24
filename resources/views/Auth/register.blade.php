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

            <!-- Reset Password Form -->
            <div id="reset-password-form" class="form-section active animate__animated animate__fadeIn">
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

            <!-- Change Password Form -->
            <div id="change-password-form" class="form-section animate__animated animate__fadeIn">
                <h2 class="text-2xl font-semibold mb-4">Change Password</h2>
                <p class="text-gray-500 mb-8">Please enter your new password</p>

                <form action="#" class="space-y-6">
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <input type="password" name="new-password" id="new-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="confirm-new-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                        <input type="password" name="confirm-new-password" id="confirm-new-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <button type="button" onclick="showForm('login-form')" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Change Password
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <a href="#" onclick="showForm('login-form')" class="text-sm text-blue-600 hover:underline link-hover">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
