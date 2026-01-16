@section('title', 'Requested Employer')
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
                    <!-- Work location map -->
                    <div class="p-4 my-2 rounded-2xl bg-white/90 backdrop-blur-sm border border-sky-100 shadow-sm">
                        <h2 class="text-md font-semibold mb-3">Work location</h2>
                        <div id="map" class="w-full h-[300px] rounded-xl border border-sky-100"></div>
                    </div>

                    <!-- Profile header -->
                    <div
                        class="w-full md:flex items-center p-6 bg-white/90 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-sm">
                        <div class="w-full md:w-auto flex items-start justify-center md:justify-start">
                            <img name="profile_pic"
                                src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                class="object-cover w-[80px] h-[80px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-5 shadow"
                                alt="">
                        </div>

                        <div class="flex flex-col justify-center md:justify-start items-center md:items-start">
                            <h5 class="text-xs font-semibold text-sky-700" name="job_type">Job Type</h5>
                            <h5 class="text-2xl font-bold text-sky-800" name="full_name">Full Name</h5>
                            <h5 class="text-sm font-medium text-gray-600" name="email">Email</h5>
                        </div>

                        <div class="ml-auto flex flex-col items-center justify-center gap-2 mt-4 md:mt-0">
                            <button id="approve-button"
                                class="w-full py-2 px-4 font-semibold rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 text-white hover:from-emerald-600 hover:to-green-700 shadow-sm transition">Approve</button>
                            <button id="decline-button"
                                class="w-full py-2 px-4 font-semibold rounded-xl bg-gradient-to-r from-rose-500 to-red-600 text-white hover:from-rose-600 hover:to-red-700 shadow-sm transition">Decline</button>
                        </div>
                    </div>
                </div>

                <!-- Business Info -->
                <div class="col-span-12 md:col-span-7">
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
                                Business Information
                            </h5>
                        </div>
                        <div class="p-6 space-y-4">
                            <ul class="list-none space-y-4">
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Employer type</p><span
                                            class="text-sky-800 font-medium text-sm" name="employer_type"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Company Name</p><span
                                            class="text-sky-800 font-medium text-sm" name="comp_name"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Date Founded</p><span
                                            class="text-sky-800 font-medium text-sm" name="date_founded"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Company Size</p><span
                                            class="text-sky-800 font-medium text-sm" name="comp_size"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Work Location</p><span
                                            class="text-sky-800 font-medium text-sm" name="work_location"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Location</p><span
                                            class="text-sky-800 font-medium text-sm" name="location"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Mobile Number</p><span
                                            class="text-sky-800 font-medium text-sm" name="phone_num"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Profile Facebook Link</p><a href=""
                                            target="_black"
                                            class="text-sky-800 font-medium text-sm hover:underline hover:text-sky-700 duration-200"
                                            name="facebook_link"></a>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0 w-full">
                                        <p class="font-medium">About me</p>
                                        <div class="w-full min-h-52 border border-sky-100 rounded-xl bg-white/90">
                                            <p class="text-[14px] text-gray-700 p-3 whitespace-pre-wrap break-words"
                                                name="about"></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="col-span-12 md:col-span-5">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-20">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-4">
                            <h5 class="text-lg font-semibold text-white flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                </svg>
                                Documents
                            </h5>
                        </div>
                        <div class="p-6 space-y-4">
                            <ul class="list-none space-y-4">
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Valid ID Type</p><span
                                            class="text-sky-800 font-medium text-sm" name="valid_id_type"></span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="ms-0">
                                        <p class="font-medium">Valid ID</p><img id="valid-id-preview"
                                            onClick="$('#view-id-modal').fadeIn()"
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGWLz7hgmskaVcEm-qqmTFFTkSIe35ZgoGJg&s"
                                            class="object-cover w-96 max-h-56 border border-sky-200 rounded-lg cursor-pointer">
                                    </div>
                                </li>
                                <div
                                    class="flex-col items-start justify-between border border-sky-100 rounded-xl p-4 bg-white">
                                    <p class="font-medium">Business Permit</p>
                                    <div class="flex items-center mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-file">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        </svg>
                                        <a href="" target="_blank" class="text-gray-800 text-[16px] ml-3"
                                            name="permit_name"></a>
                                    </div>
                                    <button
                                        class="mt-3 w-full bg-gradient-to-r from-sky-600 to-blue-600 text-white py-2 rounded-lg shadow-sm hover:shadow-md hover:from-sky-700 hover:to-blue-700 transition"
                                        id="permit_download">Download</button>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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

    <div id="message-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <x-message-modal />
    </div>

    <div id="approve-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <x-approve-modal>
            <p>Are you sure you want to approve this employer?</p>
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
            const token = "{{ csrf_token() }}";
            const getProfileRoute = "{{ route('admin.employer.get.profile') }}";
            const approvalRoute = "{{ route('admin.employer.approval') }}";
            const pageRoute = "{{ route('admin.request.employer') }}";
        </script>
        <script src="{{ asset('js/admin/view-request-employer.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.view-layout>
