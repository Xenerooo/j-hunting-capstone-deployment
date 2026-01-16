@section('title', 'Job Interviews')
<x-job-seeker.main-layout heading="Job Interviews">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            {{-- sorting --}}
            <form action="" class="w-fit flex items-center justity-between">
                <div class="flex flex-col items-start justify-between">
                    <label for="select_sort" class="text-xs">Sort by</label>
                    <select id="select_sort"
                        class="text-gray-700 text-sm border border-gray-300 rounded-md py-2 transition duration-300 ease focus:ring-0 focus:outline-none">
                        <option value="all">All</option>
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                </div>

                <div class="h-[61px] w-14 flex items-center justify-center mt-2">
                    <span class="text-gray-700 text-sm">OR</span>
                </div>

                <div class="flex flex-col items-start justify-between">
                    <label for="sort_date" class="text-xs">Sort by schedule</label>
                    <input type="date" name="sort_date" id="sort_date"
                        class="text-gray-700 text-sm border border-gray-300 rounded-md py-2 transition duration-300 ease focus:ring-0 focus:outline-none">
                </div>
            </form>

            {{-- search bar --}}
            <div class="w-full max-w-sm min-w-[200px] mt-5">
                <div class="relative">
                    <input name="search_input"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-300 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Search for job name..." />
                    <button name="search_button"
                        class="absolute top-1 right-1 flex items-center rounded bg-sky-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all cursor-pointer"
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2" id="interview-container">
        </div>
    </div>

    @push('scripts')
        <script>
            const getInterviewRoute = "{{ route('js.interview.get') }}"
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/job-seeker/job-interview.js') }}"></script>
    @endpush
</x-job-seeker.main-layout>
