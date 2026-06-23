@props([
    'label',
    'value',
    'hint' => null,
    'trend' => null,
    'trendDirection' => 'neutral',
    'highlight' => false,
])

@php
    $trendVariants = [
        'up' => 'text-success',
        'down' => 'text-danger',
        'neutral' => 'text-ink-secondary dark:text-dark-ink/70',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg bg-surface p-6 shadow-ocmb-md dark:bg-dark-surface']) }}>
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0 flex-1">
            <p class="text-caption font-medium uppercase tracking-wide text-ink-secondary dark:text-dark-ink/60">
                {{ $label }}
            </p>

            <p @class([
                'mt-2 font-data text-h4 tabular-nums leading-none',
                'text-accent' => $highlight,
                'text-ink dark:text-dark-ink' => ! $highlight,
            ])>
                {{ $value }}
            </p>

            @if ($hint)
                <p class="mt-2 text-caption text-ink-secondary dark:text-dark-ink/60">
                    {{ $hint }}
                </p>
            @endif
        </div>

        @isset($icon)
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-background text-accent dark:bg-dark-background">
                {{ $icon }}
            </div>
        @endisset
    </div>

    @if ($trend)
        <p class="mt-4 text-caption {{ $trendVariants[$trendDirection] ?? $trendVariants['neutral'] }}">
            {{ $trend }}
        </p>
    @endif
</div>
