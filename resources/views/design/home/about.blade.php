@section('title', 'About J-Hunting')

<x-auth.landing-page-layout>
    <div class="py-8 px-4 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto mb-16">
            <div class="text-center">
                <div class="flex justify-center items-center gap-6 mb-8">
                    <img src="{{ asset('assets/icons/j_hunting_logo.png') }}" alt="J-Hunting Logo"
                        class="w-32 h-32 object-contain animate-slide">
                    <div class="w-px h-20 bg-sky-300"></div>
                    <img src="{{ asset('assets/icons/borongan_logo.png') }}" alt="Borongan Logo"
                        class="w-32 h-32 object-contain">
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-sky-800 tracking-wide mb-6">
                    About <span class="text-green-600">J-HUNTING</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Your ultimate destination for connecting job seekers with potential employers. Whether you're
                    looking to advance in your career
                    or find your dream job, we provide the tools you need to succeed.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-7xl mx-auto mb-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <!-- Left Side - Description -->
                    <div class="space-y-6">
                        <h2 class="text-3xl font-bold text-sky-800 mb-6">Our Mission</h2>
                        <div class="space-y-4 text-gray-700 leading-relaxed">
                            <p class="text-lg">
                                <span class="font-semibold text-sky-700">J-Hunting</span> is dedicated to bridging the
                                gap between talented individuals
                                and innovative companies. Our platform offers comprehensive job posting features,
                                detailed job seeker profiles,
                                and powerful search options — making it easier than ever to find the perfect career
                                match.
                            </p>
                            <p class="text-lg">
                                We believe that everyone deserves the opportunity to find meaningful work that aligns
                                with their skills,
                                passions, and career goals. Through our user-friendly interface and advanced matching
                                algorithms,
                                we're revolutionizing the way people connect in the professional world.
                            </p>
                            <p class="text-lg">
                                <span class="font-semibold text-green-600">Join J-Hunting today</span> and take the next
                                step toward
                                building your ideal career path!
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Features -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-sky-800 mb-6">What We Offer</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 p-4 bg-sky-50 rounded-lg border border-sky-100">
                                <div class="w-10 h-10 bg-sky-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-800">Advanced Job Search</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-green-50 rounded-lg border border-green-100">
                                <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-800">Employer Profiles</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-lg border border-blue-100">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-800">Detailed Job Listings</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-purple-50 rounded-lg border border-purple-100">
                                <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-800">Smart Matching</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Development Team Section -->
        <div class="max-w-7xl mx-auto mb-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-sky-800 mb-4">Development Team</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Meet the talented individuals who brought J-Hunting to life through their dedication and expertise.
                </p>
            </div>

            <!-- System Developers -->
            <div class="mb-16">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-sky-700 mb-2 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        System Development
                    </h3>
                    <p class="text-gray-600">The technical minds behind the platform's functionality</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Developer 1 -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-center">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-sky-500 to-sky-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Caspe, Kengie T.</h4>
                            <p class="text-sky-600 font-medium mb-3">Full Stack Developer</p>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Responsible for the core system architecture, database design, and backend development.
                                Ensured robust performance and scalability of the platform.
                            </p>
                        </div>
                    </div>

                    <!-- Developer 2 -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-center">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Mengote, Jhuzen Jhon D.</h4>
                            <p class="text-green-600 font-medium mb-3">Frontend Developer</p>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Focused on creating an intuitive and responsive user interface.
                                Implemented modern design principles and ensured cross-platform compatibility.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Papers/Research Developers -->
            <div class="mb-16">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-sky-700 mb-2 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Papers & Research
                    </h3>
                    <p class="text-gray-600">The research and documentation specialists</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Developer 3 -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-center">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-purple-500 to-purple-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Calvo, Jamila E.</h4>
                            <p class="text-purple-600 font-medium mb-3">Research & Analysis</p>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Conducted comprehensive research on job market trends, user needs analysis,
                                and platform requirements. Provided data-driven insights for development decisions.
                            </p>
                        </div>
                    </div>

                    <!-- Developer 4 -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-center">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-orange-500 to-orange-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Casimo, Noimelyn D.</h4>
                            <p class="text-orange-600 font-medium mb-3">Documentation & Testing</p>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Managed project documentation, user testing protocols, and quality assurance processes.
                                Ensured the platform meets industry standards and user expectations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-gradient-to-r from-sky-700 to-sky-600 rounded-2xl p-8 md:p-12 text-white">
                <h3 class="text-3xl font-bold mb-4">Ready to Start Your Journey?</h3>
                <p class="text-xl text-sky-100 mb-8">
                    Join thousands of job seekers and employers who have already discovered the power of J-Hunting.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('auth.sign.up', ['user_type' => 'job_seeker']) }}"
                        class="bg-white text-sky-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                        Find Your Dream Job
                    </a>
                    <a href="{{ route('auth.sign.up', ['user_type' => 'employer']) }}"
                        class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-sky-800 transition-all duration-200">
                        Post Job Opportunities
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/auth/landing-page.js') }}"></script>
    @endpush
</x-auth.landing-page-layout>
