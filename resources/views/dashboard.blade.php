<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- TEMPORAL: Grids de información comentadas --}}
    {{--
    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        ...
    </div>

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
        ...
    </div>
    --}}

    <div class="flex flex-col items-center justify-center py-16 text-center">
        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-accent/10">
            <svg class="h-8 w-8 text-accent" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>
        <h2 class="text-h3 font-semibold text-ink dark:text-dark-ink">{{ __('¡Bienvenido!') }}</h2>
        <p class="mt-2 max-w-md text-ink-secondary dark:text-dark-ink/70">{{ __('Seleccione un módulo en el menú lateral para comenzar a trabajar.') }}</p>
    </div>
</x-app-layout>
