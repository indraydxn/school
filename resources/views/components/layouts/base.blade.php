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
    <body x-data x-bind="$store.global.documentBody" class="is-header-blur">

        {{-- Preloader --}}
        <x-preloader/>

        {{-- Page Wrapper --}}
        <div id="root" class="flex min-h-100vh grow bg-gray-100 dark:bg-gray-900" x-cloak>
            {{ $slot }}
        </div>

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
