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
        <div class="relative flex min-h-screen">
            <div class="absolute end-4 top-4 z-50 sm:end-6 sm:top-6">
                <x-ui.theme-toggle />
            </div>

            <div class="relative hidden w-5/12 flex-col justify-between overflow-hidden bg-primary p-12 lg:flex">
                <div class="absolute inset-0 opacity-10" aria-hidden="true">
                    <div class="absolute -end-24 -top-24 h-96 w-96 rounded-full border border-white/20"></div>
                    <div class="absolute -bottom-32 -start-16 h-80 w-80 rounded-full border border-accent/30"></div>
                </div>

                <div class="relative">
                    <x-application-logo variant="full" inverse class="text-white" />
                </div>

                <div class="relative space-y-6">
                    <blockquote class="font-heading text-h4 leading-snug text-white">
                        {{ __('Financial precision backed by professional trust.') }}
                    </blockquote>
                    <p class="max-w-sm text-sm leading-relaxed text-white/60">
                        {{ __('Venezuelan payroll management platform aligned with LOTTT regulations. Centralized operation for HR and accounting teams.') }}
                    </p>
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-accent"></span>
                        <span class="text-caption uppercase tracking-widest text-accent">OCMB</span>
                    </div>
                </div>

                <p class="relative text-caption text-white/30">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                </p>
            </div>

            <div class="flex flex-1 flex-col items-center justify-center bg-background px-4 py-16 dark:bg-dark-background sm:px-6">
                <div class="mb-8 lg:hidden">
                    <a href="/" class="rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-dark-background">
                        <x-application-logo variant="full" class="text-primary dark:text-dark-ink" />
                    </a>
                </div>

                <x-ui.card class="w-full sm:max-w-md">
                    {{ $slot }}
                </x-ui.card>
            </div>
        </div>
    </body>
</html>
