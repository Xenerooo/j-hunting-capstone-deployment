@section('title', 'Post request')
<x-admin.main-layout heading="Post request">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            {{-- sorting --}}
            <form action="" class="w-fit">
                <h3 class="mb-4 font-semibold text-gray-900">Sort by</h3>
                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                        <x-active-radio id="new" :active="true">
                            Newest
                        </x-active-radio>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                        <x-active-radio id="old" :active="true">
                            Oldest
                        </x-active-radio>
                    </li>
                </ul>
            </form>

            {{-- search bar --}}
            <div class="w-full max-w-sm min-w-[200px] mt-5">
                <div class="relative">
                    <input
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-300 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Search for job name..." />
                    <button
                        class="absolute top-1 right-1 flex items-center rounded bg-green-600/90 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all"
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

        <table class="w-full text-sm text-left rtl:text-right text-gray-700 rounded-2xl overflow-hidden">
            <thead class="text-xs text-gray-100 uppercase bg-green-600/90 w-full">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Job seekers
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Employer
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJJ0T0pY3mW6mMgUMzRF1XSdbpQJYGZNDkoA&s"
                                alt=""
                                class="w-[70px] h-[70px] rounded-full overflow-hidden border-2 border-green-700 mr-3 object-cover">

                            <div>
                                <p class="text-bold text-green-600/90 text-lg">Rice export manager</p>
                                <p class="text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-map-pin-icon lucide-map-pin">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span class="ml-1 text-[12px]">City Hall of Borongan City</span>
                                </p>
                                <p class="text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-briefcase-business-icon lucide-briefcase-business">
                                        <path d="M12 12h.01" />
                                        <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                        <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                        <rect width="20" height="14" x="2" y="6" rx="2" />
                                    </svg>
                                    <span class="ml-1 text-[12px]">Agriculture</span>
                                </p>
                            </div>
                        </div>
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        <span class="bg-gray-100 text-xs text-green-600 px-2 py-1 rounded-xl">James
                            LeJordan</span>
                    </th>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-amber-300/90 p-2 rounded-lg text-xs">Pending</span>
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-evenly">
                            <a href="#" class="font-medium text-blue-600 hover:underline">View</a>
                        </div>
                    </td>
                </tr>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://www.shutterstock.com/image-vector/circle-line-simple-design-logo-600nw-2174926871.jpg"
                                alt=""
                                class="w-[70px] h-[70px] rounded-full overflow-hidden border-2 border-green-700 mr-3 object-cover">

                            <div>
                                <p class="text-bold text-green-600/90 text-lg">Backend developer</p>
                                <p class="text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-map-pin-icon lucide-map-pin">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span class="ml-1 text-[12px]">Brgy. Alang-alang, Borongan City</span>
                                </p>
                                <p class="text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-briefcase-business-icon lucide-briefcase-business">
                                        <path d="M12 12h.01" />
                                        <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                        <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                        <rect width="20" height="14" x="2" y="6" rx="2" />
                                    </svg>
                                    <span class="ml-1 text-[12px]">Information Technology (IT)</span>
                                </p>
                            </div>
                        </div>
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        <span class="bg-gray-100 text-xs text-green-600 px-2 py-1 rounded-xl">Ken Qiao
                            Zhi</span>

                    </th>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-amber-300/90 p-2 rounded-lg text-xs">Pending</span>
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-evenly">
                            <a href="#" class="font-medium text-blue-600 hover:underline">View</a>
                        </div>
                    </td>
                </tr>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://cdn.kwork.com/pics/t3/00/26136674-6422a394b504f.jpg" alt=""
                                class="w-[70px] h-[70px] rounded-full overflow-hidden border-2 border-green-700 mr-3 object-cover">

                            <div>
                                <p class="text-bold text-green-600/90 text-lg">We need a foreman</p>
                                <p class="text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-map-pin-icon lucide-map-pin">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span class="ml-1 text-[12px]">Brgy. San Gabriel, Borongan City</span>
                                </p>
                                <p class="text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-briefcase-business-icon lucide-briefcase-business">
                                        <path d="M12 12h.01" />
                                        <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                        <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                        <rect width="20" height="14" x="2" y="6" rx="2" />
                                    </svg>
                                    <span class="ml-1 text-[12px]">Construction</span>
                                </p>
                            </div>
                        </div>
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        <span class="bg-gray-200 text-xs text-green-600 px-2 py-1 rounded-xl">Jenny
                            Wang</span>

                    </th>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-amber-300/90 p-2 rounded-lg text-xs">Pending</span>
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-evenly">
                            <a href="#" class="font-medium text-blue-600 hover:underline">View</a>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    @push('scripts')
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.main-layout>
