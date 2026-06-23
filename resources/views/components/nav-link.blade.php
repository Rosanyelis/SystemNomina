@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center border-b-2 border-accent px-1 pt-1 text-sm font-medium leading-5 text-primary focus:outline-none focus:border-accent dark:text-dark-ink'
        : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-ink-secondary transition-colors duration-ocmb hover:border-border hover:text-ink focus:outline-none focus:border-border focus:text-ink dark:text-dark-ink/70 dark:hover:text-dark-ink';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
