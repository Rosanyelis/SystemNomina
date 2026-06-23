@props(['title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'mb-4 text-center']) }}>
    <h1 class="font-heading text-h4 text-primary dark:text-dark-ink">
        {{ $title }}
    </h1>

    @if ($subtitle)
        <p class="mt-1.5 text-sm text-ink-secondary dark:text-dark-ink/70">
            {{ $subtitle }}
        </p>
    @endif
</div>
