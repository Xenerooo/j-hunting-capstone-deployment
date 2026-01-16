@section('title', 'Testimonials & Reviews')

<x-auth.landing-page-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="text-center relative z-10">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full mb-8 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        What Our Users Say
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Discover why job seekers and employers trust J-Hunting for their career and hiring needs
                    </p>
                </div>
            </div>

            <!-- Decorative elements -->
            <div
                class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-r from-sky-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-72 h-72 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Stats Section -->
        @php
            $totalFeedbacks = \App\Models\Feedback::where('is_displayed', 1)->count();
            $averageRating = \App\Models\Feedback::where('is_displayed', 1)->avg('rating');
            $averageRating = $averageRating ? number_format($averageRating, 1) : 'N/A';

            $uniqueUserCount = \App\Models\Feedback::where('is_displayed', 1)
                ->distinct('account_id')
                ->count('account_id');

            $positiveFeedbacks = \App\Models\Feedback::where('is_displayed', 1)->where('rating', '>=', 4)->count();
            $successRate = $totalFeedbacks > 0 ? round(($positiveFeedbacks / $totalFeedbacks) * 100) : 0;
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-sky-600 mb-2">
                        {{ $averageRating }}/5
                    </div>
                    <div class="text-gray-600">Average Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-sky-600 mb-2">
                        {{ number_format($uniqueUserCount) }}
                    </div>
                    <div class="text-gray-600">Happy Users</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-sky-600 mb-2">
                        {{ $successRate }}%
                    </div>
                    <div class="text-gray-600">Success Rate</div>
                </div>
            </div>
        </div>

        <!-- Approved Testimonials Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Verified User Testimonials</h2>
                <p class="text-lg text-gray-600">All testimonials are verified and approved by our team</p>
            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feedbacks -->
                @if ($feedbacks && $feedbacks->count() > 0)
                    @foreach ($feedbacks as $feedback)
                        <div
                            class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="flex items-center mb-6">
                                @if ($feedback->user && $feedback->user->profile_picture)
                                    <img src="{{ asset('storage/' . $feedback->user->profile_picture) }}"
                                        alt="{{ $feedback->user->name ?? 'User' }}"
                                        class="w-16 h-16 rounded-full object-cover mr-4 border-2 border-sky-200">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                        {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 2)) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">
                                        {{ $feedback->user->name ?? 'Anonymous User' }}</h4>
                                    <p class="text-sky-600 font-medium">
                                        @if ($feedback->user && $feedback->user->role === 'employer')
                                            {{ $feedback->user->company_name ?? 'Employer' }}
                                        @else
                                            {{ $feedback->user->job_title ?? 'Job Seeker' }}
                                        @endif
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($feedback->rating && $i <= $feedback->rating)
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-500 ml-2">Verified</span>
                                    </div>
                                </div>
                            </div>
                            <blockquote class="text-gray-700 text-lg leading-relaxed italic">
                                "{{ $feedback->content ?? 'Great platform for finding opportunities!' }}"
                            </blockquote>
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm text-gray-500">{{ $feedback->feedback_at ? \Carbon\Carbon::parse($feedback->feedback_at)->format('F Y') : 'Recently' }}</span>
                                    <div class="flex items-center text-sky-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium">Approved</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h5 class="text-lg font-semibold text-gray-800">No feedback found</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Security Notice Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl p-8 border border-sky-200">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-100 rounded-full mb-6">
                    <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Security & Quality Assurance</h3>
                <p class="text-gray-700 text-lg leading-relaxed max-w-3xl mx-auto">
                    All testimonials displayed on this page are verified, approved, and authenticated by our
                    security
                    team.
                    We maintain strict quality control to ensure only genuine feedback from verified users is
                    published.
                </p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="bg-gradient-to-r from-sky-600 to-blue-700 rounded-2xl p-12 text-center text-white">
            <h3 class="text-3xl font-bold mb-4">Ready to Experience J-Hunting?</h3>
            <p class="text-xl text-sky-100 mb-8">Join thousands of satisfied users who have found success with our
                platform</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('auth.sign.up') }}"
                    class="bg-white text-sky-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors duration-200">
                    Get Started Today
                </a>
                <a href="{{ route('auth.sign.in') }}"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-sky-600 transition-colors duration-200">
                    Browse Jobs
                </a>
            </div>
        </div>
    </div>
    </div>

    <!-- For feedback style only -->
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
</x-auth.landing-page-layout>
