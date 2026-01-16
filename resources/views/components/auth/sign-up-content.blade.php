<div class="grid md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block mb-2 font-medium">Email</label>
        <input type="email" name="email" placeholder="you@example.com"
            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-0"
            value="{{ old('email') }}" />
    </div>
    <div class="md:col-span-2">
        <label class="block mb-2 font-medium">Password</label>
        <input type="password" name="password" placeholder="••••••••"
            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-0"
            value="{{ old('password') }}" />
    </div>
    <div class="md:col-span-2">
        <label class="block mb-2 font-medium">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="••••••••"
            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-0"
            value="{{ old('password_confirmation') }}" />
    </div>
    <div class="md:col-span-2 flex w-full items-start">
        <div class="flex items-center h-5">
            <input id="confirmation_radio" name="confirmation_radio" type="checkbox"
                class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:outline-0 focus:ring-0" />
        </div>
        <label class="ms-2 text-sm text-gray-800 w-full">Are you sure you are a <strong x-data
                x-text="tab === 'job_seeker' ? 'Job Seeker' : 'Employer'"></strong>
            ?</label>
    </div>

    <script>
        $('#terms_link').on('click', function(e) {
            console.log("Terms clicked");
        })
    </script>
</div>
