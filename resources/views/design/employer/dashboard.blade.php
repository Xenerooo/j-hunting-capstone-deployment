@section('title', 'Dashboard')
<x-employer.main-layout heading="Dashboard">
    <div id="summary_cards_container" class="grid grid-cols-1 lg:grid-cols-3 mb-6 gap-6"></div>

    <div
        class="w-full h-56 bg-gradient-to-tr from-sky-500 via-sky-600 to-sky-700 flex items-center justify-center rounded-xl shadow-inner">
        <h1 id="motto" class="sm:text-3xl text-2xl text-center text-white font-semibold tracking-wide">
            J-Hunting, where skills meet success
        </h1>
    </div>
    <div class="w-full flex justify-center -mt-5 px-2">
        <div
            class="flex items-center bg-white/90 backdrop-blur rounded-xl p-3 gap-3 max-w-screen-lg shadow-md ring-1 ring-slate-200 w-full overflow-x-auto flex-nowrap">

            <!-- Search Input Field -->
            <div class="flex items-center bg-gray-100 rounded-md min-w-[240px]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 ml-3" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
                <input type="text" id="search_text" placeholder="Search for...."
                    class="text-gray-800 border-none focus:ring-0 px-3 py-2 w-full bg-transparent placeholder:text-gray-500" />
            </div>

            <span class="flex items-center justify-center text-gray-500">by</span>

            <!-- Location Dropdown -->
            <div class="flex items-center bg-gray-50 rounded-md min-w-[180px]">
                <select id="location_select"
                    class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-200 focus:border-sky-400 focus:ring-1 focus:ring-sky-300">
                    <option value="all_location">All location</option>
                    <x-select-barangay />
                </select>
            </div>

            <!-- Job Type Dropdown -->
            <div class="flex items-center bg-gray-50 rounded-md min-w-[220px]">
                <select id="job_type_select"
                    class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-200 focus:border-sky-400 focus:ring-1 focus:ring-sky-300">
                    <option value="all_job_type">All job type</option>
                    <x-select-job-types />
                </select>
            </div>

            <!-- Search Button -->
            <div class="min-w-[120px]">
                <button
                    class="flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 py-2 px-4 text-center text-white transition-all duration-300 hover:from-sky-600 hover:to-blue-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    type="button" id="search_button">
                    <svg xmlns="http://http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-4 h-4 mr-2">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    Search
                </button>
            </div>

        </div>

    </div>
    <div class="w-full h-fit">
        <div class="mt-6 mx-auto text-center text-gray-500">Refresh to get featured job seekers</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-5" id="job_seekers_container">
        </div>
    </div>

    @push('scripts')
        <script>
            const getSummaryRoute = "{{ route('emp.dashboard.summary') }}";
            const getJobSeekersRoute = "{{ route('emp.dashboard.seekers') }}";
            const postedJobsRoute = "{{ route('emp.posted.jobs') }}";
            const applicantsRoute = "{{ route('emp.application') }}";
            const notificationsRoute = "{{ route('emp.notification') }}";
        </script>
        <script src="{{ asset('js/employer/dashboard.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/custom/search-text.js') }}"></script>
    @endpush
</x-employer.main-layout>
