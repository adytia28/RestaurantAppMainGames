<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Restaurant App</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="fixed top-0 left-0 right-0 h-14 bg-sky-500 text-white" x-data="{open:false}">
            <div class="flex items-center justify-between h-full px-8">
                <a href="{{route('home')}}" class="w-4/12 font-bold text-2xl">Restaurant</a>
                <div x-on:click="open = !open" class="cursor-pointer relative flex items-center space-x-2">
                    <span>{{auth()->user()->name}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    <div x-cloak x-show="open" x-on:click.away="open = false" class="absolute top-8 cursor-pointer hover:bg-gray-100 right-0 font-bold text-gray-600 text-center py-1.5 w-full bg-white rounded shadow-md">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 h-screen pt-14">
            <div class="col-span-2 bg-sky-600 text-white  pt-4">
                <div class="relative h-10 hover:bg-sky-700 cursor-pointer ">
                    <a href="{{route('home')}}" class="@if(Route::currentRouteName() == 'home') bg-sky-700 @endif h-full absolute top-0 w-full left-0 right-0 px-4 flex items-center">Dashboard</a>
                </div>
                <div class="relative h-10 hover:bg-sky-700 cursor-pointer ">
                    <a href="{{route('order.index')}}" class="@if(Route::currentRouteName() == 'order.index') bg-sky-700 @endif h-full absolute top-0 w-full left-0 right-0 px-4 flex items-center">Order</a>
                </div>
                <div class="relative h-10 hover:bg-sky-700 cursor-pointer ">
                    <a href="{{route('stock.index')}}" class="@if(Route::currentRouteName() == 'stock.index') bg-sky-700 @endif h-full absolute top-0 w-full left-0 right-0 px-4 flex items-center">Stock</a>
                </div>
            </div>
            <main class="px-8 py-4 col-span-10 overflow-y-auto">
                @yield('content')
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
