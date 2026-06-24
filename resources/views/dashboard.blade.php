<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($kpis as $index => $kpi)
            <x-ui.kpi-card
                :label="$kpi['label']"
                :value="$kpi['value']"
                :hint="$kpi['hint'] ?? null"
                :highlight="$kpi['highlight'] ?? false"
            >
                @if ($index === 0)
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </x-slot>
                @elseif ($index === 1)
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </x-slot>
                @elseif ($index === 2)
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </x-slot>
                @else
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </x-slot>
                @endif
            </x-ui.kpi-card>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
        <x-ui.card class="xl:col-span-2">
            <x-slot name="header">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="font-medium text-ink dark:text-dark-ink">
                            {{ __('Recent payroll runs') }}
                        </h3>
                        <p class="mt-1 text-caption text-ink-secondary dark:text-dark-ink/60">
                            {{ __('Latest closed or in-progress payroll periods') }}
                        </p>
                    </div>
                </div>
            </x-slot>

            @if (count($recentPayrolls) > 0)
                <x-ui.table :caption="__('Recent payroll runs')">
                    <x-slot name="head">
                        <tr>
                            <x-ui.table.header-cell>{{ __('Period') }}</x-ui.table.header-cell>
                            <x-ui.table.header-cell>{{ __('Company') }}</x-ui.table.header-cell>
                            <x-ui.table.header-cell class="text-end">{{ __('Employees') }}</x-ui.table.header-cell>
                            <x-ui.table.header-cell class="text-end">{{ __('Net total') }}</x-ui.table.header-cell>
                            <x-ui.table.header-cell>{{ __('Status') }}</x-ui.table.header-cell>
                        </tr>
                    </x-slot>

                    @foreach ($recentPayrolls as $payroll)
                        <x-ui.table.row>
                            <x-ui.table.cell>{{ $payroll['period'] }}</x-ui.table.cell>
                            <x-ui.table.cell>{{ $payroll['company'] }}</x-ui.table.cell>
                            <x-ui.table.cell class="text-end font-data tabular-nums">{{ $payroll['employees'] }}</x-ui.table.cell>
                            <x-ui.table.cell class="text-end font-data tabular-nums">{{ $payroll['net_total'] }}</x-ui.table.cell>
                            <x-ui.table.cell>
                                <x-ui.badge :variant="$payroll['status_variant']">{{ $payroll['status'] }}</x-ui.badge>
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @endforeach
                </x-ui.table>
            @else
                <x-ui.empty-state
                    :title="__('No payroll runs yet')"
                    :description="__('When you process payroll for a client company, the latest runs will appear here with totals and status.')"
                >
                    <x-slot name="icon">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </x-slot>
                </x-ui.empty-state>
            @endif
        </x-ui.card>

        <x-ui.card>
            <x-slot name="header">
                <h3 class="font-medium text-ink dark:text-dark-ink">
                    {{ __('Quick summary') }}
                </h3>
                <p class="mt-1 text-caption text-ink-secondary dark:text-dark-ink/60">
                    {{ __('Legal contributions snapshot') }}
                </p>
            </x-slot>

            <dl class="space-y-4">
                @foreach ([
                    ['label' => __('IVSS employer'), 'value' => '—'],
                    ['label' => __('FAOV'), 'value' => '—'],
                    ['label' => __('INCES'), 'value' => '—'],
                    ['label' => __('Income tax'), 'value' => '—'],
                ] as $item)
                    <div class="flex items-center justify-between gap-4 border-b border-border/40 pb-3 last:border-0 last:pb-0 dark:border-white/10">
                        <dt class="text-sm text-ink-secondary dark:text-dark-ink/70">{{ $item['label'] }}</dt>
                        <dd class="font-data text-sm tabular-nums text-ink dark:text-dark-ink">{{ $item['value'] }}</dd>
                    </div>
                @endforeach
            </dl>

            <x-slot name="footer">
                <p class="text-caption text-ink-secondary dark:text-dark-ink/60">
                    {{ __('Amounts will populate once a payroll period is calculated.') }}
                </p>
            </x-slot>
        </x-ui.card>
    </div>
</x-app-layout>
