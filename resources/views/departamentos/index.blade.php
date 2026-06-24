<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Departamentos') }}</h2></x-slot>
    <x-ui.page-header :title="__('Departamentos')" :description="__('Unidades organizativas de la empresa.')" />
    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        @can('departamentos.crear')
            <x-ui.button :href="route('departamentos.create')" variant="primary">{{ __('Nuevo departamento') }}</x-ui.button>
        @endcan
    </div>
    @if (session('success')) <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert> @endif
    <x-ui.card>
        @if ($departamentos->count() > 0)
            <x-ui.table :caption="__('Listado de departamentos')">
                <x-slot name="head"><tr><x-ui.table.header-cell>{{ __('Nombre') }}</x-ui.table.header-cell><x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell></tr></x-slot>
                @foreach ($departamentos as $departamento)
                    <x-ui.table.row>
                        <x-ui.table.cell>{{ $departamento->nombre }}</x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            <div class="flex items-center justify-end gap-2">
                                @can('departamentos.editar')<x-ui.button :href="route('departamentos.edit', $departamento)" variant="ghost" size="sm">{{ __('Editar') }}</x-ui.button>@endcan
                            </div>
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
            <x-slot name="footer">{{ $departamentos->links() }}</x-slot>
        @else
            <x-ui.empty-state :title="__('No hay departamentos')" :description="__('Crea el primer departamento para organizar a los empleados.')" />
        @endif
    </x-ui.card>
</x-app-layout>
