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

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')

    <link rel="shortcut icon" href="{{ asset('assets/icons/borongan_icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])

    <style>
        html {
            scroll-behavior: smooth;
        }

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

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #0ea5e9, #2563eb);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link.active {
            color: #0ea5e9;
            font-weight: 500;
        }

        .mobile-menu {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav
        class="fixed w-full z-50 top-0 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0">
                    <a href="{{ route('index') }}" class="flex items-center group">
                        <img src="{{ asset('assets/icons/borongan_logo.png') }}" alt="J-Hunting"
                            class="h-10 transition-transform duration-300 group-hover:scale-105">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <x-auth.top-nav-layout href="{{ route('index') }}" :active="request()->routeIs('index')"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-sky-600 font-medium text-sm">
                        Home
                    </x-auth.top-nav-layout>
                    <x-auth.top-nav-layout href="{{ route('new.jobs') }}" :active="request()->routeIs('new.jobs')"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-sky-600 font-medium text-sm">
                        New Jobs
                    </x-auth.top-nav-layout>
                    <x-auth.top-nav-layout href="{{ route('new.employers') }}" :active="request()->routeIs('new.employers')"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-sky-600 font-medium text-sm">
                        New Employers
                    </x-auth.top-nav-layout>
                    <x-auth.top-nav-layout href="{{ route('about') }}" :active="request()->routeIs('about')"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-sky-600 font-medium text-sm">
                        About
                    </x-auth.top-nav-layout>
                    <x-auth.top-nav-layout href="{{ route('feedback') }}" :active="request()->routeIs('feedback')"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-sky-600 font-medium text-sm">
                        Feedback
                    </x-auth.top-nav-layout>
                </div>

                <!-- Action Buttons -->
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="{{ route('auth.sign.in') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-transparent border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                        Sign In
                    </a>
                    <a href="{{ route('auth.sign.up') }}"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-sky-500 to-blue-600 rounded-lg shadow-sm hover:shadow-md hover:from-sky-600 hover:to-blue-700 transition-all duration-200 transform hover:-translate-y-0.5">
                        Sign Up
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-button"
                        class="p-2 text-gray-600 hover:text-sky-600 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden mobile-menu border-t border-gray-100">
            <div class="px-4 py-6 space-y-3">
                <a href="{{ route('index') }}"
                    class="block px-4 py-3 text-gray-700 hover:text-sky-600 hover:bg-sky-50 rounded-lg font-medium transition-all duration-200 {{ request()->routeIs('index') ? 'text-sky-600 bg-sky-50' : '' }}">
                    Home
                </a>
                <a href="{{ route('new.jobs') }}"
                    class="block px-4 py-3 text-gray-700 hover:text-sky-600 hover:bg-sky-50 rounded-lg font-medium transition-all duration-200 {{ request()->routeIs('new.jobs') ? 'text-sky-600 bg-sky-50' : '' }}">
                    New Jobs
                </a>
                <a href="{{ route('new.employers') }}"
                    class="block px-4 py-3 text-gray-700 hover:text-sky-600 hover:bg-sky-50 rounded-lg font-medium transition-all duration-200 {{ request()->routeIs('new.employers') ? 'text-sky-600 bg-sky-50' : '' }}">
                    New Employers
                </a>
                <a href="{{ route('about') }}"
                    class="block px-4 py-3 text-gray-700 hover:text-sky-600 hover:bg-sky-50 rounded-lg font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'text-sky-600 bg-sky-50' : '' }}">
                    About
                </a>
                <a href="{{ route('feedback') }}"
                    class="block px-4 py-3 text-gray-700 hover:text-sky-600 hover:bg-sky-50 rounded-lg font-medium transition-all duration-200 {{ request()->routeIs('feedback') ? 'text-sky-600 bg-sky-50' : '' }}">
                    Feedback
                </a>

                <!-- Mobile Action Buttons -->
                <div class="pt-4 space-y-3">
                    <a href="{{ route('auth.sign.in') }}"
                        class="block w-full px-4 py-3 text-center text-gray-700 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 font-medium transition-all duration-200">
                        Sign In
                    </a>
                    <a href="{{ route('auth.sign.up') }}"
                        class="block w-full px-4 py-3 text-center text-white bg-gradient-to-r from-sky-500 to-blue-600 rounded-lg font-medium transition-all duration-200">
                        Sign Up
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="mt-20">
        <div class="w-full max-h-fit">
            {{ $slot }}
        </div>
    </main>

</body>

</html>
