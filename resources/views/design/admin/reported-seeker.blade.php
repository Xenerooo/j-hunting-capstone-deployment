@section('title', 'Reported Job Seeker')

<x-admin.main-layout heading="Reported Job Seeker">
    <div class="w-full min-h-screen bg-gradient-to-br from-rose-50 via-red-50 to-orange-50">
        <!-- Decorative background elements with reported accent -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-r from-rose-200 to-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-r from-orange-200 to-amber-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-red-200 to-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10 p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Reported Job Seekers</h2>
                    <p class="text-gray-600">Review and manage job seeker reports</p>
                </div>

                <!-- Controls -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-rose-100 shadow-lg p-6 mb-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <!-- Sorting -->
                        <div class="flex flex-col">
                            <label for="select_sort" class="text-sm font-medium text-gray-700 mb-2">Sort by</label>
                            <select id="select_sort"
                                class="w-full sm:w-48 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 focus:outline-none bg-white/90 backdrop-blur-sm">
                                <option value="all">All</option>
                                <option value="newest">Newest</option>
                                <option value="oldest">Oldest</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div class="w-full lg:w-auto">
                            <div class="relative w-md max-w-md">
                                <input name="search_input"
                                    class="w-full px-4 py-3 bg-white/90 backdrop-blur-sm placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 focus:outline-none hover:border-gray-400 shadow-sm"
                                    placeholder="Search for job seeker..." />
                                <button name="search_button"
                                    class="absolute top-1 right-1 flex items-center rounded-xl bg-gradient-to-r from-rose-500 to-red-600 py-2 px-4 text-center text-sm text-white transition-all duration-300 hover:from-rose-600 hover:to-red-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
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
                </div>

                <!-- Reported Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="reported-container"></div>
            </div>
        </div>
    </div>

    <!-- IGNORE MODAL -->
    <div id="ignore-modal"
        class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
        style="display: none">
        <div>
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                    <button type="button" onclick="$('#ignore-modal').fadeOut()"
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
                    <p class="mb-4 text-gray-600">Are you sure you want to ignore this report?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button type="button" onclick="$('#ignore-modal').fadeOut()"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-0 focus:outline-none cursor-pointer">
                            No, cancel
                        </button>
                        <button type="submit" id="confirm-ignore"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-800 rounded-lg hover:bg-red-700 focus:ring-0 focus:outline-none cursor-pointer">
                            Yes, I'm sure
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            const token = "{{ csrf_token() }}"
            const showReportedSeekerRoute = "{{ route('admin.seeker.reported') }}";
            const ignoreReportRoute = "{{ route('admin.seeker.reported.ignore') }}";
        </script>
        <script src="{{ asset('js/admin/reported-seeker.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.main-layout>
