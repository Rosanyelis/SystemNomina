<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Parámetros Legales') }}</h2></x-slot>
    <x-ui.page-header :title="__('Parámetros Legales')" :description="__('Configuración de tasas y valores legales LOTTT con vigencia.')" />
    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        @can('parametros-legales.crear')
            <x-ui.button :href="route('parametros-legales.create')" variant="primary">{{ __('Nuevos parámetros') }}</x-ui.button>
        @endcan
    </div>
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
                            @can('parametros-legales.editar')<x-ui.button :href="route('parametros-legales.edit', $parametro)" variant="ghost" size="sm">{{ __('Editar') }}</x-ui.button>@endcan
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
