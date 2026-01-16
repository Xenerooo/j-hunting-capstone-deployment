@section('title', 'Posted Jobs')
<x-employer.main-layout heading="Posted Jobs">
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
                    <option value="all">All Jobs</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                    <option value="restricted">Restricted</option>
                    <option value="expired">Expired</option>
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

    <!-- Jobs Grid Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="posted-container">
    </div>

    @push('scripts')
        <script>
            const postedJobsRoute = "{{ route('emp.posted.jobs.get') }}";
        </script>
        <script src="{{ asset('js/employer/posted-jobs.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-employer.main-layout>
