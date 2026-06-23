@props(['title', 'description' => null])

<div {{ $attributes->merge(['class' => 'mb-8']) }}>
    @isset($breadcrumb)
        <nav class="mb-2 text-caption text-ink-secondary dark:text-dark-ink/60" aria-label="Breadcrumb">
            {{ $breadcrumb }}
        </nav>
    @endisset

    <h1 class="font-heading text-h5 text-ink dark:text-dark-ink">
        {{ $title }}
    </h1>

    @if ($description)
        <p class="mt-1 text-sm text-ink-secondary dark:text-dark-ink/70">
            {{ $description }}
        </p>
    @endif
</div>
