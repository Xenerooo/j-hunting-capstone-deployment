@section('title', 'Request Posts')

<x-admin.main-layout heading="Request Posts">
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
                <!-- Header -->
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Requested Job Posts</h2>
                    <p class="text-gray-600">Review and manage job post requests</p>
                </div>

                <!-- Controls -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg p-6 mb-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
                        <!-- Sorting -->
                        <div class="flex flex-col">
                            <label for="select_sort" class="text-sm font-medium text-gray-700 mb-2">Sort by</label>
                            <select id="select_sort"
                                class="w-full sm:w-48 px-4 py-3 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none bg-white/90 backdrop-blur-sm">
                                <option value="all">All</option>
                                <option value="newest">Newest</option>
                                <option value="oldest">Oldest</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div class="w-full lg:w-auto">
                            <div class="relative w-md max-w-md">
                                <input name="search_input"
                                    class="w-full px-4 py-3 bg-white/90 backdrop-blur-sm placeholder:text-gray-400 text-gray-700 text-sm border border-gray-300 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:outline-none hover:border-gray-400 shadow-sm"
                                    placeholder="Search for job..." />
                                <button name="search_button"
                                    class="absolute top-1 right-1 flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 py-2 px-4 text-center text-sm text-white transition-all duration-300 hover:from-sky-600 hover:to-blue-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
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

                <!-- Requests Grid -->
                <div id="requests-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

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

        /* Card hooks for JS-rendered requests */
        #requests-container .request-card {
            background: rgba(255, 255, 255, .85);
            backdrop-filter: blur(6px);
            border: 1px solid #e0f2fe;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 8px 20px rgba(2, 132, 199, .06);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        #requests-container .request-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(2, 132, 199, .12);
        }

        #requests-container .request-title {
            font-weight: 700;
            color: #0f172a;
        }

        #requests-container .request-meta {
            font-size: .8rem;
            color: #64748b;
        }

        #requests-container .request-actions {
            display: flex;
            gap: .5rem;
            margin-top: .75rem;
        }

        #requests-container .btn {
            display: inline-flex;
            align-items: center;
            gap: .375rem;
            padding: .5rem .75rem;
            border-radius: .5rem;
            font-weight: 600;
            font-size: .8rem;
            transition: all .2s ease;
        }

        #requests-container .btn-approve {
            color: #065f46;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
        }

        #requests-container .btn-approve:hover {
            background: #d1fae5;
        }

        #requests-container .btn-reject {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        #requests-container .btn-reject:hover {
            background: #fee2e2;
        }
    </style>

    @push('scripts')
        <script>
            const showRequestsRoute = "{{ route('admin.job.request') }}";
        </script>
        <script src="{{ asset('js/admin/request-job.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.main-layout>
