@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center font-medium transition-colors duration-ocmb ease-in-out focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-dark-surface disabled:cursor-not-allowed disabled:opacity-50';

    $variants = [
        'primary' => 'border border-transparent bg-primary text-white hover:bg-primary-hover',
        'secondary' => 'border border-primary bg-transparent text-primary hover:bg-background dark:hover:bg-dark-background',
        'accent' => 'border border-transparent bg-accent text-white hover:opacity-90',
        'danger' => 'border border-transparent bg-danger text-white hover:opacity-90',
        'ghost' => 'border border-transparent bg-transparent text-ink-secondary hover:text-ink dark:text-dark-ink/70 dark:hover:text-dark-ink',
    ];

    $sizes = [
        'md' => 'min-h-11 rounded-md px-4 text-sm',
        'sm' => 'min-h-9 rounded-md px-3 text-small',
    ];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $base.' '.$variants[$variant].' '.$sizes[$size]]) }}>
    {{ $slot }}
</button>
