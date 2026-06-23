@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full border-s-4 border-accent bg-accent/10 py-2 ps-3 pe-4 text-start text-base font-medium text-primary focus:outline-none dark:text-dark-ink'
        : 'block w-full border-s-4 border-transparent py-2 ps-3 pe-4 text-start text-base font-medium text-ink-secondary transition-colors duration-ocmb hover:border-border hover:bg-background hover:text-ink focus:outline-none focus:border-border focus:bg-background focus:text-ink dark:text-dark-ink/70 dark:hover:bg-dark-background dark:hover:text-dark-ink';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
