@section('title', 'Dashboard')
<x-job-seeker.main-layout heading="Dashboard">

    <div class="w-full h-fit">
        <div class="w-full h-52 bg-gradient-to-t from-sky-300 to-sky-600  flex items-center justify-center rounded-lg">
            <h1 id="motto" class="sm:text-3xl text-xl text-center text-white font-bold">
                J-Hunting, where skills meet success
            </h1>
        </div>
        <div class="w-full flex justify-center -mt-5 px-2">
            <div class="flex flex-wrap bg-white rounded-lg p-4 gap-4 max-w-screen-lg shadow-lg w-full">

                <!-- Search Input Field -->
                <div class="flex items-center bg-gray-100 rounded-md flex-grow w-[300px]">
                    <input type="text" id="search_text" placeholder="Search for...."
                        class="text-gray-800 border-none focus:ring-0 px-2 py-2 w-full bg-transparent" />
                </div>

                <span class="sm:flex items-center bg-gray-50 rounded-md px-1 py-1 text-gray-700 hidden">by</span>

                <!-- Location Dropdown -->
                <div class="flex items-center bg-gray-50 rounded-md w-full sm:w-[210px]">
                    <select id="location_select"
                        class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-300">
                        <option value="">All location</option>
                        <x-select-barangay />
                    </select>
                </div>

                <!-- Job Type Dropdown -->
                <div class="flex items-center bg-gray-50 rounded-md w-full sm:w-[280px]">
                    <select id="job_type_select"
                        class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-300">
                        <option value="">All job type</option>
                        <x-select-job-types />
                    </select>
                </div>

                <!-- Search Button -->
                <div class="w-full sm:w-auto">
                    <button id="search_button"
                        class="bg-sky-800 hover:bg-sky-700 text-white py-2 px-6 rounded-md transition duration-200 w-full sm:w-auto">
                        Search
                    </button>
                </div>

            </div>
        </div>

        <div x-data="{ tab: 'jobs' }" class="relative mt-5 w-full mx-auto">
            <!-- Sliding background -->
            <div class="grid grid-cols-2 border-b border-gray-300 relative w-full max-w-lg mx-auto shadow-2xl">
                <div class="absolute top-0 left-0 h-full w-1/2 transition-all duration-300 ease-in-out bg-sky-800 z-0"
                    :class="tab === 'employers' ? 'translate-x-full' : 'translate-x-0'">
                </div>

                <!-- Tabs -->
                <div class="relative z-10">
                    <a @click="tab = 'jobs'" class="block text-center p-2 cursor-pointer transition duration-200"
                        :class="tab === 'jobs' ? 'text-white' : 'text-gray-700'">
                        Jobs
                    </a>
                </div>
                <div class="relative z-10">
                    <a @click="tab = 'employers'" class="block text-center p-2 cursor-pointer transition duration-200"
                        :class="tab === 'employers' ? 'text-white' : 'text-gray-700'">
                        Employers
                    </a>
                </div>
            </div>

            <div class="mt-5 mx-auto text-center text-gray-500">Refresh to get featured jobs and employers</div>
            <!-- Tab Content -->
            <div class="mt-4 w-full">
                <section x-show="tab === 'jobs'">
                    <div class="grid grid-cols-1 md:grid-col-1 sm:grid-cols-3 gap-3 mt-5" id="jobs-container">
                    </div>
                </section>
                <section x-show="tab === 'employers'">
                    <div class="grid grid-cols-1 md:grid-col-1 sm:grid-cols-2 gap-3 mt-6" id="employers-container">
                    </div>
                </section>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getFeaturedRoute = "{{ route('js.featured.get') }}";
        </script>
        <script src="{{ asset('js/job-seeker/dashboard.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/custom/search-text.js') }}"></script>
    @endpush

</x-job-seeker.main-layout>
