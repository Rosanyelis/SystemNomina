<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('layouts.partials.theme-script')
        @include('layouts.partials.fonts')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased dark:text-dark-ink">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-background dark:bg-dark-background">
            <div
                x-show="sidebarOpen"
                x-transition:enter="transition-opacity duration-ocmb ease-in-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-ocmb ease-in-out"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false"
                class="fixed inset-0 z-30 bg-primary/60 lg:hidden"
                style="display: none;"
                aria-hidden="true"
            ></div>

            @include('layouts.partials.sidebar')

            <div class="lg:ps-64">
                @include('layouts.partials.topbar')

                @isset($header)
                    <div class="border-b border-border/60 bg-surface dark:border-white/10 dark:bg-dark-surface">
                        <div class="mx-auto max-w-container px-4 py-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <main class="mx-auto max-w-container px-4 py-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
