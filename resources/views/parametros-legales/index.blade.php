<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Parámetros Legales') }}</h2>
            @can('parametros-legales.crear')
                <x-ui.button :href="route('parametros-legales.create')" variant="primary">{{ __('Nuevos parámetros') }}</x-ui.button>
            @endcan
        </div>
    </x-slot>
    @if (session('success')) <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert> @endif
    <x-ui.card>
        @if ($parametros->count() > 0)
            <x-ui.table :caption="__('Listado de parámetros legales')">
                <x-slot name="head">
                    <tr>
                        <x-ui.table.header-cell>{{ __('Salario Mínimo') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('IVSS') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('FAOV') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('RPE') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Vigencia') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell>
                    </tr>
                </x-slot>
                @foreach ($parametros as $parametro)
                    <x-ui.table.row>
                        <x-ui.table.cell class="font-data tabular-nums">Bs. {{ number_format($parametro->salario_minimo, 2) }}</x-ui.table.cell>
                        <x-ui.table.cell class="font-data tabular-nums">{{ $parametro->porcentaje_ivss }}%</x-ui.table.cell>
                        <x-ui.table.cell class="font-data tabular-nums">{{ $parametro->porcentaje_faov }}%</x-ui.table.cell>
                        <x-ui.table.cell class="font-data tabular-nums">{{ $parametro->porcentaje_rpe }}%</x-ui.table.cell>
                        <x-ui.table.cell class="font-data tabular-nums whitespace-nowrap">
                            {{ $parametro->vigencia_desde->format('d/m/Y') }}
                            @if ($parametro->vigencia_hasta)
                                → {{ $parametro->vigencia_hasta->format('d/m/Y') }}
                            @else
                                <x-ui.badge variant="success" class="ml-1">{{ __('Vigente') }}</x-ui.badge>
                            @endif
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            @can('parametros-legales.editar')<x-ui.button :href="route('parametros-legales.edit', $parametro)" variant="ghost" size="sm" title="{{ __('Editar registro') }}"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></x-ui.button>@endcan
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
            <x-slot name="footer">{{ $parametros->links() }}</x-slot>
        @else
            <x-ui.empty-state :title="__('No hay parámetros legales')" :description="__('Configura los parámetros legales para la empresa.')" />
        @endif
    </x-ui.card>
</x-app-layout>
