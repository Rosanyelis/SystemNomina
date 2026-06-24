<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Cargos') }}</h2></x-slot>
    <x-ui.page-header :title="__('Cargos')" :description="__('Puestos de trabajo de la empresa.')" />
    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        @can('cargos.crear')
            <x-ui.button :href="route('cargos.create')" variant="primary">{{ __('Nuevo cargo') }}</x-ui.button>
        @endcan
    </div>
    @if (session('success')) <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert> @endif
    <x-ui.card>
        @if ($cargos->count() > 0)
            <x-ui.table :caption="__('Listado de cargos')">
                <x-slot name="head"><tr><x-ui.table.header-cell>{{ __('Nombre') }}</x-ui.table.header-cell><x-ui.table.header-cell>{{ __('Descripción') }}</x-ui.table.header-cell><x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell></tr></x-slot>
                @foreach ($cargos as $cargo)
                    <x-ui.table.row>
                        <x-ui.table.cell>{{ $cargo->nombre }}</x-ui.table.cell>
                        <x-ui.table.cell class="max-w-xs truncate">{{ $cargo->descripcion ?? '—' }}</x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            <div class="flex items-center justify-end gap-2">
                                @can('cargos.editar')<x-ui.button :href="route('cargos.edit', $cargo)" variant="ghost" size="sm">{{ __('Editar') }}</x-ui.button>@endcan
                            </div>
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
            <x-slot name="footer">{{ $cargos->links() }}</x-slot>
        @else
            <x-ui.empty-state :title="__('No hay cargos')" :description="__('Crea el primer cargo para asignar a los empleados.')" />
        @endif
    </x-ui.card>
</x-app-layout>
