<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Title Page --}}
        <title>{{ $title }} &ndash; {{ config('app.name') }}</title>

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ asset('logos/logo.svg') }}" />

        {{-- Styles --}}
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('icons/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('icons/fontawesome/css/jelly-regular.css') }}">
        @isset($head)
            {{ $head }}
        @endisset
    </head>
    <body x-data x-bind="$store.global.documentBody" class="navigation:sideblock is-sidebar-open">

        {{-- Preloader --}}
        <x-preloader/>

        {{-- Page Wrapper --}}
        <div id="root" class="flex min-h-100vh grow bg-gray-100 dark:bg-gray-900" x-cloak>

            {{-- Sidebar --}}
            <x-backend.sidebar>

                {{-- Dashboard --}}
                <x-backend.sidebar-menu
                    menu="Dashboard"
                    icon="fa-home"
                    :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')"
                />

                {{-- Pengguna --}}
                <x-backend.sidebar-menu
                    menu="Pengguna"
                    icon="fa-users"
                    :href="route('admin.user.index')"
                    :active="request()->routeIs('admin.user.*')"
                />

            </x-backend.sidebar>

            {{-- Navbar --}}
            <x-backend.header/>

            {{-- Content --}}
            <main class="flex flex-col px-3 pb-3 bg-white not-lg:w-full transition-all duration-300 main-content lg:fixed lg:inset-0 dark:bg-gray-900">
                <div class="w-full h-full overflow-hidden flex flex-col bg-gray-100 border border-gray-200 rounded-xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex-1 h-full flex flex-col overflow-y-auto [&::-webkit-scrollbar]:w-0 gap-4 lg:p-6 md:p-5 p-4">
                        {{ $slot }}
                    </div>
                </div>
            </main>

        </div>
        {{-- / Page Wrapper --}}

        {{-- AlpineJS & Scripts --}}
        <div id="x-teleport-target"></div>
        @livewireScriptConfig
        <script>
            window.addEventListener("DOMContentLoaded", () => Livewire.start());
        </script>
        @isset($script)
            {{ $script }}
        @endisset
    </body>
</html>
