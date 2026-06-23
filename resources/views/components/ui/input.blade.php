@props(['disabled' => false, 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'h-9 min-h-11 px-2.5 py-1.5 text-sm md:min-h-9',
        'md' => 'h-10 min-h-11 px-3 py-2 text-sm md:min-h-10',
        'lg' => 'h-11 min-h-11 px-4 py-2 text-sm',
    ];
@endphp

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'block w-full rounded-md border border-border bg-surface text-ink shadow-ocmb-sm transition-colors duration-ocmb ease-in-out placeholder:text-ink-secondary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink dark:placeholder:text-dark-ink/50 '.$sizes[$size],
    ]) }}
>
