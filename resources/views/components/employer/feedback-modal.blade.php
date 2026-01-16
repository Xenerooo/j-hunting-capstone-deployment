<div id="feedback-modal" class="fixed inset-0 z-50 bg-surface-dark/30 backdrop-blur-md flex items-center justify-center"
    style="display: none">
    <div
        class="w-full max-w-2xl bg-white/95 backdrop-blur-sm rounded-radius shadow-xl ring-1 ring-sky-100 overflow-hidden relative">
        <!-- Header -->
        <div class="bg-gradient-to-r from-sky-600 to-blue-600 px-6 py-5 shadow-sm">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="size-9 rounded-radius bg-white/10 flex items-center justify-center ring-1 ring-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-white">
                            <path
                                d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-semibold leading-tight">We value your feedback</h2>
                        <p class="text-white/80 text-xs">Help us improve J-Hunting with your suggestions</p>
                    </div>
                </div>
                <button onclick="$('#feedback-modal').fadeOut()" aria-label="Close feedback modal"
                    class="text-white/90 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/50 px-2 py-1 rounded-radius -mr-2">&times;</button>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <p class="text-sm text-on-surface mb-5 text-center">Thank you for using J-Hunting. Your insights help us
                improve the experience for everyone in Borongan City.</p>
            <div class="h-px bg-sky-100/70 mb-5"></div>

            <!-- Form -->
            <form id="feedbackForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1 text-on-surface">Email (auto filled)</label>
                    <span name="email"
                        class="inline-block w-full px-3 py-2 rounded-radius text-on-surface-strong bg-sky-50/70 ring-1 ring-sky-100"></span>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-on-surface">Feedback message</label>
                    <textarea name="feedback_content" placeholder="Your thoughts, suggestions, or any issues you faced..."
                        class="w-full border border-sky-100 px-3 py-2 rounded-radius focus:outline-none focus:ring-2 focus:ring-sky-500/40 focus:border-sky-400 hover:border-sky-300 placeholder:text-on-surface/60 shadow-sm"
                        rows="5" autocapitalize="sentences" required></textarea>
                    <p class="mt-2 text-xs text-center text-red-500">Please keep your feedback respectful. Offensive
                        words will not be tolerated.</p>
                </div>

                <input type="hidden" name="rating" id="rating-input">

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-on-surface">Rating</label>
                    <div class="flex items-center gap-3">
                        <div id="star-template"
                            class="flex text-sky-400 [&>svg]:cursor-pointer [&>svg]:transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-sky-600 to-blue-600 text-white px-4 py-2 rounded-radius hover:from-sky-700 hover:to-blue-700 cursor-pointer shadow-md ring-1 ring-sky-500/20">Submit</button>
            </form>
        </div>
    </div>
</div>
