<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>J-Hunting | @yield('title', '')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/heroicons@2.0.13/dist/heroicons.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    {{-- JS --}}

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('assets/icons/borongan_icon.png') }}" type="image/x-icon">

    @stack('scripts')

    @vite(['resources/css/app.css'])
</head>

<body class="bg-white text-gray-800 [font-family: 'Poppins';]">
    <nav class="bg-white shadow border-b-2 border-blue-600">
        <div class="container mx-auto py-2 flex items-center justify-between">
            <nav class="sticky top-0 z-10 flex items-center justify-between px-4 py-2" aria-label="top navibation bar">
                <div class="relative right-0">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex w-full items-center rounded-radius gap-2 p-2 text-left text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                        <img src="{{ asset('assets/icons/j_hunting_icon.png') }}"
                            class="size-8 object-cover rounded-full border border-sky-800" alt="avatar"
                            aria-hidden="true" />
                        <div class="hidden md:flex flex-col">
                            <span class="text-sm font-bold text-on-surface-strong">J-Hunting</span>
                            <span class="sr-only">profile settings</span>
                        </div>
                    </a>
                </div>
            </nav>
        </div>
    </nav>

    <main class="container mx-auto py-2 bg-white">
        <div class="w-full fixed top-18 z-[9999]">
            <x-message-box />
        </div>
        {{ $slot }}
    </main>
    <x-mailing />
</body>

</html>
