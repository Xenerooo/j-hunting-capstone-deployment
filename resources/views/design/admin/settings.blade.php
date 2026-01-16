@section('title', 'Settings')
<x-admin.main-layout heading="Settings">

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
            <div class="max-w-3xl mx-auto">
                <!-- Header -->
                <div class="mb-6 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Account Settings</h2>
                    <p class="text-gray-600">Update your password. Please fill out all the fields.</p>
                </div>

                <form class="bg-white/80 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg p-6">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-base font-semibold text-gray-900">Change password</h3>
                            <p class="mt-1 text-sm text-gray-600">Ensure your account is using a strong password.</p>

                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="current_password"
                                        class="block text-sm font-medium text-gray-700">Current password</label>
                                    <div class="mt-2">
                                        <input type="password" name="current_password" id="current_password"
                                            class="block w-full rounded-xl bg-white/90 px-4 py-3 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition" />
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="new_password" class="block text-sm font-medium text-gray-700">New
                                        password</label>
                                    <div class="mt-2">
                                        <input type="password" name="new_password" id="new_password"
                                            class="block w-full rounded-xl bg-white/90 px-4 py-3 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition" />
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="confirm" class="block text-sm font-medium text-gray-700">Type
                                        <strong>CONFIRM</strong> to confirm the changes</label>
                                    <div class="mt-2">
                                        <input id="confirm" name="confirm" type="text"
                                            class="block w-full rounded-xl bg-white/90 px-4 py-3 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-3">
                        <button type="submit"
                            class="rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-md hover:shadow-lg hover:from-sky-700 hover:to-blue-700 transition">
                            Save
                        </button>
                    </div>
                </form>
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
    </style>


    @push('scripts')
        <script>
            const token = "{{ csrf_token() }}";
            const changePasswordRoute = "{{ route('admin.change.password') }}";
        </script>
        <script src="{{ asset('js/admin/settings.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-admin.main-layout>
