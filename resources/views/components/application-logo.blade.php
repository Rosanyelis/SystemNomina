@props(['variant' => 'full', 'inverse' => false])

@php
    $isFull = $variant === 'full';
    $markBg = $inverse ? 'text-white/10' : 'text-primary dark:text-dark-surface';
    $linePrimary = $inverse ? 'text-white/90' : 'text-white/90';
    $lineSecondary = $inverse ? 'text-white/60' : 'text-white/70';
    $lineTertiary = $inverse ? 'text-white/40' : 'text-white/50';
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 shrink-0" aria-hidden="true">
        <rect width="40" height="40" rx="8" class="fill-current {{ $markBg }}" />
        @if ($inverse)
            <rect width="40" height="40" rx="8" fill="none" class="stroke-current text-white/20" stroke-width="1" />
        @endif
        <rect x="8" y="10" width="24" height="3" rx="1.5" class="fill-current text-accent" />
        <rect x="8" y="17" width="18" height="2" rx="1" class="fill-current {{ $linePrimary }}" />
        <rect x="8" y="22" width="22" height="2" rx="1" class="fill-current {{ $lineSecondary }}" />
        <rect x="8" y="27" width="14" height="2" rx="1" class="fill-current {{ $lineTertiary }}" />
    </svg>

    @if ($isFull)
        <div class="leading-tight">
            <span class="block font-heading text-base font-semibold tracking-wide text-current">
                System<span class="text-accent">Nomina</span>
            </span>
            <span class="block text-caption opacity-60">
                OCMB
            </span>
        </div>
    @endif
</div>
