@section('title', 'Profile')
<x-employer.main-layout heading="Profile">

    <div class="w-full h-fit pb-10">
        <div class="grid md:grid-cols-7 grid-cols-1 gap-6">
            {{-- Profile Header Card --}}
            <div class="col-span-full bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Mobile View -->
                <div class="top-profile md:hidden">
                    <!-- Cover Image -->
                    <div class="h-32 bg-gradient-to-br from-sky-500 via-sky-600 to-blue-600 relative">
                        <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                            <img name="profile_pic"
                                class="h-24 w-24 rounded-xl border-4 border-white object-cover shadow-lg"
                                src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                alt="Profile picture">
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="pt-16 pb-8 px-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            <span name="first_name">Your Name</span>
                            <span name="mid_name"></span>
                            <span name="last_name"></span>
                            <span name="suffix"></span>
                        </h3>
                        <p class="text-gray-600 text-sm mb-6" name="living_location">Where you live in Borongan City</p>

                        <!-- Stats -->
                        <div class="flex justify-center space-x-8 mb-6">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-900" name="followers">0</p>
                                <p class="text-sm text-gray-500">Followers</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-900" name="followings">0</p>
                                <p class="text-sm text-gray-500">Following</p>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <button id="mobile-edit-profile-button"
                            class="editProfileButton w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Desktop View -->
                <div class="top-profile hidden md:flex items-center p-6">
                    <!-- Profile Image -->
                    <div class="relative mr-6">
                        <img name="profile_pic"
                            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                            class="w-24 h-24 rounded-xl object-cover border-4 border-gray-100 shadow-lg">
                        <div
                            class="absolute -bottom-1 -right-1 w-6 h-6 bg-sky-500 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 12h.01" />
                                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                <rect width="20" height="14" x="2" y="6" rx="2" />
                            </svg>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">
                            <span name="first_name">Your Name</span>
                            <span name="mid_name"></span>
                            <span name="last_name"></span>
                            <span name="suffix"></span>
                        </h3>
                        <p class="text-gray-600 mb-4" name="living_location">Where you live in Borongan City</p>

                        <!-- Stats -->
                        <div class="flex space-x-6">
                            <div class="flex items-center space-x-2">
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
                                <div>
                                    <p class="text-lg font-semibold text-gray-900" name="followers">0</p>
                                    <p class="text-xs text-gray-500">Followers</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
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
                                <div>
                                    <p class="text-lg font-semibold text-gray-900" name="followings">0</p>
                                    <p class="text-xs text-gray-500">Following</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="ml-6">
                        <button id="profile-edit-button"
                            class="editProfileButton bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>



            {{-- About Company --}}
            <div
                class="saved col-span-full md:col-span-4 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
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
                        About Our Company
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap break-words" name="about">
                        Tell us about your company, its mission, values, and what makes it a great place to work...
                    </p>
                </div>
            </div>

            {{-- Company Information --}}
            <div
                class="saved col-span-full md:col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                    <h2 class="text-white text-lg font-semibold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Company Information
                    </h2>
                </div>

                <!-- Map Section -->
                <div class="p-4 border-b border-gray-100">
                    <div id="map" class="w-full h-48 border border-gray-200 rounded-lg overflow-hidden z-10">
                    </div>
                </div>

                <!-- Company Details -->
                <div class="p-4 space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
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
                            <span class="text-sm font-medium text-gray-600">Company Name</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900" name="comp_name">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
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
                            <span class="text-sm font-medium text-gray-600">Employer Type</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900" name="employer_type">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
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
                        <span class="text-sm font-semibold text-gray-900" name="email">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Phone Number</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900" name="phone_num">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Date Founded</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900" name="date_founded">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
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
                        <span class="text-sm font-semibold text-gray-900" name="job_type">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
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
                            <span class="text-sm font-medium text-gray-600">Company Size</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-900" name="comp_size">-</span>
                    </div>

                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Facebook Link</span>
                        </div>
                        <a href=""
                            class="text-sm font-semibold text-sky-600 hover:text-sky-700 hover:underline"
                            name="facebook_link">-</a>
                    </div>
                </div>

                <!-- Valid ID Section -->
                <div class="p-4 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <span class="text-sm font-medium text-gray-600">Valid ID Type</span>
                        <div class="w-2"></div>
                        <span name="valid_id_type" class="text-gray-900">-</span>
                    </h3>
                    <img name="valid_id"
                        src="https://philsys.gov.ph/wp-content/uploads/2022/11/PhilID-specimen-Front_highres1-1024x576.png"
                        class="w-full h-48 object-cover border border-gray-200 rounded-lg mb-4" alt="Valid ID">
                </div>

                <!-- Business Permit Section -->
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        </svg>
                        Business Permit
                    </h3>
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            </svg>
                        </div>
                        <input type="file" name="business_permit" style="display:none">
                        <a class="text-sm font-medium text-gray-700 hover:text-sky-600" id="permitName"
                            target="_blank">No file uploaded</a>
                    </div>
                    <button
                        class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                        id="downloadPermit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-2" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7,10 12,15 17,10" />
                            <line x1="12" y1="15" x2="12" y2="3" />
                        </svg>
                        Download
                    </button>
                </div>
            </div>
            {{-- edit profile --}}
            <x-employer.edit-profile />
        </div>

        @push('scripts')
            <script>
                const _token = "{{ csrf_token() }}"
                const getDataProfileRoute = "{{ route('emp.get.profile') }}"
                const getEditDataRoute = "{{ route('emp.get.edit') }}"
                const storeProfileRoute = "{{ route('emp.send.profile') }}"
            </script>
            <script src="{{ asset('js/custom/loader.js') }}"></script>
            <script src="{{ asset('js/employer/profile.js') }}"></script>
        @endpush
</x-employer.main-layout>
