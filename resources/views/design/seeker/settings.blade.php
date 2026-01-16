@section('title', 'Settings')
<x-job-seeker.main-layout heading="Settings">

    <div class="w-full h-fit p-4 ">
        {{-- form change password --}}
        <form id="changePasswordForm" class="bg-gray-100 border border-gray-300 rounded-lg p-3">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Change password</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Please fill out all the fields.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="current_password" class="block text-sm/6 font-medium text-gray-900">Current
                                password</label>
                            <div class="mt-2">
                                <input type="password" name="current_password" id="current_password"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="new_password" class="block text-sm/6 font-medium text-gray-900">New
                                password</label>
                            <div class="mt-2">
                                <input type="password" name="new_password" id="new_password"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="confirm" class="block text-sm/6 font-medium text-gray-900">Type
                                <strong>CONFIRM</strong> to confirm the changes</label>
                            <div class="mt-2">
                                <input id="confirm" name="confirm" type="text"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 cursor-pointer">Save</button>
            </div>
        </form>

        <div class="w-full h-[1px] bg-gray-300 my-10"></div>

        {{-- form delete account --}}
        <form id="deleteAccountForm" class="bg-gray-100 border border-gray-300 rounded-lg p-3">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Delete account</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Please fill out all the fields.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm
                                password</label>
                            <div class="mt-2">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="delConfirm" class="block text-sm/6 font-medium text-gray-900">Type
                                <strong>CONFIRM</strong> to confirm the changes</label>
                            <div class="mt-2">
                                <input id="delConfirm" name="delete-confirm" type="text"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 sm:text-sm/6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button id="deleteButton"
                    class="rounded-md bg-red-600/90 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600/90 cursor-pointer">Delete</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            const changePasswordRoute = "{{ route('js.change.password') }}"
            const deleteAccountRoute = "{{ route('js.delete.account') }}"
        </script>
        <script src="{{ asset('js/job-seeker/settings.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush

</x-job-seeker.main-layout>
