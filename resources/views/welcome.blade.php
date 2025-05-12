<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHub - Transform Your Classroom</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4361ee, #3730a3);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #4361ee, #3730a3, #4f46e5);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="gradient-bg text-white p-4 sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold">QuizHub</h1>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-white text-white hover:bg-white hover:text-indigo-600 transition-all">Log In</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-indigo-600 rounded-md hover:bg-indigo-50 transition-all hover-lift">Register</a>
            </div>
        </div>
    </nav>

    <div class="hero-gradient text-white py-20">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate__animated animate__fadeInUp">Transform Your Classroom Experience</h1>
                <p class="text-lg md:text-xl mb-8 opacity-90 animate__animated animate__fadeInUp animate__delay-1s">Create engaging quizzes, manage student progress, and boost classroom participation with our intuitive platform.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 py-3 px-8 rounded-lg font-bold hover:bg-indigo-50 transition-all hover-lift">Get Started</a>
                    <a href="#features" class="bg-transparent border-2 border-white py-3 px-8 rounded-lg font-bold hover:bg-white hover:text-indigo-600 transition-all">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <section id="features" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Powerful Features for Educators</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Everything you need to create an interactive and effective learning environment</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md p-6 feature-card">
                    <div class="p-4 rounded-full bg-indigo-100 text-indigo-600 mb-6 inline-block card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Interactive Quizzes</h3>
                    <p class="text-gray-600">Create engaging quizzes with various question types to test understanding and promote active learning.</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 feature-card">
                    <div class="p-4 rounded-full bg-blue-100 text-blue-600 mb-6 inline-block card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Comprehensive Analytics</h3>
                    <p class="text-gray-600">Track student performance with detailed analytics and identify areas where students need additional support.</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 feature-card">
                    <div class="p-4 rounded-full bg-amber-100 text-amber-600 mb-6 inline-block card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Classroom Management</h3>
                    <p class="text-gray-600">Easily manage student access to your classroom and organize learning materials efficiently.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Loved by Educators</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">See what teachers are saying about QuizHub</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md p-6 hover-lift">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-300 flex items-center justify-center shadow-md mr-4">
                            <span class="text-lg font-bold text-white">S</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Sarah Johnson</h4>
                            <p class="text-sm text-gray-600">High School Science Teacher</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"QuizHub has transformed how I assess my students. The real-time analytics help me quickly identify concepts that need to be revisited."</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover-lift">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-300 flex items-center justify-center shadow-md mr-4">
                            <span class="text-lg font-bold text-white">M</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Michael Chen</h4>
                            <p class="text-sm text-gray-600">University Professor</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"My students are more engaged than ever since I started using QuizHub for classroom assessments. The platform is intuitive and powerful."</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover-lift">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-amber-300 flex items-center justify-center shadow-md mr-4">
                            <span class="text-lg font-bold text-white">L</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Lisa Rodriguez</h4>
                            <p class="text-sm text-gray-600">Elementary School Teacher</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"QuizHub makes creating fun and educational quizzes so easy. My students look forward to quiz days now!"</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 gradient-bg text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Transform Your Classroom?</h2>
            <p class="text-lg mb-8 opacity-90 max-w-2xl mx-auto">Join thousands of educators who are already using QuizHub to create engaging learning experiences.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-indigo-600 py-3 px-8 rounded-lg font-bold hover:bg-indigo-50 transition-all hover-lift">Get Started for Free</a>
                <a href="{{ route('login') }}" class="bg-transparent border-2 border-white py-3 px-8 rounded-lg font-bold hover:bg-white hover:text-indigo-600 transition-all">Log In</a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">QuizHub</h3>
                    <p class="text-gray-400">Transforming the classroom experience with interactive quizzes and powerful analytics.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Log In</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Tutorials</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">info@quizhub.com</li>
                        <li class="text-gray-400">1-800-QUIZ-HUB</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2025 QuizHub. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
<!--
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script> -->
</body>
</html>
