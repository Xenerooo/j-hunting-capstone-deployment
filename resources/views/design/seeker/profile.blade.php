@section('title', 'Profile')
<x-job-seeker.main-layout heading="Profile">

    <div class="w-full h-fit pb-10">
        <div class="grid md:grid-cols-7 grid-cols-1 gap-[10px]">
            {{-- Profile details --}}

            {{-- kanan mobile view --}}
            <div
                class="top-profile col-start-1 col-end-7 bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl md:hidden block">
                <!-- Cover Image -->
                <div class="h-32 bg-gradient-to-t from-white to-sky-500 relative">
                    <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                        <img name="profile_pic" class="h-24 w-24 rounded-full border-2 border-white object-cover"
                            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                            alt="Profile picture">
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="pt-16 pb-8 px-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800">
                        <span name="first_name">Your Name</span>
                        <span name="mid_name"></span>
                        <span name="last_name"></span>
                        <span name="suffix"></span>
                    </h3>
                    <p class="text-gray-500 mt-2 text-sm">Brgy. &nbsp; <span name="barangay">Your barangay</span>,
                        &nbsp;<span name="city">Borongan City</span></p>

                    <!-- Stats -->
                    <div class="flex justify-center space-x-6 mt-6">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-800" name="followers"></p>
                            <p class="text-sm text-gray-500">Followers</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-800" name="followings"></p>
                            <p class="text-sm text-gray-500">Following</p>
                        </div>
                    </div>

                    <!-- Edit Buttons -->
                    <div class="mt-8 flex justify-center space-x-3">
                        <button id="mobile-edit-profile-button"
                            class="editProfileButton flex-1 bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            {{-- kanan desktop view --}}
            <div
                class="top-profile col-span-7 h-fit bg-gray-50 rounded-xl shadow-lg overflow-hidden p-3 flex-row md:flex items-center hidden">
                <div class="w-full h-full flex items-center">
                    {{-- Image --}}
                    <img name="profile_pic"
                        src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                        class="object-cover w-[80px] h-[80px] md:w-[120px] md:h-[120px] rounded-full overflow-hidden border-2 border-sky-800 mr-5">

                    {{-- name, location --}}
                    <div class="flex flex-col gap-1 h-full w-fit justify-center">
                        <p class="mt-2 text-[1.2rem] md:text-[1.6rem] font-semibold text-sky-600/90">
                            <span name="first_name">Your Name</span>
                            <span name="mid_name"></span>
                            <span name="last_name"></span>
                            <span name="suffix"></span>
                        </p>
                        <p class="text-gray-800 flex items-center text-[9px] md:text-sm" name="profileLocation">
                            Brgy.&nbsp; <span name="barangay">Your barangay</span>, &nbsp;<span name="city">Borongan
                                City</span>
                        </p>

                        <div class="w-[170px] flex-row md:flex justify-between items-center text-[8px] md:text-[12px]">
                            <p class="text-gray-500 font-semibold" title="Followers">
                                <span name="followers"></span> Followers
                            </p>
                            <p class="text-gray-500 font-semibold" title="Following">
                                <span name="followings"></span> Following
                            </p>
                        </div>
                    </div>
                </div>

                {{-- edit button --}}
                <div class="w-1/3 h-full flex items-center justify-end mr-5">
                    <Button id="profile-edit-button"
                        class="editProfileButton bg-sky-600 hover:bg-sky-700 px-3 py-2 shadow rounded text-[10px] md:text-[1rem] text-gray-100 hover:bg-green-sky duration-200 cursor-pointer">
                        Edit Profile
                    </Button>
                </div>
            </div>



            {{-- About me --}}
            <div
                class="saved col-start-1 col-end-7 md:col-start-1 md:col-end-5 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="w-full h-fit bg-sky-600 p-2">
                    <h1 class="text-white">About Me</h1>
                </div>

                <div class="w-full h-full">
                    <p class="text-[14px] text-gray-800 p-2 whitespace-pre-wrap break-words" name="about">
                    </p>
                </div>
            </div>

            {{-- Important details --}}
            <div
                class="saved col-start-1 col-end-7 md:col-start-5 md:col-end-8 h-fit bg-white rounded-lg shadow-lg overflow-hidden">
                <h1 class="w-full h-fit bg-sky-600 text-white p-2">My Information
                </h1>
                <div class="flex-col p-2">
                    <ul class="list-none">
                        {{-- Job Type --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Job Type</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="job_type"></span>
                            </div>
                        </li>

                        {{-- Expertise --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Expertise</span>
                                <span class="text-sky-800 font-medium text-sm capitalize text-end"
                                    name="expertise"></span>
                            </div>
                        </li>

                        {{-- Sex --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Sex</span>
                                <span class="text-sky-800 font-medium text-sm capitalize text-end"
                                    name="sex"></span>
                            </div>
                        </li>

                        {{-- Phone Number --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Phone Number</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="phone_num"></span>
                            </div>
                        </li>
                        {{-- Email --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Email</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="email"></span>
                            </div>
                        </li>
                        {{-- Work Experience --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Work Experience</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="experience"></span>
                            </div>
                        </li>
                        {{-- Birthday --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Birthday</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="birthday"></span>
                            </div>
                        </li>
                        {{-- Age --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Age</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="age"></span>
                            </div>
                        </li>
                        {{-- Education Attainment --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Education Attainment</span>
                                <span class="text-sky-800 font-medium text-sm text-end" name="education"></span>
                            </div>
                        </li>
                        {{-- Facebook Link --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Facebook Link</span>
                                <a href="" class="text-sky-600 hover:underline text-end"
                                    name="facebook_link"></a>
                            </div>
                        </li>
                        {{-- Portfolio Link --}}
                        <li class="text-[14px] border-b border-gray-600/20 pb-3 p-1 my-4 mx-1">
                            <div class="mx-4 w-full flex items-center justify-between">
                                <span class="font-medium">Portfolio Link</span>
                                <a href="" class="text-sky-600 hover:underline text-end"
                                    name="portfolio_link"></a>
                            </div>
                        </li>
                    </ul>

                    {{-- Additional File --}}
                    <div
                        class="flex-col items-center justify-between text-[14px] border-b border-gray-600/20 pb-3 p-2 my-4 mx-1 bg-gray-50 rounded-md">
                        <span class="font-medium">Additional File</span>

                        <div class="flex w-full h-10 items-center justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-file-icon lucide-file">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            </svg>
                            <input type="file" name="file" style="display:none">
                            <a class="text-gray-800 text-[16px] ml-3" id="fileName" target="_blank"></a>
                        </div>
                        <button class="w-full bg-sky-800 text-white py-2 rounded-lg cursor-pointer"
                            id="downloadFile">Download
                            File</button>
                    </div>

                    {{-- Resume --}}
                    <div
                        class="flex-col items-center justify-between text-[14px] border-b border-gray-600/20 pb-3 p-2 my-4 mx-1 bg-gray-50 rounded-md">

                        <span class="font-medium">Resume</span>

                        <div class="flex w-full h-10 items-center justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-file-icon lucide-file">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            </svg>
                            <input type="file" name="resume" style="display:none">
                            <a class="text-gray-800 text-[16px] ml-3" id="resumeName" target="_blank"></a>
                        </div>
                        <button class="w-full bg-sky-800 text-white py-2 rounded-lg cursor-pointer"
                            id="downloadResume">Download</button>
                    </div>


                </div>
            </div>

            {{-- Recent applied --}}
            {{-- <x-job-seeker.recent-applied /> --}}
            {{-- edit profile --}}
            <x-job-seeker.edit-profile />
        </div>

        @push('scripts')
            <script>
                const getDataProfileRoute = "{{ route('js.get.profile') }}"
                const editProfileRoute = "{{ route('js.send.profile') }}"
                const getEditDataRoute = "{{ route('js.get.edit') }}"
                const uploadPortfolioRoute = "{{ route('js.upload.portfolio') }}"
            </script>
            <script src="{{ asset('js/custom/loader.js') }}"></script>
            <script src="{{ asset('js/job-seeker/profile.js') }}"></script>
        @endpush
</x-job-seeker.main-layout>
