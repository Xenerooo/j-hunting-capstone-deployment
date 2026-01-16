@section('title', 'Job Application')
<x-employer.main-layout heading="Job Application">
    <!-- Filters and Search Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Sort Filter -->
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18" />
                    <path d="M7 12h10" />
                    <path d="M10 18h4" />
                </svg>
                <label for="select_sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                <select id="select_sort"
                    class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                    <option value="all">All</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="interview">Interview</option>
                    <option value="rejected">Rejected</option>
                </select>
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

    <!-- Applications Grid Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="application-container">
    </div>

    <!-- DELETE APPLICANT MODAL -->
    <div id="delete-applicant-modal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
        style="display: none">
        <div class="bg-white rounded-xl shadow-xl border border-gray-200 max-w-md w-full mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Delete Application</h3>
                <button type="button" onclick="$('#delete-applicant-modal').fadeOut()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M2 21a8 8 0 0 1 11.873-7" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="m17 17 5 5" />
                        <path d="m22 17-5 5" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Are you sure?</h4>
                <p class="text-gray-600 mb-6">This is a rejected applicant. This action cannot be undone and will
                    permanently delete the application.</p>

                <!-- Modal Actions -->
                <div class="flex space-x-3">
                    <button type="button" onclick="$('#delete-applicant-modal').fadeOut()"
                        class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 font-medium">
                        Cancel
                    </button>
                    <button type="submit" id="confirm-delete-applicant"
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                        Delete Application
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getApplicationRoute = "{{ route('emp.application.get') }}";
            const deleteApplicantRoute = "{{ route('emp.application.delete') }}";
        </script>
        <script src="{{ asset('js/employer/job-application.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-employer.main-layout>
