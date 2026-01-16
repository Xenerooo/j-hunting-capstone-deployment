<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="shortcut icon" href="{{ asset('assets/icons/borongan_icon.png') }}" type="image/x-icon">

    @stack('scripts')

    <style>
        @keyframes slide {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(20px);
            }
        }

        .animate-slide {
            animation: slide 4s ease-in-out infinite;
        }
    </style>

    <title>J-Hunting | @yield('title', '')</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
    @include('components.loader')

    <div x-data="{ sidebarIsOpen: false }" class="relative flex w-full flex-col md:flex-row"
        x-bind:class="sidebarIsOpen ? 'overflow-hidden h-svh' : ''">

        <a class="sr-only" href ="#main-content">skip to the main content</a>
        <div x-cloak x-show="sidebarIsOpen" class="fixed inset-0 z-20 bg-surface-dark/10 backdrop-blur-xs md:hidden"
            aria-hidden="true" x-on:click="sidebarIsOpen = false" x-transition.opacity></div>

        <nav x-cloak
            class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-sky-100 bg-white/90 backdrop-blur-sm shadow-sm transition-transform duration-300 md:w-64 md:translate-x-0 md:relative "
            x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

            {{-- logo --}}
            <a href="#"
                class="w-full flext justify-center items-center text-2xl py-5 font-bold text-white bg-gradient-to-r from-sky-600 to-blue-600 shadow-sm">
                <span class="sr-only">homepage</span>
                <img src="{{ asset('assets/icons/borongan_logo_white.png') }}" class="mx-auto w-full" alt="">
            </a>

            <div class="bg-sky-100 h-[1px]"></div>

            {{-- nav links --}}
            <div class="flex flex-col gap-2 overflow-y-auto mt-6 pb-6 px-2">

                <x-nav-links href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg> &nbsp;
                    Dashboard</x-nav-links>

                <x-nav-links href="{{ route('admin.seekers') }}" :active="request()->routeIs('admin.seekers')">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0  0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                    </svg>
                    &nbsp;
                    All Job Seekers</x-nav-links>

                <x-nav-links href="{{ route('admin.employers') }}" :active="request()->routeIs('admin.employers')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-file-check2-icon lucide-file-check-2">
                        <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        <path d="m3 15 2 2 4-4" />
                    </svg> &nbsp;
                    All Employers</x-nav-links>

                <x-nav-links href="{{ route('admin.jobs') }}" :active="request()->routeIs('admin.jobs')">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20"
                        height="20" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01" />
                    </svg>
                    &nbsp;
                    All Jobs</x-nav-links>

                @php
                    $isReportedRoute =
                        request()->routeIs('admin.request.seeker') ||
                        request()->routeIs('admin.request.employer') ||
                        request()->routeIs('admin.request.job');
                @endphp
                <div x-data="{ open: {{ $isReportedRoute ? 'true' : 'false' }} }" class="mx-2">
                    <button @click="open = !open"
                        class="w-full flex items-center gap-2 px-2 py-1.5 text-sm font-medium rounded-radius duration-200 focus:outline-none hover:bg-sky-100 hover:text-sky-700 text-start"
                        :class="open ? 'text-sky-700 bg-sky-50' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-file-plus2-icon lucide-file-plus-2">
                            <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M3 15h6" />
                            <path d="M6 12v6" />
                        </svg>
                        Request
                        <svg class="ml-auto w-4 h-4 transition-transform" :class="{ 'rotate-90': open }"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-cloak class="ml-6 mt-1 space-y-1">
                        <x-nav-links href="{{ route('admin.request.job') }}" :active="request()->routeIs('admin.request.job')">
                            Jobs
                        </x-nav-links>
                        <x-nav-links href="{{ route('admin.request.seeker') }}" :active="request()->routeIs('admin.request.seeker')">
                            Job Seekers
                        </x-nav-links>
                        <x-nav-links href="{{ route('admin.request.employer') }}" :active="request()->routeIs('admin.request.employer')">
                            Employers
                        </x-nav-links>
                    </div>
                </div>

                @php
                    $isReportedRoute =
                        request()->routeIs('admin.reported.seeker') ||
                        request()->routeIs('admin.reported.employer') ||
                        request()->routeIs('admin.reported.job');
                @endphp
                <div x-data="{ open: {{ $isReportedRoute ? 'true' : 'false' }} }" class="mx-2">
                    <button @click="open = !open"
                        class="w-full flex items-center gap-2 px-2 py-1.5 text-sm font-medium rounded-radius duration-200 focus:outline-none hover:bg-sky-100 hover:text-sky-700 text-start"
                        :class="open ? 'text-sky-700 bg-sky-50' : ''">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path
                                d="M12 5.464V3.099m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C19 17.4 19 18 18.462 18H5.538C5 18 5 17.4 5 16.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.464ZM6 5 5 4M4 9H3m15-4 1-1m1 5h1M8.54 18a3.48 3.48 0 0 0 6.92 0H8.54Z" />
                        </svg>
                        Reported
                        <svg class="ml-auto w-4 h-4 transition-transform" :class="{ 'rotate-90': open }"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-cloak class="ml-6 mt-1 space-y-1">
                        <x-nav-links href="{{ route('admin.reported.job') }}" :active="request()->routeIs('admin.reported.job')">
                            Jobs
                        </x-nav-links>
                        <x-nav-links href="{{ route('admin.reported.seeker') }}" :active="request()->routeIs('admin.reported.seeker')">
                            Job Seekers
                        </x-nav-links>
                        <x-nav-links href="{{ route('admin.reported.employer') }}" :active="request()->routeIs('admin.reported.employer')">
                            Employers
                        </x-nav-links>
                    </div>
                </div>

                <x-nav-links href="{{ route('admin.feedback') }}" :active="request()->routeIs('admin.feedback')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-message-circle-icon lucide-message-circle">

                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                    </svg> &nbsp;
                    Manage Feedback</x-nav-links>

                <div class="bg-sky-100 h-[1px] m-2"></div>

                <x-nav-links href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings">
                        <path
                            d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg> &nbsp;
                    Settings</x-nav-links>
                <form method="post">
                    <button type="submit" id="logout" data-modal-target="logoutModal"
                        data-modal-toggle="logoutModal"
                        class=" flex flex-row items-center px-2 mx-2 py-1.5 text-sm font-medium rounded overflow-hidden w-[95%] hover:bg-sky-100 hover:text-sky-700 duration-200 cursor-pointer ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5 shrink-0" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z"
                                clip-rule="evenodd" />
                        </svg> &nbsp;
                        Logout</button>
                </form>

            </div>
        </nav>

        <!-- top navbar & main content  -->
        <div class="h-svh w-full overflow-y-auto bg-surface ">
            <!-- top navbar  -->
            <nav class="sticky top-0 z-30 flex items-center justify-between border-b border-outline bg-surface-alt/95 backdrop-blur-md shadow-sm px-4 py-2"
                aria-label="top navibation bar">
                <button type="button" class="md:hidden inline-block text-on-surface "
                    x-on:click="sidebarIsOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu">
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />
                        <path d="M4 6h16" />
                    </svg>
                    <span class="sr-only">sidebar toggle</span>
                </button>

                <nav class="hidden md:inline-block text-sm font-medium text-on-surface " aria-label="breadcrumb">
                    <ol class="flex flex-wrap items-center gap-1">
                        <li class="flex items-center gap-1">
                            <a href="#" class="hover:text-on-surface-strong">Admin</a>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                fill="none" stroke-width="2" class="size-4" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </li>

                        <li class="flex items-center gap-1 font-bold text-on-surface-strong " aria-current="page">
                            {{ $heading }}</li>
                    </ol>
                </nav>

                <!-- Profile Menu  -->
                <div x-data="{ userDropdownIsOpen: false }" class="relative" x-on:keydown.esc.window="userDropdownIsOpen = false">
                    <a href="#"
                        class="flex w-full items-center rounded-radius gap-2 p-2 text-left text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                        x-bind:class="userDropdownIsOpen ? 'bg-primary/10 dark:bg-primary-dark/10' : ''"
                        aria-haspopup="true" x-on:click="userDropdownIsOpen = ! userDropdownIsOpen"
                        x-bind:aria-expanded="userDropdownIsOpen">
                        <img src="{{ asset('assets/icons/j_hunting_logo.png') }}"
                            class="size-8 object-cover rounded-full border border-sky-800" alt="avatar"
                            aria-hidden="true" />
                        <div class="hidden md:flex flex-col">
                            <span class="text-sm font-bold text-on-surface-strong">J-Hunting</span>
                            <span class="sr-only">profile settings</span>
                        </div>
                    </a>
                </div>
            </nav>
            <!-- main content  -->
            <div id="main-content" class="p-4 bg-white">
                <div class="overflow-y-auto ">
                    <x-message-box />
                    <x-logout-modal />
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    {{-- for logout lamang --}}
    <script>
        $(function() {
            $("#logout").on('click', function(e) {
                e.preventDefault()

                $("#confirm-logout").on('click', function() {

                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.logout') }}",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(response) {
                            location.href = "{{ route('index') }}"
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                })
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
