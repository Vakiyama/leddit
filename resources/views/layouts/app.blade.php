<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Leddit</title>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">Leddit</a>
                        </div>
                        <div class="hidden space-x-8 sm:flex sm:ml-10 sm:items-center">
                            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Blog</a>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center">
                        @guest
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 mx-2">Login</a>
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-gray-900 mx-2">Register</a>
                        @else
                            <a href="{{ route('posts.create') }}" class="text-sm text-blue-600 hover:text-blue-800 mx-4">New Post</a>

                            <div class="relative ml-3" id="user-dropdown-container">
                                <div>
                                    <button id="user-dropdown-button" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <div id="user-dropdown-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>

                    <div class="flex items-center sm:hidden">
                        <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                            <span class="sr-only">Open main menu</span>
                            <svg id="menu-closed-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg id="menu-open-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div id="mobile-menu" class="hidden sm:hidden border-t border-gray-200">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('posts.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Blog</a>
                </div>

                <div class="pt-4 pb-3 border-t border-gray-200">
                    @guest
                        <div class="space-y-1">
                            <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Login</a>
                            <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Register</a>
                        </div>
                    @else
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('posts.create') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">New Post</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
                               class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                                Logout
                            </a>
                            <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuClosedIcon = document.getElementById('menu-closed-icon');
            const menuOpenIcon = document.getElementById('menu-open-icon');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    const isMenuOpen = mobileMenu.classList.toggle('hidden');

                    if (isMenuOpen) {
                        menuClosedIcon.classList.remove('hidden');
                        menuOpenIcon.classList.add('hidden');
                    } else {
                        menuClosedIcon.classList.add('hidden');
                        menuOpenIcon.classList.remove('hidden');
                    }
                });
            }

            const userDropdownButton = document.getElementById('user-dropdown-button');
            const userDropdownMenu = document.getElementById('user-dropdown-menu');

            if (userDropdownButton && userDropdownMenu) {
                userDropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdownMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function(e) {
                    if (!userDropdownButton.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                        userDropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
