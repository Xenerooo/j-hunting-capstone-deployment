@section('title', 'Applicant')

<x-employer.view-layout>
    <div class="container mt-2">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-8">
            <div class="lg:col-span-8 md:col-span-6 space-y-6">
                {{-- Applicant Profile Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-visible">
                    <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4 rounded-t-xl">
                        <h2 class="text-white text-xl font-semibold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Applicant Profile
                        </h2>
                    </div>

                    <div class="p-6">
                        <div
                            class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6 z-10">
                            {{-- Profile Image --}}
                            <div class="relative">
                                <img name="profile_pic"
                                    src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                    class="w-24 h-24 rounded-xl object-cover border-4 border-gray-100 shadow-lg"
                                    alt="Profile picture">
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-sky-500 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Profile Details --}}
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2" name="full_name">Applicant Name</h3>
                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span name="location">Location</span>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col space-y-3 w-full md:w-auto" id="button-container">
                                <span id="responded"
                                    class="hidden w-full py-2 px-6 font-semibold text-center rounded-lg bg-gray-600 text-white"></span>

                                <div name="not-responded" x-data="{ open: false }" class="relative w-full hidden">
                                    <button @click="open = !open"
                                        class="w-full py-2 px-6 font-semibold text-center rounded-lg bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 6L9 17l-5-5" />
                                        </svg>
                                        Accept
                                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-2 transition-transform"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute left-0 mt-2 w-full bg-white border border-gray-200 rounded-lg shadow-xl z-40">
                                        <button id="for-interview"
                                            class="w-full text-left px-4 py-3 text-gray-700 hover:bg-sky-50 duration-200 cursor-pointer border-b border-gray-100 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3 text-sky-600"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                    ry="2" />
                                                <line x1="16" y1="2" x2="16" y2="6" />
                                                <line x1="8" y1="2" x2="8" y2="6" />
                                                <line x1="3" y1="10" x2="21" y2="10" />
                                            </svg>
                                            Accept for Interview
                                        </button>
                                        <button id="for-job"
                                            class="w-full text-left px-4 py-3 text-gray-700 hover:bg-sky-50 duration-200 cursor-pointer flex items-center"
                                            @click="open = false">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4 mr-3 text-green-600" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 6L9 17l-5-5" />
                                            </svg>
                                            Accept for Job
                                        </button>
                                    </div>
                                </div>

                                <button id="reject-button" name="not-responded"
                                    class="hidden flex flex-row w-full py-2 px-6 font-semibold text-center rounded-lg bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 items-center justify-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M18 6L6 18" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                    Reject
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- About Section --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                        <h2 class="text-white text-lg font-semibold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            About Me
                        </h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line break-words">
                            <span name="about">About information will be displayed here...</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6">
                {{-- Job Seeker Information Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                    <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                        <h2 class="text-white text-lg font-semibold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Job Seeker Information
                        </h2>
                    </div>

                    <div class="p-6 space-y-4">
                        {{-- Personal Information --}}
                        <div class="space-y-3">
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
                                <span class="text-sm font-semibold text-gray-900 text-end" name="job_type">-</span>
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
                                    <span class="text-sm font-medium text-gray-600">Expertise</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="expertise">-</span>
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
                                    <span class="text-sm font-medium text-gray-600">Gender</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="sex">-</span>
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
                                    <span class="text-sm font-medium text-gray-600">Phone</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="phone_num">-</span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Email</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="email">-</span>
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
                                    <span class="text-sm font-medium text-gray-600">Experience</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="experience">-</span>
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
                                    <span class="text-sm font-medium text-gray-600">Birthday</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="birthday">-</span>
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
                                    <span class="text-sm font-medium text-gray-600">Age</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="age">-</span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Education</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="education">-</span>
                            </div>

                            <div class="flex items-center justify-between py-2">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Facebook</span>
                                </div>
                                <a href="" target="_blank"
                                    class="text-sm text-end font-semibold text-sky-600 hover:text-sky-700 hover:underline"
                                    name="facebook_link">-</a>
                            </div>

                            <div class="flex items-center justify-between py-2">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Portfolio</span>
                                </div>
                                <a href="" target="_blank"
                                    class="text-sm font-semibold text-sky-600 hover:text-sky-700 hover:underline"
                                    name="portfolio_link">-</a>
                            </div>
                        </div>

                        {{-- File Downloads --}}
                        <div class="mt-6 space-y-4">
                            {{-- Additional File --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
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
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800" id="fileName">No file
                                        uploaded</span>
                                </div>
                                <button
                                    class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                                    id="downloadFile">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-2"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7,10 12,15 17,10" />
                                        <line x1="12" y1="15" x2="12" y2="3" />
                                    </svg>
                                    Download
                                </button>
                            </div>

                            {{-- Resume File --}}
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
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800" id="resumeName">No file
                                        uploaded</span>
                                </div>
                                <button
                                    class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                                    id="downloadResume">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-2"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7,10 12,15 17,10" />
                                        <line x1="12" y1="15" x2="12" y2="3" />
                                    </svg>
                                    Download
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--FOR INTERVIEW MODAL -->
    <div id="interview-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
                <!-- Modal header -->
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-white text-xl font-semibold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Set Interview Schedule
                        </h3>
                        <button type="button" onclick="$('#interview-modal').fadeOut()"
                            class="text-white bg-transparent hover:bg-white/20 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center cursor-pointer transition-colors">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <!-- Modal body -->
                <form class="p-6">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="interview_date" class="block text-sm font-medium text-gray-700">
                                Interview Date
                            </label>
                            <input type="datetime-local" id="interview_date" name="interview_date"
                                class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                                placeholder="YYYY-MM-DDThh:mm">
                            <small class="text-gray-500">Format: MM-DD-YYYY hh:mm (24-hour)</small>
                        </div>

                        <div class="space-y-2">
                            <label for="mode" class="block text-sm font-medium text-gray-700">
                                Interview Mode
                            </label>
                            <select id="mode" name="mode"
                                class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                <option selected disabled>-- Select mode --</option>
                                <option value="in-person">In-person</option>
                                <option value="online">Online</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="detail" class="block text-sm font-medium text-gray-700">
                                Link/Address
                            </label>
                            <input type="text" id="detail" name="detail"
                                class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                                placeholder="Enter the link or address of the meeting...">
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <button type="button" onclick="$('#interview-modal').fadeOut()"
                            class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" id="submit-schedule"
                            class="px-8 py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Submit Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- REJECT MODAL -->
    <div id="reject-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
                <!-- Modal header -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-white text-xl font-semibold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 6L6 18" />
                                <path d="M6 6l12 12" />
                            </svg>
                            Reject Applicant
                        </h3>
                        <button type="button" onclick="$('#reject-modal').fadeOut()"
                            class="text-white bg-transparent hover:bg-white/20 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center cursor-pointer transition-colors">
                            <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>

                <!-- Modal body -->
                <div class="p-6 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6L6 18" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Confirm Rejection</h4>
                    <p class="text-gray-600 mb-6">Are you sure you want to reject this job seeker? This action cannot
                        be undone.</p>

                    <div class="flex justify-center items-center space-x-4">
                        <button type="button" onclick="$('#reject-modal').fadeOut()"
                            class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" id="confirm-reject"
                            class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 6L6 18" />
                                <path d="M6 6l12 12" />
                            </svg>
                            Yes, Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            const getApplicantDataRoute = "{{ route('emp.applicant.get.data') }}";
            const acceptApplicantRoute = "{{ route('emp.applicant.accept') }}";
            const rejectApplicantRoute = "{{ route('emp.applicant.reject') }}";
            const checkApplicantRoute = "{{ route('emp.applicant.check') }}";
        </script>
        <script src="{{ asset('js/employer/view-applicant.js') }}"></script>
    @endpush
</x-employer.view-layout>
