@props([
    'variant' => 'full',
    'size' => 'h-10',
    'format' => 'webp',
])

@php
    $src = match (true) {
        $variant !== 'full' => asset('assets/img/isotipo.webp'),
        $format === 'png' => asset('assets/img/logo.webp'),
        default => asset('assets/img/logo.webp'),
    };
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }}>
    <img
        src="{{ $src }}"
        alt="{{ __('System Nómina') }}"
        @class([
            $size,
            'w-auto max-w-full object-contain object-center',
        ])
        decoding="async"
    />
</div>
