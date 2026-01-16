@section('title', 'Job Seeker')
<x-admin.view-layout>

    <div class="container mt-2">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-8 md:col-span-6 space-y-2">
                <div class="md:flex items-center justify-between p-6 shadow-sm rounded-md bg-white">
                    <div class="md:flex items-center">
                        <img name="profile_pic"
                            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                            class="object-cover w-[80px] h-[80px] border-2 border-sky-600 rounded-xl overflow-hidden mr-5"
                            alt="">
                        <div class="md:mt-0 mt-6">
                            <div class="mt-2">
                                <h5 class="text-xl font-semibold text-sky-800" name="full_name"></h5>
                                <div class="me-2 inline-block">
                                    <span class="text-gray-700 font-medium text-[13px] flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-map-pin-icon lucide-map-pin">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        &nbsp;
                                        <span name="location"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-start-1 col-end-6 m-2 flex flex-col space-y-2">
                        <button id="send-warning-button"
                            class="w-full py-2 px-6 flex items-center justify-center font-semibold tracking-wide border align-middle transition duration-300 ease-in-out text-base text-start rounded-lg hover:bg-sky-600 bg-gradient-to-r from-sky-400 to-sky-600 text-white shadow-sm hover:shadow-md md:ms-2 md:w-auto cursor-pointer group">
                            <svg class="w-5 h-5 mr-2 text-white group-hover:text-yellow-200 transition" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                            </svg>
                            Send a warning
                        </button>
                        <button id="restrict-button"
                            class="w-full py-2 px-6 flex items-center justify-center font-semibold tracking-wide border align-middle transition duration-300 ease-in-out text-base text-left rounded-lg bg-gradient-to-r from-red-500 to-red-700 hover:bg-red-800 text-white shadow-sm hover:shadow-md md:ms-2 md:w-auto cursor-pointer group">
                            <svg class="w-5 h-5 mr-2 text-white group-hover:text-red-200 transition" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 5.636l-1.414-1.414A9 9 0 1 0 21 12h-2a7 7 0 1 1-7-7V3a9 9 0 0 0 6.364 2.636z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                            </svg>
                            Restrict User
                        </button>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <h5 class="text-lg font-semibold">About me :</h5>
                    <p class="text-[14px] ml-2 whitespace-pre-line break-words">
                        <span name="about"></span>
                    </p>

                </div>

            </div>

            <div class="lg:col-span-4 md:col-span-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                    <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                        <h5 class="text-md font-semibold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Job Seeker Information
                        </h5>
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
                                <span class="text-sm font-medium text-gray-600">Job Type</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end" name="job_type"></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Expertise</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end" name="expertise"></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Sex</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end capitalize"
                                name="sex"></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Work experience</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end" name="experience"></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Birthday</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end" name="birthday"></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Age</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end" name="age"></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Education Attainment</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 text-end"
                                name="education">Undergraduate</span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Profile Facebook Link</span>
                            </div>
                            <a href="" target="_black"
                                class="text-sm font-semibold text-sky-600 hover:text-sky-700 hover:underline text-end"
                                name="facebook_link"></a>
                        </div>

                        <div class="flex items-center justify-between py-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Portfolio Link</span>
                            </div>
                            <a href="" target="_black"
                                class="text-sm font-semibold text-sky-600 hover:text-sky-700 hover:underline text-end"
                                name="portfolio_link"></a>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mt-2">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                </svg>
                                Additional File
                            </h3>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-800" id="fileName"></span>
                            </div>
                            <button
                                class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                                id="downloadFile">Download</button>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                </svg>
                                Resume File
                            </h3>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-800" id="resumeName"></span>
                            </div>
                            <button
                                class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                                id="downloadResume">Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container lg:mt-24 mt-16">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h3 class="mb-4 md:text-[26px] md:leading-normal text-2xl leading-normal font-semibold">All Applied
                Jobs
            </h3>
        </div>

        <div id="applied-jobs" class="col-start-1 col-end-7 mt-3 space-y-2">

        </div>
    </div>

    <div id="message-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-50 fixed top-0 left-0 right-0"
        style="display: none">
        <x-message-modal />
    </div>

    <div id="restrict-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-50 fixed top-0 left-0 right-0"
        style="display: none">
        <x-restrict-modal>
            <p>Are you sure you want to restrict this user?</p>
        </x-restrict-modal>
    </div>

    @push('scripts')
        <script>
            const token = "{{ csrf_token() }}"
            const getProfileRoute = "{{ route('admin.seeker.profile') }}"
            const sendMessageRoute = "{{ route('admin.seeker.send.message') }}"
            const appliedJobsRoute = "{{ route('admin.seeker.applied.jobs') }}"
            const pageRoute = "{{ route('admin.seekers') }}";
        </script>
        <script src="{{ asset('js/admin/view-job-seeker.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.view-layout>
