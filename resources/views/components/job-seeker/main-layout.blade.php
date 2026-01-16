<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('assets/icons/borongan_icon.png') }}" type="image/x-icon">

    @stack('scripts')
    <title>J-Hunting | @yield('title', '')</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100" x-data="{ modalIsOpen: false }">
    @include('components.loader')
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
        x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false">
        <x-job-seeker.feedback-modal />
    </div>

    <div x-data="{ sidebarIsOpen: false }" class="relative flex w-full flex-col md:flex-row">

        <a class="sr-only" href ="#main-content">skip to the main content</a>
        <div x-cloak x-show="sidebarIsOpen" class="fixed inset-0 z-20 bg-surface-dark/10 backdrop-blur-xs md:hidden"
            aria-hidden="true" x-on:click="sidebarIsOpen = false" x-transition.opacity></div>

        <nav x-cloak
            class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-outline bg-surface-alt transition-transform duration-300 md:w-64 md:translate-x-0 md:relative "
            x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

            {{-- logo --}}
            <a href="#"
                class="w-full flext justify-center items-center text-2xl py-5 font-bold text-on-surface-strong bg-sky-600">
                <span class="sr-only">homepage</span>
                <img src="{{ asset('assets/icons/borongan_logo_white.png') }}" class="mx-auto w-full" alt="">
            </a>

            <div class="bg-gray-600 h-[1px]"></div>

            {{-- nav links --}}
            <div class="flex flex-col gap-2 overflow-y-auto mt-6 pb-6">

                <x-nav-links href="{{ route('js.dashboard') }}" :active="request()->routeIs('js.dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg> &nbsp;
                    Dashboard</x-nav-links>

                <x-nav-links href="{{ route('js.applied') }}" :active="request()->routeIs('js.applied')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-file-check2-icon lucide-file-check-2">
                        <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        <path d="m3 15 2 2 4-4" />
                    </svg> &nbsp;
                    Applied Jobs</x-nav-links>

                <x-nav-links href="{{ route('js.interview') }}" :active="request()->routeIs('js.interview')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-speech-icon lucide-speech">
                        <path
                            d="M8.8 20v-4.1l1.9.2a2.3 2.3 0 0 0 2.164-2.1V8.3A5.37 5.37 0 0 0 2 8.25c0 2.8.656 3.054 1 4.55a5.77 5.77 0 0 1 .029 2.758L2 20" />
                        <path d="M19.8 17.8a7.5 7.5 0 0 0 .003-10.603" />
                        <path d="M17 15a3.5 3.5 0 0 0-.025-4.975" />
                    </svg> &nbsp;
                    Job Interviews</x-nav-links>

                <x-nav-links href="{{ route('js.following') }}" :active="request()->routeIs('js.following')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users-icon lucide-users">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg> &nbsp;
                    Following Employers</x-nav-links>

                <x-nav-links href="{{ route('js.notification') }}" :active="request()->routeIs('js.notification')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-bell-icon lucide-bell">
                        <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                        <path
                            d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                    </svg> &nbsp;
                    Notification</x-nav-links>

                <div class="bg-gray-400 h-[1px] m-2"></div>
                <x-nav-links href="{{ route('js.profile') }}" :active="request()->routeIs('js.profile')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="10" r="3" />
                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                    </svg> &nbsp;
                    Profile</x-nav-links>
                <x-nav-links href="{{ route('js.settings') }}" :active="request()->routeIs('js.settings')">
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
                        class=" flex flex-row items-center px-2 mx-2 py-1.5 text-sm font-medium rounded overflow-hidden w-[95%] hover:bg-sky-400/90 hover:text-white duration-200 cursor-pointer ">
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
            <button id="seeker-feedback-button" x-on:click="modalIsOpen = true"
                class="fixed bottom-7 left-[30%] text-center text-gray-600 text-sm px-2 py-1.5 underline cursor-pointer duration-200">Feedback</button>
        </nav>

        <!-- top navbar & main content  -->
        <div class="h-svh w-full overflow-y-auto bg-surface ">
            <!-- top navbar  -->
            <nav class="sticky top-0 z-10 flex items-center justify-between border-b border-outline bg-surface-alt px-4 py-2"
                aria-label="top navibation bar">

                <!-- sidebar toggle button for small screens  -->
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
                            <a href="#" class="hover:text-on-surface-strong">Job seeker</a>
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
                    <a href="{{ route('js.profile') }}"
                        class="flex w-full items-center rounded-radius gap-2 p-2 text-left text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                        x-bind:class="userDropdownIsOpen ? 'bg-primary/10 dark:bg-primary-dark/10' : ''"
                        aria-haspopup="true" x-on:click="userDropdownIsOpen = ! userDropdownIsOpen"
                        x-bind:aria-expanded="userDropdownIsOpen">
                        <img id="top_profile_picture" src=""
                            class="size-8 object-cover rounded-full border border-sky-600" alt="avatar"
                            aria-hidden="true" />
                        <div class="hidden md:flex flex-col">
                            <span class="text-sm font-bold text-on-surface-strong" name="first_name">Your Name</span>
                            <span class="sr-only">profile settings</span>
                        </div>
                    </a>
                </div>
            </nav>
            <!-- main content  -->
            <div id="main-content" class="p-4">
                <x-message-box />
                <x-logout-modal />
                <div class="overflow-y-auto ">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    {{-- pag retrieve hit email ni logged in user --}}
    <script>
        $.ajax({
            type: "GET",
            url: "{{ route('js.get.email') }}",
            dataType: "json",
            success: function(response) {
                console.log(response);

                $("[name='email']").text(response.data.email);
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const errorValue = Object.values(errors)[0][0];

                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Validation Error",
                        errorValue
                    );
                } else {
                    console.log("Other error:", error);
                }
            },
        });
    </script>

    {{-- retrieve profile pic and first name for top nav  --}}
    <script>
        $.ajax({
            type: "get",
            url: "{{ route('js.get.profile') }}",
            dataType: "json",
            success: function(response) {

                const imgUrl = response.profile_details.profile_pic ?
                    `/storage/${response.profile_details.profile_pic}` :
                    'https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg';

                $('#top_profile_picture').attr("src", imgUrl);
                $('[name="first_name"]').text(response.profile_details.first_name);
            },
            error: function(error, xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    console.log(errors);
                } else {
                    console.log("Other error:", error);
                }
            },
        });
    </script>

    {{-- logout modal functionality langs --}}
    <script>
        $(function() {
            $("#logout").on('click', function(e) {
                e.preventDefault()

                $("#confirm-logout").on('click', function() {
                    $.ajax({
                        type: "post",
                        url: "{{ route('js.logout') }}",
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

    <script>
        const token = "{{ csrf_token() }}"
        const feedbackRoute = "{{ route('js.send.feedback') }}"
    </script>
    <script src="{{ asset('js/job-seeker/feedback.js') }}"></script>
</body>

</html>
