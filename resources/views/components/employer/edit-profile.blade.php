<form class="hidden col-span-full bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden"
    id="edit-profile-form" method="post">
    <!-- Header -->
    <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-6">
        <h2 class="text-white text-xl font-semibold flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
            Edit Profile
        </h2>
    </div>

    <div class="p-6 space-y-8">
        <!-- Profile Picture Section -->
        <div class="flex flex-col items-center">
            <div class="relative">
                <img id="profile-preview"
                    src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                    class="object-cover w-32 h-32 border-4 border-gray-100 rounded-xl cursor-pointer shadow-lg hover:shadow-xl transition-all duration-200">
                <div
                    class="absolute -bottom-2 -right-2 w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center cursor-pointer hover:bg-sky-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-3">Click to change profile picture</p>
            <input type="file" name="add_profile_pic" id="select-profile" accept=".jpg, .png, .jpeg" class="hidden">
        </div>

        <!-- Business Information Section -->
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M12 12h.01" />
                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                    <rect width="20" height="14" x="2" y="6" rx="2" />
                </svg>
                Business Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Employer Type</label>
                    <select name="add_employer_type" id="employer-type"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="">Select employer type</option>
                        <option value="Individual">Individual</option>
                        <option value="Company">Company</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Company/Business Name</label>
                    <input type="text" name="add_comp_name" placeholder="Enter company name"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Founded Month</label>
                    <select name="add_month"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="">Select month</option>
                        <x-select-month />
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Founded Year</label>
                    <input type="number" name="add_year" placeholder="YYYY" min="1900" max="2024"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Company Size</label>
                    <select name="add_comp_size"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="">Select company size</option>
                        <option value="0-50 employees">0-50 employees</option>
                        <option value="51-100 employees">51-100 employees</option>
                        <option value="101-200 employees">101-200 employees</option>
                        <option value="201-300 employees">201-300 employees</option>
                        <option value="301-400 employees">301-400 employees</option>
                        <option value="500+ employees">500+ employees</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Location (Where you live in Borongan)</label>
                    <select name="add_barangay"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="">Select barangay</option>
                        <x-select-barangay />
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Work Location (Where your office
                        located)</label>
                    <select name="add_work_location"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="">Select work location</option>
                        <x-select-barangay />
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Work Location Map</label>
                <div name="work_map" id="work_map"
                    class="w-full h-64 border border-gray-200 rounded-lg overflow-hidden"></div>
                <input type="hidden" name="add_latitude" id="latitude" />
                <input type="hidden" name="add_longitude" id="longitude" />
            </div>
        </div>

        <!-- Documents Section -->
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                </svg>
                Documents & Verification
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Valid ID Type</label>
                    <select name="add_valid_id_type" id="valid-id-type"
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                        <option value="">Select ID type</option>
                        <option value="National ID">National ID</option>
                        <option value="Passport">Passport</option>
                        <option value="Driver's License">Driver's License</option>
                        <option value="SSS/UMID">SSS/UMID</option>
                        <option value="PRC ID">PRC ID</option>
                        <option value="Voter's ID">Voter's ID</option>
                        <option value="Postal ID">Postal ID</option>
                        <option value="PhilHealth ID">PhilHealth ID</option>
                    </select>
                </div>
            </div>

            <div class="mb-4 w-full">
                <label class="block text-sm font-medium text-gray-700">Preview valid ID</label>
                <img id="valid-id-preview"
                    src="https://philsys.gov.ph/wp-content/uploads/2022/11/PhilID-specimen-Front_highres1-1024x576.png"
                    class="object-cover w-96 max-h-56 rounded-lg cursor-pointer">
                <input type="file" id="select-valid-id" name="add_valid_id" accept=".jpg, .png, .jpeg"
                    class="hidden">
            </div>

            <div class="mb-4 w-full">
                <label class="block text-sm font-medium text-gray-700">Business Permit</label>
                <input type="file" id="select-business-permit" name="add_business_permit" accept=".pdf"
                    class="w-full border border-gray-300 rounded focus:outline-0 focus:ring-0" />
                <span id="permit-preview" class="block mb-2 text-xs md:text-sm font-semibold text-gray-800"></span>
            </div>

            <div class="mb-4 w-full">
                <label class="block mb-2 text-xs md:text-sm text-gray-700">Job Type</label>
                <select name="add_job_type"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-0 focus:ring-0">
                    <option value="">----------</option>
                    <x-select-job-types />
                </select>
            </div>

            <!-- Personal Information Section -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Personal Information
                </h3>

                <!-- Full Name -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="add_first_name" placeholder="Enter first name"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Middle Name (Optional)</label>
                        <input type="text" name="add_mid_name" placeholder="Enter middle name"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="add_last_name" placeholder="Enter last name"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Suffix</label>
                        <select name="add_suffix"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                            <option value="">N/A</option>
                            <option value="Jr">Jr</option>
                            <option value="Sr">Sr</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <input type="number" name="add_phone_num" maxlength="11" minlength="11"
                            placeholder="09XXXXXXXXX"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Facebook Profile Link</label>
                        <input type="text" name="add_facebook_link"
                            placeholder="https://www.facebook.com/john.doe"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200" />
                    </div>
                </div>

                <!-- About Company -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">About Company</label>
                    <textarea name="add_about" rows="6"
                        placeholder="Write about your business, mission, values, and what makes it a great place to work..."
                        class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 resize-none"></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <button type="button" id="profile-cancel-button"
                    class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                    Cancel
                </button>
                <button type="submit" id="profile-save-button"
                    class="px-8 py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline mr-2" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                        <polyline points="17,21 17,13 7,13 7,21" />
                        <polyline points="7,3 7,8 15,8" />
                    </svg>
                    Save Changes
                </button>
            </div>
        </div>
</form>
