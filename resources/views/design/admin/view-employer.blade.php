@section('title', 'Employer')
<x-admin.view-layout>
    <div class="w-full min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Decorative background elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-r from-sky-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000">
        </div>

        <div class="container relative z-10 mt-4">
            <!-- Map -->
            <div>
                <div id="map" class="w-full h-[300px] rounded-2xl border border-sky-100 shadow-lg"></div>
            </div>

            <div class="grid md:grid-cols-12 grid-cols-1 gap-6 mt-6">
                <!-- Left column -->
                <div class="lg:col-span-8 md:col-span-6 space-y-4">
                    <!-- Profile Card -->
                    <div
                        class="md:flex items-center justify-between p-6 bg-white/85 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg">
                        <div class="md:flex items-center">
                            <img name="profile_pic"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGWLz7hgmskaVcEm-qqmTFFTkSIe35ZgoGJg&s"
                                class="object-cover w-[80px] h-[80px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-5"
                                alt="">
                            <div class="md:mt-0 mt-4">
                                <div class="mt-2 space-y-1">
                                    <div class="inline-flex items-center gap-2 text-gray-700 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-briefcase-business">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg>
                                        <span name="comp_name"></span>
                                    </div>
                                    <h5 class="text-2xl font-bold text-sky-800 leading-tight" name="full_name">Ernisto
                                        Espinosa</h5>
                                    <div class="inline-flex items-center gap-2 text-gray-700 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-map-pin">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        <span name="location"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="sm:col-start-1 col-end-6 mt-4 md:mt-0 flex flex-col sm:flex-row sm:items-center gap-2">
                            <button id="send-warning-button"
                                class="w-full sm:w-auto py-2 px-4 inline-flex items-center justify-center font-semibold rounded-xl border bg-white text-sky-700 border-sky-300 hover:bg-sky-50 hover:border-sky-400 transition">
                                Send Warning
                            </button>
                            <button id="restrict-button"
                                class="w-full sm:w-auto py-2 px-4 inline-flex items-center justify-center font-semibold rounded-xl bg-gradient-to-r from-rose-500 to-red-600 text-white hover:from-rose-600 hover:to-red-700 shadow-sm transition">
                                Restrict User
                            </button>
                        </div>
                    </div>

                    <!-- About Card -->
                    <div class="bg-white/85 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg p-6">
                        <h5 class="text-lg font-semibold mb-2">About our company:</h5>
                        <p class="text-[14px] ml-0 md:ml-2 whitespace-pre-line break-words text-gray-700"
                            name="about"></p>
                    </div>
                </div>

                <!-- Right column -->
                <div class="lg:col-span-4 md:col-span-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                            <h2 class="text-white text-lg font-semibold flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 12h.01" />
                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                </svg>
                                Employers Information
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Employer type</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end " name="employer_type"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Email</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="email"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Phone number</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="phone_num"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2"
                                                ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Date founded</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="date_founded"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Work Location</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end"
                                    name="work_location"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Job Type</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="job_type"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Company size</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="comp_size"></span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Profile Facebook Link</span>
                                </div>
                                <a href="" target="_black"
                                    class="text-sm font-semibold text-sky-600 hover:text-sky-700 hover:underline text-end"
                                    name="facebook_link"></a>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2"
                                                ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Valid ID Type</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="valid_id_type"></span>
                            </div>

                            <div class="py-2">
                                <p class="text-sm font-medium text-gray-600 mb-2">Valid ID</p>
                                <img id="valid-id-preview" onClick="$('#view-id-modal').fadeIn()"
                                    src="https://www.moneymax.ph/hs-fs/hubfs/NBI%20Clearance.png?width=401&height=226&name=NBI%20Clearance.png"
                                    class="object-cover w-full max-w-[365px] h-[200px] border border-sky-200 rounded-lg overflow-hidden cursor-pointer"
                                    alt="">
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                    </svg>
                                    Business Permit
                                </h3>
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800" name="permit_name"></span>
                                </div>
                                <button id="downloadPermit"
                                    class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">Download</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Posted Jobs -->
        <div class="container relative z-10 lg:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-6 text-center">
                <h3 class="mb-2 md:text-[26px] md:leading-normal text-2xl leading-normal font-semibold">All Posted Job
                    Listings</h3>
                <p class="text-gray-600">Jobs posted by this employer</p>
            </div>

            <div class="grid md:grid-cols-2 mt-8 gap-6" id="posted-jobs"></div>
        </div>
    </div>

    <!-- ID Modal -->
    <div id="view-id-modal"
        class="mx-auto w-full h-full bg-black/40 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <button id="close-id-modal" onClick="$('#view-id-modal').fadeOut()"
            class="w-fit absolute top-10 right-10 bg-gradient-to-r from-sky-600 to-blue-600 text-white py-2 px-4 rounded-lg shadow hover:from-sky-700 hover:to-blue-700 transition cursor-pointer">Close</button>
        <img id="valid-id-preview-modal"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGWLz7hgmskaVcEm-qqmTFFTkSIe35ZgoGJg&s"
            class="object-cover w-[80%] h-[80%] border-4 border-sky-600 rounded shadow-lg cursor-pointer">
    </div>

    <!-- Message Modal -->
    <div id="message-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <x-message-modal />
    </div>

    <!-- Restrict Modal -->
    <div id="restrict-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <x-restrict-modal>
            <p>Are you sure you want to restrict this user?</p>
        </x-restrict-modal>
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
        <script>
            const token = "{{ csrf_token() }}";
            const getProfileRoute = "{{ route('admin.employer.profile') }}";
            const sendMessageRoute = "{{ route('admin.employer.send.message') }}";
            const pageRoute = "{{ route('admin.employers') }}";
            const postedJobsRoute = "{{ route('admin.employer.posted.jobs') }}";
        </script>
        <script src="{{ asset('js/admin/view-employer.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.view-layout>
