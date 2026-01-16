@section('title', 'Notification')
<x-job-seeker.main-layout heading="Notification">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            {{-- sorting --}}
            <form action="" class="w-fit flex items-center justity-center gap-3">
                <label for="select_sort" class="text-xs">Sort by</label>
                <select id="select_sort"
                    class="text-gray-700 text-sm border border-gray-300 rounded-md py-2 transition duration-300 ease focus:ring-0 focus:outline-none">
                    <option value="all">All</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </form>
        </div>

        <div class="w-full h-fit space-y-1" id="notification-container">
        </div>
    </div>

    @push('scripts')
        <script>
            const getNotificationRoute = "{{ route('js.notification.get') }}"
            const deleteNotificationRoute = "{{ route('js.notification.delete') }}"
            const jhuntingProfile = "{{ asset('assets/icons/j_hunting_icon.png') }}"
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/job-seeker/notification.js') }}"></script>
    @endpush
</x-job-seeker.main-layout>
