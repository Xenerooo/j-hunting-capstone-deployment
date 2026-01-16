@section('title', 'Dashboard')

<x-admin.main-layout heading="Dashboard">
    <div class="w-full min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Decorative background elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-r from-sky-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10 p-6">
            <!-- Stats Cards Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Platform Overview</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    <!-- Job Seekers Card -->
                    <a href="{{ route('admin.seekers') }}"
                        class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg xmlns="http://http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="currentColor" class="bi bi-person-workspace text-white"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                        <path
                                            d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-gray-900" id="jobSeekerTotal">764</p>
                                    <p class="text-gray-600 font-medium">Job Seekers</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-1 rounded-full"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </a>

                    <!-- Employers Card -->
                    <a href="{{ route('admin.employers') }}"
                        class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-indigo-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg xmlns="http://http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="currentColor" class="bi bi-briefcase text-white" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5m1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0M1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-gray-900" id="employerTotal">207</p>
                                    <p class="text-gray-600 font-medium">Employers</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-1 rounded-full"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </a>

                    <!-- Jobs Card -->
                    <a href="{{ route('admin.jobs') }}"
                        class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-orange-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg xmlns="http://http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="currentColor" class="bi bi-buildings text-white" viewBox="0 0 16 16">
                                        <path
                                            d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                                        <path
                                            d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-gray-900" id="jobsTotal">417</p>
                                    <p class="text-gray-600 font-medium">Jobs</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-orange-500 to-red-600 h-1 rounded-full"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="max-w-6xl mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg p-8">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Monthly Registration Report</h2>
                            <p class="text-gray-600">Track user registrations and platform growth over time</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                            <!-- Year Input -->
                            <div class="flex flex-col">
                                <label for="yearInput" class="text-sm font-medium text-gray-700 mb-2">Year</label>
                                <input id="yearInput"
                                    class="w-full sm:w-32 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none bg-white/90 backdrop-blur-sm"
                                    type="number" name="year-select" min="1900" max="2099" step="1"
                                    value="{{ date('Y') }}" />
                            </div>

                            <!-- User Type Select -->
                            <div class="flex flex-col">
                                <label for="selectedUserType" class="text-sm font-medium text-gray-700 mb-2">User
                                    Type</label>
                                <select id="selectedUserType"
                                    class="w-full sm:w-40 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none bg-white/90 backdrop-blur-sm">
                                    <option value="all">All Users</option>
                                    <option value="job_seeker">Job Seekers</option>
                                    <option value="employer">Employers</option>
                                </select>
                            </div>

                            <!-- Download Button -->
                            <button id="downloadExcel"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-sm font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download Excel
                            </button>
                        </div>
                    </div>

                    <div class="bg-white/50 rounded-xl p-6">
                        <canvas id="registrationChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOR DASHBOARD STYLE ONLY -->

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
        <script>
            const totalPageRoute = "{{ route('admin.dashboard.data') }}";
            const registeredPageRoute = "{{ route('admin.dashboard.registered') }}";
        </script>

        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    @endpush
</x-admin.main-layout>
