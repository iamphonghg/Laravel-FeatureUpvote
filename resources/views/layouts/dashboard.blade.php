<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <livewire:styles />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans font-semibold text-gray-900 text-sm">
    <nav class="bg-white border-b-2 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center h-full space-x-10">
                    <div class="flex items-center text-white">
                        <svg class="h-10 w-10 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
                        </svg>
                        <a href="#" class="text-xl font-bold text-gray-900 px-1">Feature Vote</a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-center space-x-4">
                            <a href="#"
                                class="text-gray-800 px-3 leading-10 text-base border-blue border-b-2 py-3">Boards
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:bg-gray-700 hover:text-white px-3 py-3 rounded-md text-base">Team
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div>
                            <div class="ml-3 flex items-center justify-between space-x-3">
                                @auth
                                    <div class="text-blue font-bold">
                                        {{ auth()->user()->name }}
                                    </div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a
                                            href="{{ route('logout') }}"
                                            onclick="
                                                event.preventDefault();
                                                this.closest('form').submit();
                                            "
                                            class="w-28 text-sm text-blue hover:text-white hover:bg-blue rounded-full border-2 border-blue py-1 px-4 uppercase font-bold leading-none transition ease-in duration-150 text-center">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div>
            @yield('content')
        </div>
    </main>
    <livewire:scripts />
</body>

</html>
