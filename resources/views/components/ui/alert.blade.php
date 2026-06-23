@props(['variant' => 'info'])

@php
    $variants = [
        'success' => 'border-success/20 bg-success/10 text-success',
        'warning' => 'border-warning/20 bg-warning/10 text-warning',
        'danger' => 'border-danger/20 bg-danger/10 text-danger',
        'info' => 'border-info/20 bg-info/10 text-info',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-md border px-4 py-3 text-sm '.$variants[$variant]]) }} role="alert">
    {{ $slot }}
</div>
