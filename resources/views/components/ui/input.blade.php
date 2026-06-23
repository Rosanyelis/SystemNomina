@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'block w-full min-h-11 rounded-md border border-border bg-surface px-4 text-sm text-ink shadow-ocmb-sm transition-colors duration-ocmb ease-in-out placeholder:text-ink-secondary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink dark:placeholder:text-dark-ink/50',
    ]) }}
>
