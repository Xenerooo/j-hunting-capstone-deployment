@section('title', 'Job')
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
            <div class="mb-4">
                <div id="map" class="w-full h-[300px] rounded-2xl border border-sky-100 shadow-lg"></div>
            </div>
            <div class="grid md:grid-cols-12 grid-cols-1 gap-6">
                <div class="lg:col-span-8 md:col-span-6 space-y-4">
                    <div
                        class="md:flex items-center p-6 bg-white/90 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-sm">
                        <img name="profile_pic"
                            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                            class="object-cover w-[80px] h-[80px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-5 shadow"
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

                    <div class="bg-white/90 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-sm p-6">
                        <h5 class="text-lg font-semibold mb-2">Job Description:</h5>
                        <div class="desc-wrapper relative overflow-hidden h-fit transition-all duration-300">
                            <p class="text-[14px] whitespace-pre-line break-words text-gray-700" name="description"></p>
                        </div>
                    </div>
                    <div name="job_photo"
                        class="bg-white/90 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-sm p-4">
                        <img src="{{ asset('assets/images/default-job-photo.png') }}" alt=""
                            class="w-full rounded-xl">
                    </div>
                </div>

                <div class="lg:col-span-4 md:col-span-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                            <h5 class="text-lg font-semibold text-white flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 12h.01" />
                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                </svg>
                                Job Information
                            </h5>
                        </div>
                        <div class="p-6 space-y-4">
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
                                    <span class="text-sm font-medium text-gray-600">Employment Type</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end"
                                    name="employment_type"></span>
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
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">Experience</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end"
                                    name="experience_level"></span>
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
                                    <span class="text-sm font-medium text-gray-600">Qualifications</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end"
                                    name="education_level"></span>
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
                                    <span class="text-sm font-medium text-gray-600">Salary</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="salary"></span>
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
                                    <span class="text-sm font-medium text-gray-600">Hired Applicants</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end"
                                    name="hired_applicant"></span>
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
                                    <span class="text-sm font-medium text-gray-600">Date Posted</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="date_posted"></span>
                            </div>

                            <div class="flex items-center justify-between py-2">
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
                                    <span class="text-sm font-medium text-gray-600">Expiration Date</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 text-end" name="deadline"></span>
                            </div>

                            <div class="col-start-1 col-end-6 mt-2 space-y-2">
                                <button
                                    class="w-full py-2 px-4 font-semibold rounded-xl border bg-white text-sky-700 border-sky-300 hover:bg-sky-50 hover:border-sky-400 transition"
                                    id="send-warning-button">Send Warning</button>
                                <button
                                    class="w-full py-2 px-4 font-semibold rounded-xl bg-gradient-to-r from-rose-500 to-red-600 text-white hover:from-rose-600 hover:to-red-700 shadow-sm transition"
                                    id="restrict-button">Restrict Job</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="message-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <x-message-modal />
    </div>

    <div id="restrict-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <x-restrict-modal>
            <p>Are you sure you want to restrict this job?</p>
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
            const defaultJobPhoto = "{{ asset('assets/images/default-job-photo.png') }}"
            const token = "{{ csrf_token() }}";
            const getJobRoute = "{{ route('admin.job.get.details') }}";
            const pageRoute = "{{ route('admin.jobs') }}";
            const sendMessageRoute = "{{ route('admin.job.send.message') }}";
        </script>
        <script src="{{ asset('js/admin/view-job.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.view-layout>
