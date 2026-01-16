@section('title', 'Sign Up')

<x-auth.auth-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-blue-50 py-12 px-4">
        <div class="w-full max-w-lg">
            <div x-data="userTypeSwitcher" class="bg-white/90 rounded-2xl shadow-xl border border-gray-200 p-8 space-y-8">
                <div class="flex flex-col items-center mb-4">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Create your account</h1>
                </div>
                <div id="error-wrapper" class="hidden w-full my-1 p-2 rounded-sm items-center">
                    <span class="mr-1">&#x2022;</span>
                    <span class="text-sm" name="error-message">Error description</span>
                </div>
                <form id="signUpForm" method="post" class="space-y-6">
                    <!-- User Type Tabs -->
                    <div class="relative w-full mb-6">
                        <div class="grid grid-cols-2 border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                            <div class="absolute top-0 left-0 h-full w-1/2 transition-all duration-300 ease-in-out bg-sky-600 z-0"
                                :class="tab === 'employer' ? 'translate-x-full' : 'translate-x-0'"></div>
                            <div class="relative z-10">
                                <a @click="updateUserType('job_seeker')"
                                    class="block text-center py-3 cursor-pointer font-semibold transition duration-200"
                                    :class="tab === 'job_seeker' ? 'text-white' : 'text-gray-700'">
                                    Job Seeker
                                </a>
                            </div>
                            <div class="relative z-10">
                                <a @click="updateUserType('employer')"
                                    class="block text-center py-3 cursor-pointer font-semibold transition duration-200"
                                    :class="tab === 'employer' ? 'text-white' : 'text-gray-700'">
                                    Employer
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Content -->
                    <input type="hidden" name="user_type" :value="tab">
                    <div>
                        <section x-show="tab === 'job_seeker'">
                            <x-auth.sign-up-content />
                        </section>
                        <section x-show="tab === 'employer'">
                            <x-auth.sign-up-content />
                        </section>
                    </div>
                    <div class="flex items-start gap-2 text-sm text-gray-700">
                        <input id="agree" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:outline-0 focus:ring-0">
                        <label class="text-sm text-gray-800 w-full" for="agree">I agree to the <a href="#"
                                id="open-terms-link"
                                class="text-sky-600 hover:text-sky-800 hover:underline cursor-pointer">Terms and
                                Conditions</a>.</label>
                    </div>
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-sky-700 to-blue-600 hover:from-sky-800 hover:to-blue-700 text-white font-semibold rounded-lg text-base px-5 py-3 text-center shadow transition duration-200 cursor-pointer">
                            Sign Up
                        </button>
                    </div>

                </form>
            </div>
        </div>
        {{-- TERMS AND CONDITIONS MODAL --}}
        <x-terms-modal>
            <x-terms-template />
        </x-terms-modal>
    </div>


    @push('scripts')
        <script>
            const pageRoute = "{{ route('sign.up.submit') }}";
            const token = "{{ csrf_token() }}";
            const userType = "{{ $user_type }}";
            const emailRoute = "{{ route('email.sent') }}"
        </script>
        <script src="{{ asset('js/auth/sign-up.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script>
            $(function() {
                $(document).on('click', '#open-terms-link', function(e) {
                    e.preventDefault();
                    $('#terms-modal').fadeIn();
                });
            });
            document.addEventListener("alpine:init", function() {
                Alpine.data("userTypeSwitcher", function() {
                    return {
                        tab: "{{ $user_type }}",
                        updateUserType(value) {
                            this.tab = value;
                            $.ajax({
                                url: "{{ route('update.user.type') }}",
                                method: "POST",
                                data: {
                                    user_type: value,
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    //
                                },
                                error: function(xhr) {
                                    console.error(
                                        "Failed to update user type:",
                                        xhr.responseText
                                    );
                                },
                            });
                        },
                    };
                });
            });
        </script>
    @endpush
</x-auth.auth-layout>
