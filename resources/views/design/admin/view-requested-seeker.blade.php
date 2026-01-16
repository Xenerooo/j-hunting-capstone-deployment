@section('title', 'Requested Job Seeker')
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

        <div class="container relative z-10 py-4">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-6">
                <div class="col-span-12">
                    <div
                        class="w-full md:flex items-center p-6 bg-white/90 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-sm">
                        <div class="w-full md:w-auto flex items-start justify-center md:justify-start">
                            <img name="profile_pic"
                                src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                class="object-cover w-[80px] h-[80px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-5 shadow"
                                alt="">
                        </div>

                        <div class="flex flex-col justify-center md:justify-start items-center md:items-start">
                            <h5 class="text-2xl font-bold text-sky-800" name="full_name"></h5>
                            <h5 class="text-sm font-medium text-gray-600" name="email"></h5>
                        </div>

                        <div class="ml-auto flex flex-col items-center justify-center gap-2 mt-4 md:mt-0">
                            <button id="approve-button" data-modal-target="approveModal"
                                data-modal-toggle="approveModal"
                                class="w-full py-2 px-4 font-semibold rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 text-white hover:from-emerald-600 hover:to-green-700 shadow-sm transition">Approve</button>
                            <button id="decline-button"
                                class="w-full py-2 px-4 font-semibold rounded-xl bg-gradient-to-r from-rose-500 to-red-600 text-white hover:from-rose-600 hover:to-red-700 shadow-sm transition">Decline</button>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-7">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                            <h5 class="text-lg font-semibold text-white flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                Personal Information
                            </h5>
                        </div>
                        <div class="p-6 space-y-4">
                            <ul class="list-none space-y-4">
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Birthday</p><span
                                            class="text-sky-800 font-medium text-lg" name="birthday"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Age</p><span class="text-sky-800 font-medium text-lg"
                                            name="age"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Sex</p><span class="text-sky-800 font-medium text-lg"
                                            name="sex"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Location</p><span
                                            class="text-sky-800 font-medium text-lg" name="location"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Mobile Number</p><span
                                            class="text-sky-800 font-medium text-lg" name="phone_num"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Profile Facebook Link</p><a href=""
                                            target="_black"
                                            class="text-sky-800 font-medium text-lg hover:underline hover:text-sky-700 duration-200"
                                            name="facebook_link"></a>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0 w-full">
                                        <p class="font-medium">About me</p>
                                        <div class="w-full min-h-52 border border-sky-100 rounded-xl bg-white/90">
                                            <p class="text-lg text-gray-700 p-3 whitespace-pre-wrap break-words"
                                                name="about"></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-5">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                            <h5 class="text-lg font-semibold text-white flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                Work experience and skills
                            </h5>
                        </div>
                        <div class="p-6 space-y-4">
                            <ul class="list-none space-y-4">
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Job type</p><span
                                            class="text-sky-800 font-medium text-lg" name="job_type"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Expertise</p><span
                                            class="text-sky-800 font-medium text-lg" name="expertise"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Experience</p><span
                                            class="text-sky-800 font-medium text-lg" name="experience"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Education Attainment</p><span
                                            class="text-sky-800 font-medium text-lg" name="education"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Portfolio Link</p><a href="" target="_black"
                                            class="text-sky-800 font-medium text-lg hover:underline hover:text-sky-700 duration-200"
                                            name="portfolio_link"></a>
                                    </div>
                                </li>
                                <div
                                    class="flex-col items-start justify-between text-[14px] border border-sky-100 rounded-xl p-4 bg-white">
                                    <p class="font-medium">Additional File</p>
                                    <div class="flex w-full items-center mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-file">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        </svg>
                                        <input type="file" name="additional_file" style="display:none">
                                        <a class="text-gray-800 text-[16px] ml-3" id="additionalFileName"
                                            target="_blank"></a>
                                    </div>
                                    <button
                                        class="mt-3 w-full bg-gradient-to-r from-sky-600 to-blue-600 text-white py-2 rounded-lg shadow-sm hover:shadow-md hover:from-sky-700 hover:to-blue-700 transition"
                                        id="downloadFile">Download</button>
                                </div>
                                <div
                                    class="flex-col items-start justify-between text-[14px] border border-sky-100 rounded-xl p-4 bg-white">
                                    <p class="font-medium">Resume File</p>
                                    <div class="flex w-full items-center mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-file">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        </svg>
                                        <input type="file" name="resume" style="display:none">
                                        <a class="text-gray-800 text-[16px] ml-3" id="resumeName"
                                            target="_blank"></a>
                                    </div>
                                    <button
                                        class="mt-3 w-full bg-gradient-to-r from-sky-600 to-blue-600 text-white py-2 rounded-lg shadow-sm hover:shadow-md hover:from-sky-700 hover:to-blue-700 transition"
                                        id="downloadResume">Download</button>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="message-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-50 fixed top-0 left-0 right-0"
        style="display: none">
        <x-message-modal />
    </div>

    <div id="approve-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-50 fixed top-0 left-0 right-0"
        style="display: none">
        <x-approve-modal>
            <p>Are you sure you want to approve this job seeker?</p>
        </x-approve-modal>
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
            const token = "{{ csrf_token() }}"
            const getProfileRoute = "{{ route('admin.get.requested.seeker') }}"
            const approvalRoute = "{{ route('admin.seeker.approval') }}"
            const pageRoute = "{{ route('admin.request.seeker') }}"
        </script>
        <script src="{{ asset('js/admin/view-requested-seeker.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.view-layout>
