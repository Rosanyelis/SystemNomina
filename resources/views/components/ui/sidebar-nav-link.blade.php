@props(['active' => false, 'icon' => null, 'collapsed' => false])

@php
    if ($collapsed) {
        $classes = $active
            ? 'flex items-center justify-center rounded-md bg-accent/20 px-0 py-2 text-sm font-medium text-white'
            : 'flex items-center justify-center rounded-md px-0 py-2 text-sm font-medium text-white/70 transition-colors duration-ocmb hover:bg-white/5 hover:text-white';
    } else {
        $classes = $active
            ? 'flex items-center gap-2.5 rounded-md bg-accent/20 px-3 py-2 text-sm font-medium text-white'
            : 'flex items-center gap-2.5 rounded-md px-3 py-2 text-sm font-medium text-white/70 transition-colors duration-ocmb hover:bg-white/5 hover:text-white';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        <span class="shrink-0">{!! $icon !!}</span>
    @endif
    @if (! $collapsed)
        <span>{{ $slot }}</span>
    @endif
</a>
