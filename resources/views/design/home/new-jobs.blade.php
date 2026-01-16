@section('title', 'Latest Jobs')

<x-auth.landing-page-layout>

    <!-- For new jobs style only -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .job-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .job-card:hover {
            backdrop-filter: blur(20px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>

    <div class="py-8 px-4 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto mb-12">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-sky-800 mb-4 flex items-center justify-center gap-3">
                    <svg class="w-10 h-10 text-sky-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8zM12 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8z" />
                    </svg>
                    Latest Jobs
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover the newest job opportunities posted by top employers. Find your next career move with
                    positions that match your skills and aspirations.
                </p>
            </div>
        </div>

        <!-- Jobs Grid -->
        <div class="max-w-7xl mx-auto">
            @if ($jobs->count() > 0)
                <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($jobs as $job)
                        <div
                            class="job-card rounded-xl shadow-lg hover-lift border border-gray-100 overflow-hidden group h-full flex flex-col">
                            <!-- Job Header -->
                            <div class="relative gradient-bg p-6 text-white">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        @if ($job->employer->profile_pic)
                                            <img src="{{ asset('storage/' . $job->employer->profile_pic) }}"
                                                alt="{{ $job->employer->first_name }} {{ $job->employer->last_name }}"
                                                class="w-16 h-16 rounded-full border-4 border-white/20 shadow-lg object-cover">
                                        @else
                                            <div
                                                class="w-16 h-16 rounded-full border-4 border-white/20 shadow-lg bg-white/20 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white/80" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold truncate"
                                            title="{{ $job->employer->first_name }}{{ $job->employer->mid_name ? ' ' . $job->employer->mid_name : '' }} {{ $job->employer->last_name }}{{ $job->employer->suffix ? ' ' . $job->employer->suffix : '' }}">
                                            {{ $job->employer->first_name }}{{ $job->employer->mid_name ? ' ' . $job->employer->mid_name : '' }}
                                            {{ $job->employer->last_name }}{{ $job->employer->suffix ? ' ' . $job->employer->suffix : '' }}
                                        </h3>
                                        <p class="text-sky-100 text-sm font-medium truncate"
                                            title="{{ $job->employer->comp_name ?: 'Company Name Not Set' }}">
                                            {{ $job->employer->comp_name ?: 'Company Name Not Set' }}
                                        </p>
                                        @if ($job->job_type)
                                            <p class="text-sky-200 text-xs font-medium truncate mt-1"
                                                title="{{ $job->job_type }}">
                                                {{ $job->job_type }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Job Info -->
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2 flex items-start gap-2"
                                        title="{{ $job->title }}">
                                        <svg class="w-5 h-5 text-sky-600 flex-shrink-0 mt-0.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="leading-relaxed">{{ $job->title }}</span>
                                    </h4>
                                </div>

                                <!-- Job Details -->
                                <div class="space-y-3 mb-6">
                                    @if ($job->location)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm truncate"
                                                title="{{ $job->location }}">{{ $job->location }}</span>
                                        </div>
                                    @endif

                                    @if ($job->employment_type)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm">{{ $job->employment_type }}</span>
                                        </div>
                                    @endif

                                    @if ($job->expected_salary)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm">₱{{ number_format($job->expected_salary, 2) }}
                                                {{ $job->salary_basis }}</span>
                                        </div>
                                    @endif

                                    @if ($job->experience_level)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm">{{ $job->experience_level }}</span>
                                        </div>
                                    @endif

                                    @if ($job->deadline_at)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm">Deadline:
                                                {{ \Carbon\Carbon::parse($job->deadline_at)->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Apply Button -->
                                <button
                                    class="mt-auto w-full bg-gradient-to-r from-sky-700 to-sky-500 text-white px-4 py-3 rounded-lg hover:from-sky-800 hover:to-sky-600 text-center transition font-semibold shadow transform hover:scale-105 flex items-center justify-center gap-2"
                                    data-login-url="{{ route('auth.sign.in') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Section -->
                <div class="text-center mt-12">
                    <div class="inline-flex items-center gap-2 text-sky-800 hover:text-sky-700 cursor-pointer group">
                        <span class="text-lg font-semibold">View All Jobs</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-200"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8zM12 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Jobs Available</h3>
                    <p class="text-gray-600 mb-6">Check back soon for new job opportunities!</p>
                    <a href="{{ route('auth.sign.up', ['user_type' => 'job_seeker']) }}"
                        class="inline-flex items-center gap-2 bg-sky-800 hover:bg-sky-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Register as Job Seeker
                    </a>
                </div>
            @endif
        </div>

        <!-- Banner Advertisement -->
        <div class="max-w-7xl mx-auto mt-16">
            <div
                class="bg-gradient-to-r from-sky-100 to-sky-200 border border-sky-300 rounded-xl shadow-lg flex items-center px-8 py-6 gap-6">
                <img src="https://img.freepik.com/free-vector/online-resume-concept-illustration_114360-2277.jpg?w=120&q=80"
                    alt="Resume Ad" class="w-24 h-24 object-contain rounded-lg shadow">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-sky-800 mb-1">Looking for More Opportunities?</h3>
                    <p class="text-sky-700 mb-3">Sign up now and get personalized job alerts delivered to your inbox!
                    </p>
                    <a href="{{ route('auth.sign.up') }}"
                        class="inline-block bg-sky-700 text-white px-5 py-2 rounded-lg hover:bg-sky-800 transition font-semibold shadow transform hover:scale-105">
                        Join Free
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/auth/landing-page.js') }}"></script>
        <script>
            $(function() {
                $('[data-login-url]').on('click', function(e) {
                    e.preventDefault();
                    var url = $(this).data('login-url');
                    window.location.href = url;
                });
            });
        </script>
    @endpush
</x-auth.landing-page-layout>
