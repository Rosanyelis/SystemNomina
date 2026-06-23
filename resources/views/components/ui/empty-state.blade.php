@props(['title', 'description' => null, 'action' => null])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-lg border border-dashed border-border/80 bg-background px-6 py-12 text-center dark:border-white/10 dark:bg-dark-background']) }}>
    @isset($icon)
        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-surface text-ink-secondary shadow-ocmb-sm dark:bg-dark-surface dark:text-dark-ink/60">
            {{ $icon }}
        </div>
    @endisset

    <h3 class="font-medium text-ink dark:text-dark-ink">
        {{ $title }}
    </h3>

    @if ($description)
        <p class="mt-2 max-w-sm text-sm text-ink-secondary dark:text-dark-ink/70">
            {{ $description }}
        </p>
    @endif

    @if ($action)
        <div class="mt-6">
            {{ $action }}
        </div>
    @endif
</div>
