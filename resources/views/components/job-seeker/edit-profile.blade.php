<form class="hidden col-start-1 col-end-8 bg-white shadow-lg p-4 rounded-md" id="edit-profile-form">
    <div class="flex flex-col items-center mt-6 mb-10">
        <img id="profile-preview"
            src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
            class="object-cover w-40 h-40 border-2 border-sky-600 rounded-full cursor-pointer">

        <input type="file" name="add_profile_pic" id="select-profile" accept=".jpg, .png, .jpeg" class="hidden">
    </div>

    <h1 class="font-semibold text-gray-800 mb-4 mt-10">Personal Information</h1>

    <!-- Full Name -->
    <div class="grid grid-cols-7 gap-3">
        <div class="mb-4 col-span-7 md:col-span-2">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">First Name</label>
            <input type="text" name="add_first_name"
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
        </div>
        <div class="mb-4 col-span-7 md:col-span-2">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Middle Name (Optional)</label>
            <input type="text" name="add_mid_name"
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
        </div>
        <div class="mb-4 col-span-7 md:col-span-2">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Last Name</label>
            <input type="text" name="add_last_name"
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
        </div>
        <div class="mb-4 col-span-2 md:col-span-1">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Suffix</label>
            <select name="add_suffix" class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0">
                <option value="">N/A</option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
            </select>
        </div>
    </div>

    <!-- Birthday -->
    <div class="flex flex-col md:flex-row items-center justify-between md:space-x-4">
        <div class="mb-4 w-full">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Birthday</label>
            <input type="date" name="add_birthday" id="birthday-input"
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
        </div>

        <div class="mb-4 w-full">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Age</label>
            <input type="text" name="add_age" id="age" disabled
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
        </div>
    </div>

    <!-- Sex Dropdown -->
    <div class="flex flex-col md:flex-row items-center justify-between md:space-x-4">
        <div class="mb-4 w-full">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Sex</label>
            <select name="add_sex" class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0">
                <option value="">-------------</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>


        <!-- Location Dropdown -->
        <div class="mb-4 w-full">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Location (Only in Borongan City)</label>
            <select name="add_barangay" class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0">
                <option value="">-------------</option>
                <x-select-barangay />
            </select>
        </div>
    </div>

    <!-- Contact Number -->
    <div class="mb-4 w-full">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Phone Number</label>
        <input type="number" name="add_phone_num" maxlength="11" minlength="11" placeholder="09XXXXXXXXX"
            class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
    </div>

    <!-- Facebook link -->
    <div class="mb-4 w-full">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Profile Facebook Link</label>
        <input type="text" name="add_facebook_link" placeholder="https://www.facebook.com/john.doe"
            class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
    </div>

    <h1 class="font-semibold text-gray-800 mb-4 mt-10">Work Experience And Skills</h1>

    <!-- Job type -->
    <div class="mb-4 w-full space-y-2" id="job-type-section">
        <div class="flex items-center justify-between mb-2">
            <label class="block text-xs md:text-sm text-gray-700">Select Job Type</label>
        </div>

        <div class="flex items-center space-x-2">
            <input id="select-all-job-types" type="checkbox" value=""
                class="w-5 h-5 border border-gray-400 rounded-sm bg-gray-50 focus:outline-0 focus:ring-0" />
            <label class="text-xs md:text-sm text-gray-700" for="select-all-job-types">Select All</label>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_1"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Administrative & Office Work" id="job_type_1_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_1_a">Administrative & Office Work</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_2"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Agriculture & Fisheries" id="job_type_2_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_2_a">Agriculture & Fisheries</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_3"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Business Process Outsourcing" id="job_type_3_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_3_a">Business Process
                    Outsourcing</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_4"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Construction & Skilled Work" id="job_type_4_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_4_a">Construction & Skilled Work</label>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_5"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Criminal Justice & Law Enforcement" id="job_type_5_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_5_a">Criminal Justice & Law
                    Enforcement</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_6"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Culinary" id="job_type_6_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_6_a">Culinary</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_7"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Education & Training" id="job_type_7_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_7_a">Education & Training</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_8"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Engineering" id="job_type_8_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_8_a">Engineering</label>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_9"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Freelance & Creative Work" id="job_type_9_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_9_a">Freelance & Creative Work</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_10"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Government Service" id="job_type_10_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_10_a">Government Service</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_11"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Healthcare & Medical" id="job_type_11_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_11_a">Healthcare & Medical</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_12"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Hospitality & Tourism" id="job_type_12_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_12_a">Hospitality & Tourism</label>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_13"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Information Technology (IT)" id="job_type_13_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_13_a">Information Technology
                    (IT)</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_14"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Manufacturing" id="job_type_14_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_14_a">Manufacturing</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_15"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Retail & Sales" id="job_type_15_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_15_a">Retail & Sales</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="job_type_16"
                    class="job-type-checkbox w-5 h-5 border border-gray-400 rounded focus:outline-0 focus:ring-0"
                    value="Transportation & Logistics" id="job_type_16_a" />
                <label class="text-xs md:text-sm text-gray-700" for="job_type_16_a">Transportation & Logistics</label>
            </div>
        </div>
    </div>

    <!-- Expertise -->
    <div class="mb-4 w-full">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Expertise</label>
        <input type="text" name="add_expertise" placeholder="Please specify"
            class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
    </div>

    <!-- Resume Upload (PDF) -->
    <div class="mb-4">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Resume (PDF)</label>
        <input type="file" id="resumeInput" name="add_resume" accept=".pdf"
            class="w-full border border-gray-300 rounded focus:outline-0 focus:ring-0" />
        <span id="resumePreview" class="block mb-2 text-xs md:text-sm font-semibold text-gray-800"></span>
    </div>

    <!-- Additional File Upload (PDF, DOCX, DOC) -->
    <div class="mb-4">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Additional File (Optional)</label>
        <input type="file" name="add_file" accept=".pdf, .docx, .doc"
            class="w-full border border-gray-300 rounded focus:outline-0 focus:ring-0" />
        <span id="filePreview" class="block mb-2 text-xs md:text-sm font-semibold text-gray-800"></span>
    </div>

    <!-- Portfolio Link -->
    <div class="mb-4 w-full">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Portfolio Link (Optional)</label>
        <input type="text" name="add_portfolio_link" placeholder="https://www.facebook.com/john.doe"
            class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
    </div>

    <!-- Work Experience Dropdown -->
    <div class="flex flex-row items-center justify-between space-x-4">
        <div class="mb-4 w-full">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Experience</label>
            <input type="number" name="add_experience_count" maxlength="1" minlength="2" max="99"
                min="0" placeholder="0"
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0" />
        </div>
        <div class="mb-4 w-full">
            <label class="block mb-2 text-xs md:text-sm text-gray-700">Time Frame</label>
            <select name="add_experience_timeframe"
                class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0">
                <option value="">----------</option>
                <option value="Month/s">Month/s</option>
                <option value="Year/s">Year/s</option>
            </select>
        </div>
    </div>

    <!-- Education -->
    <div class="mb-4 w-full">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">Educational Attainment</label>
        <select name="add_education" class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0">
            <option value="">----------</option>
            <x-select-education />
        </select>
    </div>

    <!-- About -->
    <div class="mb-4 max-w-[605px] w-full">
        <label class="block mb-2 text-xs md:text-sm text-gray-700">About Me</label>
        <textarea name="add_about" rows="10" style="max-width: 605px;"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0"
            wrap="soft" placeholder="Write about yourself here..."></textarea>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" id="profile-cancel-button"
            class="text-sm/6 font-semibold text-gray-900 border-gray-300 hover:border-1 px-3 py-1 duration-200 rounded-md cursor-pointer">Cancel</button>

        <button type="submit" id="profile-save-button"
            class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-sky-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 cursor-pointer">Save
            changes</button>
    </div>
</form>
