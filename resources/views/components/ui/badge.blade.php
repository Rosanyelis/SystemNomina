@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'bg-background text-ink-secondary dark:bg-dark-background dark:text-dark-ink/70',
        'accent' => 'bg-accent/10 text-accent',
        'success' => 'bg-success/10 text-success',
        'warning' => 'bg-warning/10 text-warning',
        'danger' => 'bg-danger/10 text-danger',
        'info' => 'bg-info/10 text-info',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-md px-2 py-1 text-caption font-medium '.$variants[$variant]]) }}>
    {{ $slot }}
</span>
