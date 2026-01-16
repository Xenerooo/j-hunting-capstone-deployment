@section('title', 'Notification')
<x-employer.main-layout heading="Notification">
    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Sort Filter -->
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18" />
                    <path d="M7 12h10" />
                    <path d="M10 18h4" />
                </svg>
                <label for="select_sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                <select id="select_sort"
                    class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 pr-6 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200">
                    <option value="all">All</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </div>

            <!-- Notification Actions -->
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                </svg>
                <span class="text-sm font-medium text-gray-700">Manage your notifications</span>
            </div>
        </div>
    </div>

    <!-- Notifications Container -->
    <div class="space-y-4" id="notification-container">
    </div>

    @push('scripts')
        <script>
            const getNotificationRoute = "{{ route('emp.notification.get') }}"
            const deleteNotificationRoute = "{{ route('emp.notification.delete') }}"
            const jhuntingProfile = "{{ asset('assets/icons/j_hunting_icon.png') }}"
        </script>
        <script src="{{ asset('js/custom/loader.js') }}"></script>
        <script src="{{ asset('js/employer/notification.js') }}"></script>
    @endpush
</x-employer.main-layout>
