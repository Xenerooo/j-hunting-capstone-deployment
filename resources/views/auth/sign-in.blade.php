@section('title', 'Sign In')

<x-auth.auth-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-blue-50 py-12 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white/90 rounded-2xl shadow-xl border border-gray-200 p-8 space-y-8">
                <div class="flex flex-col items-center">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <h1 class="head-title text-2xl font-bold text-gray-900 mb-2">Sign in to your account</h1>
                </div>
                <form class="space-y-5" action="{{ route('sign.in.submit') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-0 block w-full p-3 transition"
                            placeholder="name@company.com" value="{{ old('email') }}" />
                        <x-form-validation name="email" />
                        @if (session('not_verified'))
                            <script>
                                const resendUrl = "{{ session('resend_url') }}";
                                Swal.fire({
                                    title: "Your account is not verified!",
                                    text: "Please click 'Resend Email' button to resend the verification email.",
                                    confirmButtonText: "Resend Email",
                                    icon: "warning",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = resendUrl;
                                    }
                                });
                            </script>
                        @endif
                    </div>
                    <div>
                        <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-0 block w-full p-3 transition"
                            value="{{ old('password') }}" />
                        <x-form-validation name="password" />
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:outline-0 focus:ring-0" />
                            <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>
                        </div>
                        <a href="{{ route('password.forgot') }}" class="text-sm text-sky-700 hover:underline">Forgot
                            Password?</a>
                    </div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-sky-700 to-blue-600 hover:from-sky-800 hover:to-blue-700 text-white font-semibold rounded-lg text-base px-5 py-3 text-center shadow transition duration-200 cursor-pointer">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-auth.auth-layout>
