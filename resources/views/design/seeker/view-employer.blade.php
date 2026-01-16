@section('title', 'Employer')
<x-job-seeker.view-layout>

    <div class="container mt-2">
        <div>
            <div id="map" class="w-full h-[300px] border-[1px] border-gray-300"></div>
        </div>
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-8 md:col-span-6 space-y-2">
                <div class="md:flex items-center justify-between p-6 shadow-sm rounded-md bg-white">
                    <div class="md:flex items-center">
                        <img name="profile_pic"
                            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                            class="object-cover w-[80px] h-[80px] border-2 border-sky-800 rounded-xl overflow-hidden mr-5"
                            alt="">
                        <div class="md:mt-0 mt-6">
                            <div class="mt-2">
                                <div class="me-2 inline-block">
                                    <span class="text-gray-700 font-medium text-[14px] flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-briefcase-business-icon lucide-briefcase-business">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg>
                                        &nbsp;
                                        <span name="comp_name"></span>
                                    </span>
                                </div>
                                <h5 class="text-xl font-semibold text-sky-800" name="full_name">Ernisto Espinosa</h5>
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
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-start-1 col-end-6 m-2 flex flex-col space-y-2">
                        <button id="follow-button"
                            class="w-full py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md  text-gray-800 hover:text-white md:ms-2 md:w-auto cursor-pointer">Follow</button>
                        <button id="report-button"
                            class="w-full py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white md:ms-2 md:w-auto cursor-pointer">Report</button>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <h5 class="text-lg font-semibold">About our company:</h5>
                    <p class="text-[14px] ml-2 whitespace-pre-line break-words" name="about">
                    </p>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6">
                <div class="shadow-sm rounded-md bg-white sticky top-20">

                    <div class="p-6 border-t border-gray-200">
                        <h5 class="text-md font-semibold">Employers Information</h5>
                    </div>
                    <div class="p-2">
                        <ul class="list-none">
                            <li class="flex items-center">
                                <div class="ms-4">
                                    <p class="font-medium">Employer Type </p>
                                    <span class="text-sky-800 font-medium text-sm" name="employer_type"></span>
                                </div>
                            </li>

                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Job Type</p>
                                    <span class="text-sky-800 font-medium text-sm" name="job_type"></span>
                                </div>
                            </li>

                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Email</p>
                                    <span class="text-sky-800 font-medium text-sm" name="email"></span>
                                </div>
                            </li>

                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Phone Number </p>
                                    <span class="text-sky-800 font-medium text-sm" name="phone_num"></span>
                                </div>
                            </li>

                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Date Founded</p>
                                    <span class="text-sky-800 font-medium text-sm" name="date_founded"></span>
                                </div>
                            </li>

                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Work Location</p>
                                    <span class="text-sky-800 font-medium text-sm" name="work_location"></span>
                                </div>
                            </li>

                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Company Size</p>
                                    <span class="text-sky-800 font-medium text-sm" name="comp_size"></span>
                                </div>
                            </li>
                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Profile Facebook Link</p>
                                    <a href="" target="_black"
                                        class="text-sky-800 font-medium text-sm hover:underline hover:text-sky-700 duration-200"
                                        name="facebook_link"></a>
                                </div>
                            </li>
                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Valid ID Type</p>
                                    <span class="text-sky-800 font-medium text-sm" name="valid_id_type"></span>
                                </div>
                            </li>
                            <li class="flex items-center mt-3">
                                <div class="ms-4">
                                    <p class="font-medium">Valid ID </p>
                                    <img id="valid-id-preview" onClick="$('#view-id-modal').fadeIn()"
                                        src="https://www.moneymax.ph/hs-fs/hubfs/NBI%20Clearance.png?width=401&height=226&name=NBI%20Clearance.png"
                                        class="object-cover border-1 w-[365px] h-[200px] border-sky-800 rounded-lg overflow-hidden mr-2 cursor-pointer"
                                        alt="">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container lg:mt-24 mt-16">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h3 class="mb-4 md:text-[26px] md:leading-normal text-2xl leading-normal font-semibold">Available Job
                Listings
            </h3>

            <p class="text-gray-400 max-w-xl mx-auto">Search all the open positions on my profile.</p>
        </div>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 mt-8 gap-[30px]" id="posted-jobs-container">
        </div>
    </div>

    <div class="container-fluid md:mt-24 mt-16">
        <div class="container">
            <div class="grid grid-cols-1">
                <div class="relative overflow-hidden lg:px-8 px-6 py-10 rounded-xl shadow-lg">
                    <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                        <div class="lg:col-span-8 md:col-span-7">
                            <div class="md:text-start text-center relative z-1">
                                <h3 class="text-2xl font-semibold text-gray-900  mb-4">Explore a job
                                    now!</h3>
                                <p class="text-gray-400 max-w-xl">Search all the open positions on the web. Apply for
                                    the job that you desire. Read reviews on over 1000+ companies in Borongan City.
                                </p>
                            </div>
                        </div>

                        <div class="lg:col-span-4 md:col-span-5">
                            <div class="text-end relative z-1">
                                <a href="{{ route('js.dashboard') }}"
                                    class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-sky-800 hover:bg-sky-700 border-sky-600 dark:border-sky-600 text-white rounded-md">Search
                                    Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -top-5 -start-5">
                        <div
                            class="uil uil-envelope lg:text-[150px] text-7xl text-gray-900/5 /5 ltr:-rotate-45 rtl:rotate-45">
                        </div>
                    </div>

                    <div class="absolute -bottom-5 -end-5">
                        <div class="uil uil-pen lg:text-[150px] text-7xl text-gray-900/5 /5 rtl:-rotate-90">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="view-id-modal"
        class="mx-auto w-full h-full bg-black/40 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <button id="close-id-modal" onClick="$('#view-id-modal').fadeOut()"
            class="w-fit absolute top-10 right-10 bg-sky-700 text-white py-2 px-4 rounded-lg cursor-pointer">Close</button>
        <img id="valid-id-preview-modal"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGWLz7hgmskaVcEm-qqmTFFTkSIe35ZgoGJg&s"
            class="object-cover w-[80%] h-[80%] border-4 border-sky-600 rounded cursor-pointer">
    </div>

    {{-- REPORT MODAL --}}
    <div id="report-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Report Employer
                    </h3>
                    <button type="button" onclick="$('#report-modal').fadeOut()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="report-form">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="report-title"
                                class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <select id="report-title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full p-2.5">
                                <option selected disabled>-- Select violation --</option>
                                <option value="Mismatched Information">Mismatched Information</option>
                                <option value="Incomplete Documents">Incomplete Documents</option>
                                <option value="Fake or Invalid Credentials">Fake or Invalid Credentials</option>
                                <option value="Profile Picture Violation">Profile Picture Violation</option>
                                <option value="Inappropriate Content">Inappropriate Content</option>
                                <option value="Duplicate Account">Duplicate Account</option>
                                <option value="Invalid Contact Information">Invalid Contact Information</option>
                                <option value="Unverified Identity">Unverified Identity</option>
                                <option value="Incorrect Role or Category">Incorrect Role or Category</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="submit-report"
                        class="w-full text-white bg-sky-700 hover:bg-sky-800 focus:outline-none focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getEmployerDataRoute = "{{ route('js.employer.get.data') }}"
            const getPostedJobsRoute = "{{ route('js.job.get.post') }}"
            const followEmployerRoute = "{{ route('js.employer.follow') }}";
            const checkFollowStatusRoute = "{{ route('js.check.following') }}";
            const reportEmployerRoute = "{{ route('js.employer.report') }}";
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/job-seeker/view-employer.js') }}"></script>
    @endpush
</x-job-seeker.view-layout>
