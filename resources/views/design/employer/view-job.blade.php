@section('title', 'Job')
<x-employer.view-layout>
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
            <div class="mb-4">
                <div id="map" class="w-full h-[300px] rounded-2xl border border-sky-100 shadow-lg"></div>
            </div>
            <div class="grid md:grid-cols-12 grid-cols-1 gap-6">
                <div class="lg:col-span-8 md:col-span-6 space-y-4">
                    <div
                        class="md:flex items-center p-6 bg-white/85 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg">
                        <img name="profile_pic"
                            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                            class="object-cover w-[80px] h-[80px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-5"
                            alt="">
                        <div class="md:ms-4 md:mt-0 mt-4">
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
                                    <div name="tag_name"></div>
                                </div>
                                <h5 class="text-2xl font-bold text-sky-800 leading-tight" name="job_title"></h5>
                                <div class="inline-flex items-center gap-2 text-gray-700 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span name="location"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/85 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg p-6">
                        <h5 class="text-lg font-semibold mb-2">Job Description:</h5>
                        <div class="desc-wrapper relative overflow-hidden h-fit transition-all duration-300">
                            <p class="text-[14px] whitespace-pre-line break-words text-gray-700" name="description"></p>
                        </div>
                    </div>
                    <div name="job_photo"
                        class="bg-white/85 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg p-4">
                        <img src="{{ asset('assets/images/default-job-photo.png') }}" alt=""
                            class="w-full rounded-xl">
                    </div>
                </div>

                <div class="lg:col-span-4 md:col-span-6">
                    <div class="bg-white/85 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg sticky top-20">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">Job Information</h5>
                        </div>
                        <div class="p-4 border-t border-gray-100">
                            <ul class="list-none space-y-3">
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
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
                                        <span class="text-sm font-medium text-gray-600">Employment Type</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900" name="employment_type"></span>
                                </li>
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
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
                                    <span class="text-sm font-semibold text-gray-900" name="job_type"></span>
                                </li>
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
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
                                    <span class="text-sm font-semibold text-gray-900" name="experience_level"></span>
                                </li>
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                                <path
                                                    d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">Qualifications</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900" name="education_level"></span>
                                </li>
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 1v22" />
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H15a3.5 3.5 0 0 1 0 7H6" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">Salary</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900" name="salary"></span>
                                </li>
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
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
                                        <span class="text-sm font-medium text-gray-600">Hired Applicants</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900" name="hired_applicant"></span>
                                </li>
                                <li class="flex items-center justify-between py-2 border-b border-gray-100">
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
                                        <span class="text-sm font-medium text-gray-600">Date Posted</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900" name="created_at"></span>
                                </li>
                                <li class="flex items-center justify-between py-2">
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
                                        <span class="text-sm font-medium text-gray-600">Expiration Date</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900" name="deadline_at"></span>
                                </li>
                            </ul>
                            <div class="col-start-1 col-end-6 m-2 space-y-2">
                                <button
                                    class="w-full py-2 px-4 font-semibold rounded-xl bg-gradient-to-r from-rose-500 to-red-600 text-white hover:from-rose-600 hover:to-red-700 shadow-sm transition"
                                    id="delete-job">Delete Job</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <div id="delete-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <div>
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                    <button type="button" onclick="$('#delete-modal').fadeOut()"
                        class="text-gray-600 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center cursor-pointer">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-trash2-icon lucide-trash-2 text-gray-600 w-11 h-11 mb-3.5 mx-auto">
                        <path d="M10 11v6" />
                        <path d="M14 11v6" />
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                        <path d="M3 6h18" />
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                    </svg>
                    <p class="mb-4 text-gray-600">Are you sure you want to delete this job?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button type="button" onclick="$('#delete-modal').fadeOut()"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-0 focus:outline-none cursor-pointer">
                            No, cancel
                        </button>
                        <button type="submit" id="confirm-delete"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-0 focus:outline-none cursor-pointer">
                            Yes, I'm sure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getJobDataRoute = "{{ route('emp.posted.jobs.data') }}"
            const defaultJobPhoto = "{{ asset('assets/images/default-job-photo.png') }}"
            const deleteJobRoute = "{{ route('emp.job.delete') }}"
            const goBackRoute = "{{ route('emp.posted.jobs') }}"
        </script>
        <script src="{{ asset('js/employer/view-job.js') }}"></script>
    @endpush
</x-employer.view-layout>
