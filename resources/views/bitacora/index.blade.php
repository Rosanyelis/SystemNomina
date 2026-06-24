<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Bitácora') }}</h2>
    </x-slot>

    <x-ui.page-header
        :title="__('Bitácora')"
        :description="__('Registro de acciones críticas del sistema.')"
    />

    <x-ui.card>
        <form method="GET" action="{{ route('bitacora.index') }}" class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-ui.form-field>
                <x-ui.label for="accion">{{ __('Acción') }}</x-ui.label>
                <x-ui.input id="accion" name="accion" type="text" :value="request('accion')" placeholder="Buscar..." />
            </x-ui.form-field>

            <x-ui.form-field>
                <x-ui.label for="desde">{{ __('Desde') }}</x-ui.label>
                <x-ui.input id="desde" name="desde" type="date" :value="request('desde')" />
            </x-ui.form-field>

            <x-ui.form-field>
                <x-ui.label for="hasta">{{ __('Hasta') }}</x-ui.label>
                <x-ui.input id="hasta" name="hasta" type="date" :value="request('hasta')" />
            </x-ui.form-field>

            <div class="flex items-end gap-2">
                <x-ui.button type="submit" variant="primary" size="sm">{{ __('Filtrar') }}</x-ui.button>
                <x-ui.button :href="route('bitacora.index')" variant="ghost" size="sm">{{ __('Limpiar') }}</x-ui.button>
            </div>
        </form>

        @if ($registros->count() > 0)
            <x-ui.table :caption="__('Registros de bitácora')">
                <x-slot name="head">
                    <tr>
                        <x-ui.table.header-cell>{{ __('Fecha') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Usuario') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Empresa') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Acción') }}</x-ui.table.header-cell>
                    </tr>
                </x-slot>

                @foreach ($registros as $registro)
                    <x-ui.table.row>
                        <x-ui.table.cell class="font-data tabular-nums whitespace-nowrap">{{ $registro->created_at->format('d/m/Y H:i') }}</x-ui.table.cell>
                        <x-ui.table.cell>{{ $registro->usuario?->name ?? '—' }}</x-ui.table.cell>
                        <x-ui.table.cell>{{ $registro->empresa?->razon_social ?? '—' }}</x-ui.table.cell>
                        <x-ui.table.cell class="max-w-xs truncate">{{ $registro->accion }}</x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>

            <x-slot name="footer">
                {{ $registros->links() }}
            </x-slot>
        @else
            <x-ui.empty-state
                :title="__('Sin registros')"
                :description="__('No hay registros de bitácora para los filtros seleccionados.')"
            />
        @endif
    </x-ui.card>
</x-app-layout>
