@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-ink dark:text-dark-ink']) }}>
    {{ $value ?? $slot }}
</label>
