@section('title', 'Latest Employers')

<x-auth.landing-page-layout>

    <!-- For new employers style only -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .employer-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .employer-card:hover {
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
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Latest Employers
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover the newest companies and employers joining our platform. Connect with businesses that match
                    your career goals.
                </p>
            </div>
        </div>

        <!-- Employers Grid -->
        <div class="max-w-7xl mx-auto">
            @if ($employers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($employers as $employer)
                        <div
                            class="employer-card rounded-xl shadow-lg hover-lift border border-gray-100 overflow-hidden group">
                            <!-- Profile Header -->
                            <div class="relative gradient-bg p-6 text-white">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        @if ($employer->profile_pic)
                                            <img src="{{ asset('storage/' . $employer->profile_pic) }}"
                                                alt="{{ $employer->first_name }} {{ $employer->last_name }}"
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
                                            title="{{ $employer->first_name }}{{ $employer->mid_name ? ' ' . $employer->mid_name : '' }} {{ $employer->last_name }}{{ $employer->suffix ? ' ' . $employer->suffix : '' }}">
                                            {{ $employer->first_name }}{{ $employer->mid_name ? ' ' . $employer->mid_name : '' }}
                                            {{ $employer->last_name }}{{ $employer->suffix ? ' ' . $employer->suffix : '' }}
                                        </h3>
                                        <p class="text-sky-100 text-sm font-medium truncate"
                                            title="{{ $employer->employer_type }}">
                                            {{ $employer->employer_type }}
                                        </p>
                                        @if (!empty($employer->job_type))
                                            <p class="text-sky-200 text-xs font-medium truncate mt-1"
                                                title="{{ $employer->job_type }}">
                                                {{ $employer->job_type }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Company Info -->
                            <div class="p-6">
                                <div class="mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 2h6v4H7V6zm8 8H5v-2h10v2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $employer->comp_name ?: 'Company Name Not Set' }}
                                    </h4>
                                </div>

                                <!-- Location & Details -->
                                <div class="space-y-3 mb-6">
                                    @if ($employer->work_location || $employer->city)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm">
                                                @if ($employer->work_location && $employer->city)
                                                    {{ $employer->barangay }}, {{ $employer->city }}
                                                @elseif($employer->work_location)
                                                    {{ $employer->work_location }}
                                                @elseif($employer->city)
                                                    {{ $employer->city }}
                                                @endif
                                            </span>
                                        </div>
                                    @endif

                                    @if ($employer->barangay)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm">{{ $employer->barangay }}</span>
                                        </div>
                                    @endif

                                    @if ($employer->comp_size)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                            </svg>
                                            <span class="text-sm">{{ $employer->comp_size }} employees</span>
                                        </div>
                                    @endif

                                    @if ($employer->date_founded)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-sky-500 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm">Founded
                                                {{ \Carbon\Carbon::parse($employer->date_founded)->format('M Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Section -->
                <div class="text-center mt-12">
                    <div class="inline-flex items-center gap-2 text-sky-800 hover:text-sky-700 cursor-pointer group">
                        <span class="text-lg font-semibold">View All Employers</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Employers Yet</h3>
                    <p class="text-gray-600 mb-6">Be the first to join our platform as an employer!</p>
                    <a href="{{ route('auth.sign.up', ['user_type' => 'employer']) }}"
                        class="inline-flex items-center gap-2 bg-sky-800 hover:bg-sky-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Register as Employer
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/auth/landing-page.js') }}"></script>
    @endpush
</x-auth.landing-page-layout>
