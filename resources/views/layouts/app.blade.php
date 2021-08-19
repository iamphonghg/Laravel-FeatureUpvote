<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Feature Vote</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles />
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans font-semibold bg-gray-background text-gray-900 text-sm">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <div class="flex items-center text-white">
                <svg class="h-10 w-10 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
                </svg>
                <a href="#" class="text-xl font-bold text-gray-900 px-1">Feature Vote</a>
            </div>
            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="px-6 py-4 flex items-center">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a
                                    href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="w-28 text-sm text-blue hover:text-white hover:bg-blue rounded-full border-2 border-blue py-1 px-4 uppercase font-bold leading-none transition ease-in duration-150 text-center"
                                >
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                            <a href="{{ route('board.index') }}" class="mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-blue h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="w-44 text-sm text-blue hover:text-white hover:bg-blue rounded-full border-2 border-blue py-1 px-4 uppercase font-bold leading-none transition ease-in duration-150 text-center">Log in as admin
                            </a>
                        @endauth
                    </div>
                @endif


            </div>
        </header>

        <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
            <div class="w-70 mx-auto md:mx-0 md:mr-5">
                <div class="bg-white sticky top-8 border-2 border-blue rounded-xl mt-16">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="text-lg font-bold">Add a suggestion</h3>
                        <p class="text-sm mt-4">Let us know what you would like and we'll take a look over!</p>
                    </div>
                    <livewire:create-suggestion
                        :urlName="$urlName"
                    />

                </div>
            </div>
            <div class="w-full px-2 md:px-0 md:w-175">
                <livewire:status-filters
                    :urlName="$urlName"
                />

                <div class="mt-8">
                    @yield('content')
                </div>
            </div>
        </main>
        <livewire:scripts />
    </body>
</html>
