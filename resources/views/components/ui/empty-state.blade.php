@props(['title', 'description' => null, 'action' => null])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-lg border border-dashed border-border/80 bg-background px-6 py-10 text-center dark:border-white/10 dark:bg-dark-background']) }}>
    @isset($icon)
        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-surface text-ink-secondary shadow-ocmb-sm dark:bg-dark-surface dark:text-dark-ink/60">
            {{ $icon }}
        </div>
    @endisset

    <h3 class="font-medium text-ink dark:text-dark-ink">
        {{ $title }}
    </h3>

    @if ($description)
        <p class="mt-1.5 max-w-sm text-sm text-ink-secondary dark:text-dark-ink/70">
            {{ $description }}
        </p>
    @endif

    @if ($action)
        <div class="mt-4">
            {{ $action }}
        </div>
    @endif
</div>
