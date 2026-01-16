<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J-Hunting | @yield('title', '')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" href="{{ asset('assets/icons/borongan_icon.png') }}" type="image/x-icon">
    @stack('scripts')
    @vite(['resources/css/app.css'])

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>


    <!-- Auth Navbar (Elevated Design) -->
    <nav
        class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full z-30 top-0 transition-all duration-300 border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Return -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gradient-to-r from-sky-50 to-blue-100 hover:from-sky-100 hover:to-blue-200 text-sky-700 font-semibold shadow-sm hover:shadow-md transition-all duration-200 border border-sky-100">
                        <span
                            class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-r from-sky-500 to-blue-600 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left text-white">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                        </span>
                        <span class="text-base md:text-lg font-medium tracking-wide">Return to Landing Page</span>
                    </a>
                </div>
                <!-- Brand (optional) -->
                <div class="hidden md:flex items-center">
                    <span class="text-xl font-bold text-sky-700 tracking-tight select-none">J-Hunting</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-10 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <div class="w-full fixed top-20 left-0 flex justify-center z-40 pointer-events-none">
            <div class="w-full max-w-lg px-4">
                <x-message-box />
            </div>
        </div>
        <div class="relative z-10">
            {{ $slot }}
        </div>
    </main>
    <x-mailing />
    <x-loader />

</body>

</html>
