@section('title', 'Settings')
<x-employer.main-layout heading="Settings">
    <div class="w-full h-fit p-4 space-y-8">
        {{-- Change Password Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-6">
                <h2 class="text-white text-xl font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <circle cx="12" cy="16" r="1" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Change Password
                </h2>
                <p class="text-sky-100 mt-2">Update your account password for better security</p>
            </div>

            <form id="changePasswordForm" class="p-6">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">
                                Current Password
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password"
                                    placeholder="Enter current password"
                                    class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2" />
                                        <circle cx="12" cy="16" r="1" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="new_password" class="block text-sm font-medium text-gray-700">
                                New Password
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password" id="new_password"
                                    placeholder="Enter new password"
                                    class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2" />
                                        <circle cx="12" cy="16" r="1" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="confirm" class="block text-sm font-medium text-gray-700">
                            Type <span class="font-bold text-red-600">CONFIRM</span> to confirm the changes
                        </label>
                        <input id="confirm" name="confirm" type="text" placeholder="Type CONFIRM here"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end">
                    <button type="submit"
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
            </form>
        </div>

        {{-- Delete Account Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-red-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-6">
                <h2 class="text-white text-xl font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                    </svg>
                    Delete Account
                </h2>
                <p class="text-red-100 mt-2">Permanently delete your account and all associated data</p>
            </div>

            <form id="deleteAccountForm" class="p-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 mt-0.5 mr-3"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                            <line x1="12" y1="9" x2="12" y2="13" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">Warning</h3>
                            <p class="text-sm text-red-700 mt-1">This action cannot be undone. This will permanently
                                delete your account and remove all data from our servers.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    placeholder="Enter your password"
                                    class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2" />
                                        <circle cx="12" cy="16" r="1" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Confirm your password"
                                    class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2" />
                                        <circle cx="12" cy="16" r="1" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="delConfirm" class="block text-sm font-medium text-gray-700">
                            Type <span class="font-bold text-red-600">CONFIRM</span> to confirm account deletion
                        </label>
                        <input id="delConfirm" name="delete-confirm" type="text" placeholder="Type CONFIRM here"
                            class="w-full border border-gray-200 bg-white px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end">
                    <button id="deleteButton" type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline mr-2" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 6h18" />
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                        </svg>
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const changePasswordRoute = "{{ route('emp.edit.password') }}"
            const deleteAccountRoute = "{{ route('emp.account.delete') }}"
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/employer/settings.js') }}"></script>
    @endpush
</x-employer.main-layout>
