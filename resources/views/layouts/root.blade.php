<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@yield('html-classes')">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Title and Description --}}
        <title>
            @hasSection('title')
                @yield('title') - {{ config('app.name') }}
            @else
                {{ config('meta.default.title') }}
            @endif
        </title>

        <meta name="description" content="@yield('description', config('meta.default.description'))"/>

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

        {{-- Open Graph Meta Tags --}}
        <meta property="og:title" content="@yield('og:title', config('meta.default.opengraph.title'))">
        <meta property="og:description" content="@yield('og:description', config('meta.default.opengraph.description'))">
        <meta property="og:type" content="@yield('og:type', config('meta.default.opengraph.type'))">
        <meta property="og:url" content="@yield('og:url', url()->current())">
        <meta property="og:image" content="@yield('og:image', config('meta.default.opengraph.image'))">
        <meta property="og:image:alt" content="@yield('og:image:alt', config('meta.default.opengraph.image-alt'))">
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

        {{-- Favicons --}}
        <link rel="icon" href="/favicon.ico" sizes="any"/>
        <link rel="icon" href="/icon.svg" type="image/svg+xml"/>
        <link rel="apple-touch-icon" href="/icon.png"/>
    </head>

    <body class="@yield('body-classes')">
        @yield('body')

        @livewireScripts
        @stack('javascript')
    </body>
</html>
