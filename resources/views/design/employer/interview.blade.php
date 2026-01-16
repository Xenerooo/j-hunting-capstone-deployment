@section('title', 'Job Interview')
<x-employer.main-layout heading="Job Interview">
    <!-- Filters and Search Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Sort Filters -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18" />
                        <path d="M7 12h10" />
                        <path d="M10 18h4" />
                    </svg>
                    <label for="select_sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                    <select id="select_sort"
                        class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 w-28 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="all">All</option>
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                </div>

                <div class="flex items-center space-x-3">
                    <span class="text-gray-500 text-sm font-medium">OR</span>
                </div>

                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <label for="sort_date" class="text-sm font-medium text-gray-700">Schedule:</label>
                    <input type="date" name="sort_date" id="sort_date"
                        class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                </div>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </div>
                    <input name="search_input"
                        class="w-full pl-10 pr-20 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                        placeholder="Search for job name..." />
                    <button name="search_button"
                        class="absolute inset-y-0 right-0 flex items-center px-4 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-r-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Interviews Grid Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="interview-container">
    </div>

    <!-- Interview Details Modal -->
    <div id="interview-details-modal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
        style="display: none">
        <div
            class="bg-white rounded-xl shadow-xl border border-gray-200 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Interview Schedule
                </h3>
                <button type="button" onclick="$('#interview-details-modal').fadeOut()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="p-6" id="interview-details-form">
                <div class="space-y-6">
                    <!-- Status Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Interview Status</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label
                                class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                <input type="radio" name="status" value="pending"
                                    class="text-sky-600 focus:ring-sky-500" checked>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Pending</div>
                                    <div class="text-xs text-gray-500">Scheduled</div>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                <input type="radio" name="status" value="completed"
                                    class="text-sky-600 focus:ring-sky-500">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Completed</div>
                                    <div class="text-xs text-gray-500">Finished</div>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                <input type="radio" name="status" value="missed"
                                    class="text-sky-600 focus:ring-sky-500">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Missed</div>
                                    <div class="text-xs text-gray-500">No show</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Interview Date -->
                    <div>
                        <label for="interview_date" class="block text-sm font-medium text-gray-700 mb-2">Interview
                            Date</label>
                        <input type="datetime-local" id="interview_date" name="interview_date"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                            placeholder="YYYY-MM-DDThh:mm">
                        <small class="text-gray-500">Format: MM-DD-YYYY hh:mm (24-hour)</small>
                    </div>

                    <!-- Interview Mode -->
                    <div>
                        <label for="mode" class="block text-sm font-medium text-gray-700 mb-2">Interview
                            Mode</label>
                        <select id="mode" name="mode"
                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                            <option selected disabled>Select interview mode</option>
                            <option value="in-person">In-person</option>
                            <option value="online">Online</option>
                        </select>
                    </div>

                    <!-- Link/Address -->
                    <div>
                        <label for="detail" class="block text-sm font-medium text-gray-700 mb-2">Meeting
                            Link/Address</label>
                        <input type="text" id="detail" name="detail"
                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200"
                            placeholder="Enter the meeting link or address...">
                    </div>

                    <!-- Note -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800">Important Note</h4>
                                <p class="text-sm text-blue-700 mt-1">Changing any of the values above will update the
                                    interview details for this applicant.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" id="update-schedule"
                            class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-sky-500 to-blue-600 text-white font-semibold rounded-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7,10 12,15 17,10" />
                                <line x1="12" y1="15" x2="12" y2="3" />
                            </svg>
                            Update Schedule
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Accept Applicant Modal -->
    <div id="update-applicant-modal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
        style="display: none">
        <div class="bg-white rounded-xl shadow-xl border border-gray-200 max-w-md w-full mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900" id="modal_header">Accept Applicant</h3>
                <button type="button" onclick="$('#update-applicant-modal').fadeOut()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
                    id="modal_icon">
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Final Decision</h4>
                <p class="text-gray-600 mb-6" id="modal_message"></p>

                <!-- Modal Actions -->
                <div class="flex space-x-3">
                    <button type="button" onclick="$('#update-applicant-modal').fadeOut()"
                        class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 font-medium">
                        Cancel
                    </button>
                    <button type="submit" id="confirm-update-applicant"
                        class="flex-1 px-4 py-2.5 text-white rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getInterviewRoute = "{{ route('emp.interview.get') }}"
            const getInterviewDetailsRoute = "{{ route('emp.interview.details') }}"
            const updateInterviewDetailsRoute = "{{ route('emp.interview.update') }}"
            const changeApplicantStatusRoute = "{{ route('emp.interview.update.status') }}"
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/employer/interview.js') }}"></script>
    @endpush
</x-employer.main-layout>
