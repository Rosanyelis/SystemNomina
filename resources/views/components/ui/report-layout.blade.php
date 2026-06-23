@props(['title', 'period' => null, 'company' => null])

<div {{ $attributes->merge(['class' => 'space-y-6']) }}>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="font-heading text-h4 text-ink dark:text-dark-ink">
                {{ $title }}
            </h1>

            @if ($period || $company)
                <dl class="mt-2 flex flex-wrap gap-x-6 gap-y-1 text-sm text-ink-secondary dark:text-dark-ink/70">
                    @if ($company)
                        <div class="flex gap-2">
                            <dt class="font-medium">{{ __('Company') }}:</dt>
                            <dd>{{ $company }}</dd>
                        </div>
                    @endif
                    @if ($period)
                        <div class="flex gap-2">
                            <dt class="font-medium">{{ __('Period') }}:</dt>
                            <dd>{{ $period }}</dd>
                        </div>
                    @endif
                </dl>
            @endif
        </div>

        @isset($actions)
            <div class="flex shrink-0 items-center gap-3">
                {{ $actions }}
            </div>
        @endisset
    </div>

    {{ $slot }}
</div>
