@props(['active' => false, 'icon' => null])

@php
    $classes = $active
        ? 'flex items-center gap-2.5 rounded-md border-l-4 border-accent bg-white/10 px-3 py-2 text-sm font-medium text-white'
        : 'flex items-center gap-2.5 rounded-md border-l-4 border-transparent px-3 py-2 text-sm font-medium text-white/70 transition-colors duration-ocmb hover:bg-white/5 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        <span class="shrink-0">{!! $icon !!}</span>
    @endif
    <span>{{ $slot }}</span>
</a>
