<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Ciclos de Pago') }}</h2></x-slot>
    <x-ui.page-header :title="__('Ciclos de Pago')" :description="__('Frecuencias de pago configuradas para la empresa.')" />
    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        @can('ciclos-pago.crear')
            <x-ui.button :href="route('ciclos-pago.create')" variant="primary">{{ __('Nuevo ciclo') }}</x-ui.button>
        @endcan
    </div>
    @if (session('success')) <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert> @endif
    <x-ui.card>
        @if ($ciclos->count() > 0)
            <x-ui.table :caption="__('Listado de ciclos de pago')">
                <x-slot name="head"><tr><x-ui.table.header-cell>{{ __('Nombre') }}</x-ui.table.header-cell><x-ui.table.header-cell>{{ __('Días') }}</x-ui.table.header-cell><x-ui.table.header-cell>{{ __('Estado') }}</x-ui.table.header-cell><x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell></tr></x-slot>
                @foreach ($ciclos as $ciclo)
                    <x-ui.table.row>
                        <x-ui.table.cell>{{ $ciclo->nombre }}</x-ui.table.cell>
                        <x-ui.table.cell class="font-data tabular-nums">{{ $ciclo->dias }} días</x-ui.table.cell>
                        <x-ui.table.cell><x-ui.badge :variant="$ciclo->activo ? 'success' : 'danger'">{{ $ciclo->activo ? __('Activo') : __('Inactivo') }}</x-ui.badge></x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            @can('ciclos-pago.editar')<x-ui.button :href="route('ciclos-pago.edit', $ciclo)" variant="ghost" size="sm">{{ __('Editar') }}</x-ui.button>@endcan
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
            <x-slot name="footer">{{ $ciclos->links() }}</x-slot>
        @else
            <x-ui.empty-state :title="__('No hay ciclos de pago')" :description="__('Configura al menos un ciclo para poder generar nóminas.')" />
        @endif
    </x-ui.card>
</x-app-layout>
