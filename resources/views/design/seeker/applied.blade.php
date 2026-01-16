@section('title', 'Applied Jobs')
<x-job-seeker.main-layout heading="Applied Jobs">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-2 sm:space-y-2 items-center justify-between pb-4">

            <form action="" class="w-fit flex items-center justity-center gap-3">
                <label for="select_sort" class="text-xs">Sort by</label>
                <select id="select_sort"
                    class="text-gray-700 text-sm border border-gray-300 rounded-md py-2 transition duration-300 ease focus:ring-0 focus:outline-none">
                    <option value="all">All</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="interview">Interview</option>
                    <option value="rejected">Rejected</option>
                </select>
            </form>

            {{-- search bar --}}
            <div class="w-full max-w-[385px] min-w-[200px] flex flex-col gap-2  items-end">
                <div class="relative">
                    <input name='search_input'
                        class="w-full bg-transparent placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-gray-400 hover:border-gray-300 shadow-sm focus:shadow"
                        placeholder="Search for job name..." />
                    <button name='search_button'
                        class="absolute top-1 right-1 flex items-center rounded bg-sky-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
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

        <div class="col-start-1 col-end-7 mt-3 space-y-2" id="applied-container">
        </div>

        @push('scripts')
            <script>
                const getAppliedRoute = "{{ route('js.applied.get') }}"
            </script>
            <script src="{{ asset('js/custom/loader.js') }}"></script>
            <script src="{{ asset('js/job-seeker/applied-jobs.js') }}"></script>
        @endpush
</x-job-seeker.main-layout>
