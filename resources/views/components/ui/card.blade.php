@props(['flat' => false])

<div {{ $attributes->merge([
    'class' => 'rounded-lg bg-surface p-6 dark:bg-dark-surface '.($flat ? 'border border-border' : 'shadow-ocmb-md'),
]) }}>
    @isset($header)
        <div class="mb-3 border-b border-border/60 pb-3">
            {{ $header }}
        </div>
    @endisset

    {{ $slot }}

    @isset($footer)
        <div class="mt-3 border-t border-border/60 pt-3">
            {{ $footer }}
        </div>
    @endisset
</div>
