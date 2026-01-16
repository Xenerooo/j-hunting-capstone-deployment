@section('title', 'Search')
<x-job-seeker.main-layout heading="Search">

    <div class="w-full h-fit">
        <div class="w-full h-52 bg-gradient-to-t from-blue-300 to-blue-600  flex items-center justify-center rounded-lg">
            <h1 id="motto" class="sm:text-3xl text-xl text-center text-white font-bold">
                J-Hunting, where skills meet success
            </h1>
        </div>
        <div class="w-full flex justify-center -mt-5 px-2">
            <div class="flex flex-wrap bg-white rounded-lg p-4 gap-4 max-w-screen-lg shadow-lg w-full">

                <!-- Search Input Field -->
                <div class="flex items-center bg-gray-100 rounded-md flex-grow w-[300px]">
                    <input type="text" placeholder="Search for...."
                        class="text-gray-800 border-none focus:ring-0 px-2 py-2 w-full bg-transparent" />
                </div>

                <span class="sm:flex items-center bg-gray-50 rounded-md px-1 py-1 text-gray-700 hidden">by</span>

                <!-- Location Dropdown -->
                <div class="flex items-center bg-gray-50 rounded-md w-full sm:w-[210px]">
                    <select id="locationSelect"
                        class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-300">
                        <option value="">All location</option>
                        <x-select-barangay />
                    </select>
                </div>

                <!-- Employers or Jobs Dropdown -->
                <div class="flex items-center bg-gray-50 rounded-md w-full sm:w-[130px]">
                    <select class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-300">
                        <option value="jobs">Job</option>
                        <option value="employer">Employer</option>
                    </select>
                </div>

                <!-- Job Type Dropdown -->
                <div class="flex items-center bg-gray-50 rounded-md w-full sm:w-[130px]">
                    <select class="w-full text-gray-800 outline-none px-4 py-2 rounded-md border border-gray-300">
                        <option value="">Any</option>
                        <x-select-employment-type />
                    </select>
                </div>

                <!-- Search Button -->
                <div class="w-full sm:w-auto">
                    <button
                        class="bg-blue-500 hover:bg-blue-400 text-white py-2 px-6 rounded-md transition duration-200 w-full sm:w-auto">
                        Search
                    </button>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-col-1 sm:grid-cols-3 gap-3 mt-5">

            <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="https://expressbeenow.com/wp-content/uploads/2024/05/Albertos.jpg" alt="Company Logo"
                            class="object-contain w-18 h-18 rounded-lg mr-3">
                        <div>
                            <a href="{{ route('js.employer') }}"
                                class="text-xl font-semibold text-gray-800 hover:text-gray-600">Albertos
                                Pizza</a>
                            <p class="text-[12px] text-gray-500">Posted: April 18, 2025</p>
                        </div>
                    </div>
                </div>

                <!-- Job Title -->
                <a href="{{ route('js.job') }}"
                    class="text-lg font-semibold text-blue-800 hover:text-blue-700 mb-2">Delivery Boy</a>

                <!-- Location -->
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="text-[12px]">Brgy. Purok C, Borongan City</span>
                </div>
                <span
                    class="bg-yellow-600/10 inline-block text-yellow-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Full
                    Time</span>

                <div class="w-full h-[1px] bg-gray-400 my-4"></div>

                <!-- Applicants Count -->
                <p class="text-sm text-gray-500">
                    3 out of 10 Hired
                </p>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJUhnzvQjPhAmDdncGxNmTUs9ukVU9vo7o5A&s"
                            alt="Company Logo" class="object-contain w-18 h-18 rounded-lg mr-3">
                        <div>
                            <a href="{{ route('js.employer') }}"
                                class="text-xl font-semibold text-gray-800 hover:text-gray-600">Mate Tricks Vape
                                Lounge</a>
                            <p class="text-[12px] text-gray-500">Posted: April 6, 2025</p>
                        </div>
                    </div>
                </div>

                <!-- Job Title -->
                <a href="{{ route('js.job') }}"
                    class="text-lg font-semibold text-blue-800 hover:text-blue-700 mb-2">Janitor</a>

                <!-- Location -->
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="text-[12px]">Brgy. Purok G, Borongan City</span>
                </div>
                <span
                    class="bg-yellow-600/10 inline-block text-yellow-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Part
                    time</span>

                <div class="w-full h-[1px] bg-gray-400 my-4"></div>

                <!-- Applicants Count -->
                <p class="text-sm text-gray-500">
                    0 out of 2 Hired
                </p>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxubuQTi37-M2VruBDvXQl3O9lPudYAT9ltA&s"
                            alt="Company Logo" class="object-contain w-18 h-18 rounded-lg mr-3">
                        <div>
                            <a href="{{ route('js.employer') }}"
                                class="text-xl font-semibold text-gray-800 hover:text-gray-600">J&F Borongan</a>
                            <p class="text-[12px] text-gray-500">Posted: Mar 29, 2025</p>
                        </div>
                    </div>
                </div>

                <!-- Job Title -->
                <a href="{{ route('js.job') }}"
                    class="text-lg font-semibold text-blue-800 hover:text-blue-700 mb-2">Security Guard</a>

                <!-- Location -->
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="text-[12px]">Brgy. Songco, Borongan City</span>
                </div>
                <span
                    class="bg-yellow-600/10 inline-block text-yellow-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Full
                    time</span>

                <div class="w-full h-[1px] bg-gray-400 my-4"></div>

                <!-- Applicants Count -->
                <p class="text-sm text-gray-500">
                    3 out of 5 Hired
                </p>
            </div>

        </div>
    </div>

</x-job-seeker.main-layout>
