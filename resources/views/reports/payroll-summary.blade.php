<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading text-h5 text-ink dark:text-dark-ink">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <x-ui.report-layout
        :title="__('Payroll summary')"
        :period="$periodLabel"
        :company="$companyName ?? __('No company selected')"
    >
        <x-slot name="actions">
            <x-ui.button variant="secondary" size="sm" type="button" disabled>
                {{ __('Export Excel') }}
            </x-ui.button>
        </x-slot>

        @if (count($rows) > 0)
            <x-ui.table :caption="__('Payroll summary')">
                <x-slot name="head">
                    <tr>
                        <x-ui.table.header-cell>{{ __('Employee') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Position') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Gross') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Deductions') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Net pay') }}</x-ui.table.header-cell>
                    </tr>
                </x-slot>

                @foreach ($rows as $row)
                    <x-ui.table.row>
                        <x-ui.table.cell>{{ $row['employee'] }}</x-ui.table.cell>
                        <x-ui.table.cell>{{ $row['position'] }}</x-ui.table.cell>
                        <x-ui.table.cell class="text-end font-data tabular-nums">{{ $row['gross'] }}</x-ui.table.cell>
                        <x-ui.table.cell class="text-end font-data tabular-nums">{{ $row['deductions'] }}</x-ui.table.cell>
                        <x-ui.table.cell class="text-end font-data tabular-nums font-medium">{{ $row['net'] }}</x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach

                <x-slot name="foot">
                    <tr>
                        <x-ui.table.footer-cell colspan="2">{{ __('Totals') }}</x-ui.table.footer-cell>
                        <x-ui.table.footer-cell class="text-end font-data tabular-nums">{{ $totals['gross'] }}</x-ui.table.footer-cell>
                        <x-ui.table.footer-cell class="text-end font-data tabular-nums">{{ $totals['deductions'] }}</x-ui.table.footer-cell>
                        <x-ui.table.footer-cell class="text-end font-data tabular-nums font-semibold text-accent">{{ $totals['net'] }}</x-ui.table.footer-cell>
                    </tr>
                </x-slot>
            </x-ui.table>
        @else
            <x-ui.card flat>
                <x-ui.empty-state
                    :title="__('No payroll data for this period')"
                    :description="__('Select a client company and process a payroll run to generate this report.')"
                >
                    <x-slot name="icon">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </x-slot>
                </x-ui.empty-state>
            </x-ui.card>
        @endif

        <p class="text-caption text-ink-secondary dark:text-dark-ink/60">
            {{ __('Amounts displayed in bolívares (Bs.) with tabular numerals for financial readability.') }}
        </p>
    </x-ui.report-layout>
</x-app-layout>
