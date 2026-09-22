<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@yield('html-classes')">
    <head>
        <meta charset="utf-8">

        {{-- Head--}}
        @head

        {{-- Custom Font --}}
        {{-- https://csswizardry.com/2020/05/the-fastest-google-fonts/ --}}
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,100..900;1,9..40,100..900&display=swap"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,100..900;1,9..40,100..900&display=swap" media="print" onload="this.media='all'"/>
        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,100..900;1,9..40,100..900&display=swap"/>
        </noscript>

        {{-- Stylesheets & Javascript --}}
        @if (app()->hasDebugModeEnabled())
            <x-debug.tailwind-breakpoint-tool/>
        @endif
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @stack('stylesheets')
    </head>

    <body class="@yield('body-classes')">
        @yield('body')

        @livewireScripts
        @stack('javascript')
    </body>
</html>
