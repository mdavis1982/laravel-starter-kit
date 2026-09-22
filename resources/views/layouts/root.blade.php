@aware([
    'htmlClasses' => null,
    'bodyClasses' => null,
])
<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (filled($htmlClasses))class="{{ $htmlClasses }}"@endif>
    <head>
        <meta charset="utf-8">

        {{-- Head --}}
        @head

        {{-- Custom Font --}}
        @fonts

        {{-- Stylesheets & Javascript --}}
        @if (app()->hasDebugModeEnabled())
            <x-debug.tailwind-breakpoint-tool/>
        @endif
        @vite('resources/css/app.css')
        @livewireStyles

        @stack('stylesheets')
    </head>

    <body @if (filled($bodyClasses))class="{{ $bodyClasses }}"@endif>
        {{ $slot }}

        @livewireScripts

        @vite('resources/js/app.js')
        @stack('javascript')
    </body>
</html>
