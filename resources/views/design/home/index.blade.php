@section('title', 'Home page')

<x-auth.landing-page-layout>
    <!-- Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 overflow-hidden">
        <!-- Decorative background elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-r from-sky-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
            <div class="text-center">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full mb-8 shadow-2xl">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2z" />
                    </svg>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold text-gray-900 mb-8 leading-tight">
                    Find Your Dream Job
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-blue-600">
                        or Perfect Job Seeker
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-12">
                    J-Hunting connects talented professionals with innovative companies. Whether you're seeking your
                    next career move or building your dream team, we make the perfect match.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="{{ route('auth.sign.up') }}"
                        class="group relative px-8 py-4 bg-gradient-to-r from-sky-600 to-blue-600 text-white font-semibold rounded-xl text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        Get Started Today
                    </a>
                    <a href="{{ route('auth.sign.in') }}"
                        class="px-8 py-4 border-2 border-sky-600 text-sky-600 font-semibold rounded-xl text-lg hover:bg-sky-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose J-Hunting?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Discover the features that make us the preferred
                    choice for both job seekers and employers</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="group p-8 bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl border border-sky-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-sky-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Job Matching</h3>
                    <p class="text-gray-600 leading-relaxed">Our algorithm matches you with the perfect
                        opportunities based on your job type.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Secure & Private</h3>
                    <p class="text-gray-600 leading-relaxed">Your data is protected with enterprise-grade security. We
                        ensure your privacy while connecting you with opportunities.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Lightning Fast</h3>
                    <p class="text-gray-600 leading-relaxed">Get instant notifications, quick applications, and rapid
                        responses. Time is valuable, and we respect yours.</p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="group p-8 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl border border-orange-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Expert Support</h3>
                    <p class="text-gray-600 leading-relaxed">Our dedicated team is here to help you succeed. Get
                        personalized assistance whenever you need it.</p>
                </div>

                <!-- Feature 5 -->
                <div
                    class="group p-8 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl border border-indigo-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Analytics & Insights</h3>
                    <p class="text-gray-600 leading-relaxed">Track your application progress, view detailed analytics,
                        and gain insights to improve your success rate.</p>
                </div>

                <!-- Feature 6 -->
                <div
                    class="group p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Loved by Users</h3>
                    <p class="text-gray-600 leading-relaxed">Join thousands of satisfied users who have found their
                        dream jobs or perfect job seekers through our platform.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600">Simple steps to achieve your career or hiring goals</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        1</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Create Your Profile</h3>
                    <p class="text-gray-600">Sign up and build your professional profile with your skills, experience,
                        and career goals.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        2</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Search</h3>
                    <p class="text-gray-600">Our algorithm connects you with the perfect opportunities or
                        job seekers and you can filter based on your location.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        3</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Connect & Succeed</h3>
                    <p class="text-gray-600">Start applying for the jobs, or hiring the perfect job seeker for
                        your team.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Ready to Transform Your Career?</h2>
            <p class="text-xl text-gray-600 mb-12">Join thousands of professionals who have already found their dream
                job with
                J-Hunting</p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('auth.sign.up') }}"
                    class="px-10 py-4 bg-gradient-to-r from-sky-600 to-blue-600 text-white font-semibold rounded-xl text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    Start Your Journey
                </a>
                <a href="{{ route('auth.sign.in') }}"
                    class="px-10 py-4 border-2 border-sky-600 text-sky-600 font-semibold rounded-xl text-lg hover:bg-sky-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                    Sign In
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    @push('scripts')
        <script src="{{ asset('js/auth/landing-page.js') }}"></script>
    @endpush
</x-auth.landing-page-layout>
