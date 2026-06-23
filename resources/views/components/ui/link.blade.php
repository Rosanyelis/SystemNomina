<a {{ $attributes->merge([
    'class' => 'text-sm text-ink-secondary underline-offset-2 transition-colors duration-ocmb hover:text-ink hover:underline focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 rounded-md dark:text-dark-ink/70 dark:hover:text-dark-ink',
]) }}>
    {{ $slot }}
</a>
