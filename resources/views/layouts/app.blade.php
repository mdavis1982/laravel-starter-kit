@props([
    'htmlClasses' => null,
    'bodyClasses' => null,
])
<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $htmlClasses }}">
    <head>
        <meta charset="utf-8">

        @head
        @fonts

        {{-- Stylesheets --}}
        @vite('resources/css/app.css')
        @livewireStyles
        @stack('stylesheets')
    </head>

    <body class="{{ $bodyClasses }}">
        {{ $slot }}

        {{-- Javascript --}}
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('javascript')

        {{-- Debug --}}
        <x-debug.tailwind-breakpoint-tool/>
    </body>
</html>
