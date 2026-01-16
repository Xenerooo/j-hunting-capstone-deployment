<div class="relative p-4 w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow-sm">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Message
            </h3>
            <button type="button" onclick="$('#message-modal').fadeOut()"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <form class="p-4 md:p-5">
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <select id="title" name="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full p-2.5">
                        <option selected disabled>-- Select violation --</option>
                        <option value="Mismatched Information">Mismatched Information</option>
                        <option value="Incomplete Documents">Incomplete Documents</option>
                        <option value="Fake or Invalid Credentials">Fake or Invalid Credentials</option>
                        <option value="Profile Picture Violation">Profile Picture Violation</option>
                        <option value="Inappropriate Content">Inappropriate Content</option>
                        <option value="Duplicate Account">Duplicate Account</option>
                        <option value="Invalid Contact Information">Invalid Contact Information</option>
                        <option value="Unverified Identity">Unverified Identity</option>
                        <option value="Incorrect Role or Category">Incorrect Role or Category</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Message:</label>
                    <textarea id="content" name="content" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0"
                        placeholder="Write your reason here..."></textarea>
                </div>
            </div>
            <button type="submit" id="submit-message"
                class="w-full text-white bg-sky-700 hover:bg-sky-800 focus:outline-none focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">
                Submit
            </button>
        </form>
    </div>
</div>
