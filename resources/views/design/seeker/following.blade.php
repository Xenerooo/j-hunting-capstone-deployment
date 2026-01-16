@section('title', 'Following Employers')
<x-job-seeker.main-layout heading="Following Employers">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            {{-- sorting --}}
            <form action="" class="w-fit flex items-center justity-center gap-3">
                <label for="select_sort" class="text-xs">Sort by</label>
                <select id="select_sort"
                    class="text-gray-700 text-sm border border-gray-300 rounded-md py-2 transition duration-300 ease focus:ring-0 focus:outline-none">
                    <option value="all">All</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </form>

            {{-- search bar --}}
            <div class="w-full max-w-[385px] min-w-[200px] flex flex-col gap-2  items-end">
                <div class="relative">
                    <input name="search_input"
                        class="w-full bg-transparent placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-gray-400 hover:border-gray-300 shadow-sm focus:shadow"
                        placeholder="Search for job name..." />
                    <button name="search_button"
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2" id="following-container">
        </div>
    </div>

    {{-- UNFOLLOW MODAL --}}
    <div id="unfollow-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <div>
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                    <button type="button" onclick="$('#unfollow-modal').fadeOut()"
                        class="text-gray-600 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center cursor-pointer">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-user-round-x-icon lucide-user-round-x text-gray-600 w-11 h-11 mb-3.5 mx-auto">
                        <path d="M2 21a8 8 0 0 1 11.873-7" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="m17 17 5 5" />
                        <path d="m22 17-5 5" />
                    </svg>
                    <p class="mb-4 text-gray-600">Are you sure you want to unfollow this employer?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button type="button" onclick="$('#unfollow-modal').fadeOut()"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-0 focus:outline-none cursor-pointer">
                            No, cancel
                        </button>
                        <button type="submit" id="confirm-unfollow"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-0 focus:outline-none cursor-pointer">
                            Yes, I'm sure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getFollowingRoute = "{{ route('js.following.get') }}"
            const unfollowRoute = "{{ route('js.unfollow.employer') }}"
            const muteNotificationRoute = "{{ route('js.following.mute') }}"
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/job-seeker/following.js') }}"></script>
    @endpush
</x-job-seeker.main-layout>
