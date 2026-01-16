@section('title', 'Forgot Password')

<x-auth.auth-layout>
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="max-w-2xl w-2xl mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-gray-300 border border-gray-300">
            <h1 class="text-2xl font-medium">Reset password</h1>
            <p class="text-gray-500">Please enter your email to reset the password.</p>

            <form id="forgot-password-form" class="mt-10" method="POST">
                @csrf
                <div class="flex flex-col space-y-5">
                    <label for="email">
                        <p class="font-medium text-gray-700 pb-2">Email address</p>
                        <input id="email" name="email" type="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:outline-0 block w-full p-2.5"
                            placeholder="Enter email address" autocomplete="off">
                    </label>

                    <button type='submit'
                        class="w-full text-white bg-sky-700 hover:bg-blue-500 focus:ring-0 focus:outline-0 font-medium rounded text-sm px-5 py-2.5 text-center duration-200 cursor-pointer">
                        Send email
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const linkRoute = "{{ route('password.email') }}"
            const csrfToken = "{{ csrf_token() }}"
        </script>

        {{-- <script src="{{ asset('js/auth/sign-in.js') }}"></script> --}}
        <script src="{{ asset('js/auth/forgot-password.js') }}"></script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-auth.auth-layout>
