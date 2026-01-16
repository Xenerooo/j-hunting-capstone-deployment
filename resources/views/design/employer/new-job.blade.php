@section('title', 'Post New Job')
<x-employer.main-layout heading="Post New Job">

    <form action="#" class="w-full space-y-6">
        <!-- Map Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden z-20">
            <div class="p-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Job Location
                </h3>
            </div>
            <div id="work_map" class="w-full h-[300px] z-20"></div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-6">
                <!-- Company Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start space-x-4">
                        <div class="relative">
                            <img name="profile_pic"
                                src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                class="object-cover w-20 h-20 border-2 border-sky-100 rounded-xl shadow-sm"
                                alt="Company Logo">
                            <div
                                class="absolute -bottom-1 -right-1 w-6 h-6 bg-sky-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 12h.01" />
                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-500"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 12h.01" />
                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                </svg>
                                <span name="tag_name" class="font-medium"></span>
                            </div>
                            <input type="text" name="job_title"
                                class="w-full text-xl font-bold text-sky-800 bg-transparent border-none focus:outline-none focus:ring-0 placeholder:text-gray-400"
                                placeholder="Enter job title..." />
                            <div class="flex items-center text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-500"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span class="text-gray-700 font-medium">Brgy.</span>
                                <select name="location"
                                    class="ml-2 text-sm bg-transparent border-none focus:outline-none focus:ring-0 text-sky-600 font-medium">
                                    <option value="">Select Barangay</option>
                                    <x-select-barangay />
                                </select>
                                <span class="text-gray-700 font-medium">, Borongan City</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Description Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14,2 14,8 20,8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10,9 9,9 8,9" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Job Description</h3>
                    </div>
                    <textarea name="description" id="about" rows="4"
                        class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent placeholder:text-gray-400 resize-none transition-all duration-200"
                        placeholder="Describe the role, responsibilities, and what makes this opportunity special..."></textarea>
                </div>

                <!-- Image Upload Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21,15 16,10 5,21" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Job Image</h3>
                    </div>
                    <input type="file" id="image-input" name="job_photo" accept="image/*" class="hidden">

                    <div id="preview-container" class="relative mb-4 hidden">
                        <img id="image-preview" class="w-full object-cover rounded-lg shadow-sm" alt="Image Preview">
                        <button id="remove-image-button"
                            class="absolute top-3 right-3 p-2 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-600 transition-colors duration-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    <button id="upload-image" type="button"
                        class="w-full flex items-center justify-center px-6 py-3 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-sky-400 hover:text-sky-600 transition-all duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 group-hover:text-sky-600"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7,10 12,15 17,10" />
                            <line x1="12" y1="15" x2="12" y2="3" />
                        </svg>
                        Choose Image
                    </button>
                </div>

            </div>

            <!-- Job Information Sidebar -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-6">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12h.01" />
                                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                <rect width="20" height="14" x="2" y="6" rx="2" />
                            </svg>
                            Job Information
                        </h3>
                    </div>

                    <!-- Hidden coordinates -->
                    <div class="hidden">
                        <input type="hidden" name="latitude" id="latitude" />
                        <input type="hidden" name="longitude" id="longitude" />
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Employment Type -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Employment Type</label>
                            <select name="employment_type"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                <option value="">Select employment type</option>
                                <x-select-employment-type />
                            </select>
                        </div>

                        <!-- Job Type -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Job Type</label>
                            <select name="job_type"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                <option value="">Select job type</option>
                                <x-select-job-types />
                            </select>
                        </div>

                        <!-- Experience -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Experience Required</label>
                            <div class="flex space-x-2">
                                <input name="experience" type="number" min="0" max="99"
                                    class="flex-1 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                                    placeholder="0">
                                <select name="time-frame"
                                    class="flex-1 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Period</option>
                                    <option value="month/s">Month/s</option>
                                    <option value="year/s">Year/s</option>
                                </select>
                            </div>
                        </div>

                        <!-- Qualifications -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Education Required</label>
                            <select name="qualification"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                <option value="">Select education level</option>
                                <x-select-education />
                            </select>
                        </div>

                        <!-- Max Applicants -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Number of Applicants Needed</label>
                            <input name="max_applicant" type="number" min="1"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                                placeholder="Enter number of applicants">
                        </div>

                        <!-- Salary -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Salary</label>
                            <div class="grid grid-cols-1 sm:grid-cols-6 gap-2">
                                <div
                                    class="col-span-1 flex items-center px-1 py-2.5 bg-gray-50 border border-gray-200 rounded-lg justify-center">
                                    <span class="text-sky-600 font-semibold">₱</span>
                                </div>
                                <input name="salary" type="number" min="400"
                                    class="col-span-2 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 w-full"
                                    placeholder="Amount">
                                <select name="salary_basis"
                                    class="col-span-3 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 w-full">
                                    <option value="">Period</option>
                                    <x-select-salary-basis />
                                </select>
                            </div>
                        </div>

                        <!-- Date Posted -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Date Posted</label>
                            <div class="px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="text-sky-600 font-medium text-sm"
                                    name="date_posted">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span>
                            </div>
                        </div>

                        <!-- Expiration Date -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Application Deadline</label>
                            <input type="date" name="expiration_date"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button id="upload-job" type="submit"
                                class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-sky-500 to-blue-600 text-white font-semibold rounded-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7,10 12,15 17,10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                                Post Job
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>


    @push('scripts')
        <script>
            const getEmployerDataRoute = "{{ route('emp.post.job.get.data') }}";
            const postJobRoute = "{{ route('emp.post.job') }}";
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/employer/post-job.js') }}"></script>
    @endpush
</x-employer.main-layout>
