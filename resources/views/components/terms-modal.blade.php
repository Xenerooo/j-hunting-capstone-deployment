<div id="terms-modal"
    class="mx-auto w-full h-full bg-black/20 flex flex-col items-center justify-center z-[9999] fixed top-0 left-0 right-0"
    style="display: none">
    <div class="relative p-4 w-full max-w-3xl max-h-[85vh]">
        <div class="relative bg-white rounded-lg shadow-sm">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Terms and Conditions</h3>
                <button type="button" onclick="$('#terms-modal').fadeOut()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-4 md:p-5">
                <div class="prose max-w-none text-gray-700 overflow-y-auto max-h-[55vh] pr-2">
                    {{ $slot }}
                </div>
                <div class="flex items-center justify-end gap-2 mt-6">
                    <button type="button" onclick="$('#terms-modal').fadeOut()"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded hover:bg-gray-50 cursor-pointer">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
