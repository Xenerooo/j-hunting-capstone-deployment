@section('title', 'Email Sent')

<x-auth.auth-layout>
    <div class="max-w-xl mx-auto mt-30 border border-gray-300 bg-white p-6 md:p-10 md:mt-40 rounded-lg shadow-xl">

        <h1 class="text-2xl font-semibold text-sky-600 text-center mb-10">
            Verification email sent!
        </h1>
        <div class="text-center">
            <p class="text-gray-800 text-md">Please check your email and click verify</p>
            <p class="text-gray-800 text-xs"><span class="text-red-600">Note : </span>If you see cant see your email
                verification in your
                primary inbox, look at the spam.
            </p>
        </div>
        <div class="flex justify-between mt-8">
            <a href="{{ route('index') }}"
                class="w-full bg-sky-600 text-gray-100 px-5 py-2 rounded text-center">Confirm</a>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/custom/loader.js') }}"></script>
    @endpush
</x-auth.auth-layout>
