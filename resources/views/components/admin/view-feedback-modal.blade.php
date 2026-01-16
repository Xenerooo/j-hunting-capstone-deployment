<div id="view-feedback-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4"
    style="display: none">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl relative overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-sky-600 to-blue-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-white">Feedback Details</h3>
                <button onclick="$('#view-feedback-modal').fadeOut()"
                    class="text-white/80 hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- User Info -->
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl">
                <div
                    class="w-12 h-12 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    <span id="user-initials"></span>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900" id="email"></h4>
                    <p class="text-sm text-gray-600">Feedback Submission</p>
                </div>
            </div>

            <!-- Rating -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-gray-700">Rating</label>
                <div class="flex items-center space-x-2">
                    <div id="stars-container" class="flex text-yellow-400"></div>
                    <span id="rating-text" class="text-sm text-gray-600"></span>
                </div>
            </div>

            <!-- Feedback Content -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-gray-700">Feedback Message</label>
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <p id="feedback_content" class="text-gray-700 leading-relaxed"></p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <button id="delete-feedback"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Delete
                </button>
                <button id="accept-feedback"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Approve
                </button>
            </div>
        </div>
    </div>
</div>
