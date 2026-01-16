@section('title', 'Employers')

<x-admin.main-layout heading="All employers">
    <div class="w-full min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Decorative background elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-r from-sky-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10 p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">Employer Management</h2>
                    <p class="text-gray-600 text-center">Manage and monitor all registered employers on the platform</p>
                </div>

                <!-- Controls Section -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg p-6 mb-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
                        <!-- Sorting Controls -->
                        <div class="flex flex-row gap-4 flex-1/2 justify-between items-end">
                            <div class="flex flex-col">
                                <label for="select_sort" class="text-sm font-medium text-gray-700 mb-2">Sort by</label>
                                <select id="select_sort"
                                    class="w-full sm:w-40 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none bg-white/90 backdrop-blur-sm">
                                    <option value="all">All</option>
                                    <option value="newest">Newest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <!-- Search Bar -->
                                <div class="mt-6">
                                    <div class="relative max-w-md">
                                        <input name="search_input"
                                            class="w-full px-4 py-3 bg-white/90 backdrop-blur-sm placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none hover:border-gray-400 shadow-sm"
                                            placeholder="Search for employer..." />
                                        <button
                                            class="absolute top-1 right-1 flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 py-2 px-4 text-center text-sm text-white transition-all duration-300 hover:from-sky-600 hover:to-blue-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                            type="button" name="search_button">
                                            <svg xmlns="http://http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4 mr-2">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex flex-row gap-4">
                                    <div class="flex flex-col">
                                        <label for="month-select"
                                            class="text-sm font-medium text-gray-700 mb-2">Month</label>
                                        <select id="month-select"
                                            class="w-full sm:w-32 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none bg-white/90 backdrop-blur-sm">
                                            <option value="{{ date('F') }}">{{ date('F') }}</option>
                                            <x-select-month />
                                        </select>
                                    </div>

                                    <div class="flex flex-col">
                                        <label for="year-select"
                                            class="text-sm font-medium text-gray-700 mb-2">Year</label>
                                        <input id="year-select"
                                            class="w-full sm:w-32 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none bg-white/90 backdrop-blur-sm"
                                            type="number" name="year-select" min="1900" max="2099"
                                            step="1" value="{{ date('Y') }}" />
                                    </div>
                                </div>

                                <!-- Download Button -->
                                <button id="downloadExcel"
                                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-sm font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download Excel
                                </button>
                            </div>


                        </div>


                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                            <thead class="text-xs text-white uppercase bg-gradient-to-r from-sky-600 to-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold">
                                        Employer
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center font-semibold">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center font-semibold">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center font-semibold">
                                        Date Joined
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center font-semibold">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="table-body" class="bg-white/50">
                                <!-- Table content will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Message Container -->
                    <div id="message-container" class="p-6">
                        <!-- Messages will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    @push('scripts')
        <script>
            const getEmployerRoute = "{{ route('admin.all.employer') }}";
            const getEmployerDownloadRoute = "{{ route('admin.all.employer.download') }}";
        </script>
        <script src="{{ asset('js/admin/all-employer.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.main-layout>
