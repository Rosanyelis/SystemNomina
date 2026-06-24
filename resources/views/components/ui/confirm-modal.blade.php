@props([
    'title' => __('¿Confirmar acción?'),
    'message' => __('¿Está seguro de realizar esta acción?'),
    'confirmText' => __('Confirmar'),
    'cancelText' => __('Cancelar'),
    'type' => 'warning',
    'action',
    'method' => 'POST',
])

<div x-data="{ show: false }">
    <span @click="show = true" class="inline-flex cursor-pointer">
        {{ $slot }}
    </span>

    <div
        x-show="show"
        class="fixed inset-0 z-50 flex items-center justify-center"
        style="display: none;"
        x-on:keydown.escape.window="show = false"
    >
        <div class="absolute inset-0 bg-black/60" @click="show = false"></div>

        <div
            class="relative w-full max-w-md mx-4 rounded-lg bg-surface p-6 shadow-xl dark:bg-dark-surface"
            @click.away="show = false"
        >
            @php
                $iconClasses = [
                    'warning' => 'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400',
                    'danger' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                ][$type];
            @endphp

            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full {{ $iconClasses }} mb-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-center text-ink dark:text-dark-ink mb-2">{{ $title }}</h3>

            <p class="text-sm text-center text-ink-secondary dark:text-dark-ink/70 mb-6">{{ $message }}</p>

            <div class="flex items-center justify-center gap-3">
                <button type="button" @click="show = false"
                    class="rounded-sm border border-border bg-transparent px-4 py-2 text-sm font-medium text-ink-secondary hover:bg-background dark:border-white/10 dark:text-dark-ink/70 dark:hover:bg-dark-background">
                    {{ $cancelText }}
                </button>

                <form method="POST" action="{{ $action }}" class="inline">
                    @csrf
                    @if ($method !== 'POST')
                        @method($method)
                    @endif

                    @php
                        $confirmBtnClasses = [
                            'warning' => 'bg-amber-600 hover:bg-amber-700',
                            'danger' => 'bg-danger hover:opacity-90',
                        ][$type];
                    @endphp

                    <button type="submit"
                        class="rounded-sm px-4 py-2 text-sm font-medium text-white transition-colors {{ $confirmBtnClasses }}">
                        {{ $confirmText }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
