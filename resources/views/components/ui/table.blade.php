@props(['caption' => null])

<div {{ $attributes->merge(['class' => 'overflow-x-auto rounded-lg border border-border/60 shadow-ocmb-sm dark:border-white/10']) }}>
    <table class="w-full min-w-full divide-y divide-border/60 text-left text-sm dark:divide-white/10">
        @if ($caption)
            <caption class="sr-only">{{ $caption }}</caption>
        @endif

        @isset($head)
            <thead class="bg-primary text-white">
                {{ $head }}
            </thead>
        @endisset

        <tbody class="divide-y divide-border/60 bg-surface dark:divide-white/10 dark:bg-dark-surface">
            {{ $slot }}
        </tbody>

        @isset($foot)
            <x-ui.table.footer>
                {{ $foot }}
            </x-ui.table.footer>
        @endisset
    </table>
</div>
