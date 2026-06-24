<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Empresas') }}</h2>
    </x-slot>

    <x-ui.page-header
        :title="__('Empresas')"
        :description="__('Gestión de empresas clientes de la plataforma.')"
    />

    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        @can('empresas.crear')
            <x-ui.button :href="route('empresas.create')" variant="primary">
                {{ __('Nueva empresa') }}
            </x-ui.button>
        @endcan
    </div>

    @if (session('success'))
        <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert>
    @endif

    <x-ui.card>
        @if ($empresas->count() > 0)
            <x-ui.table :caption="__('Listado de empresas')">
                <x-slot name="head">
                    <tr>
                        <x-ui.table.header-cell>{{ __('RIF') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Razón Social') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Email') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Estado') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell>
                    </tr>
                </x-slot>

                @foreach ($empresas as $empresa)
                    <x-ui.table.row>
                        <x-ui.table.cell class="font-data tabular-nums">{{ $empresa->rif }}</x-ui.table.cell>
                        <x-ui.table.cell>{{ $empresa->razon_social }}</x-ui.table.cell>
                        <x-ui.table.cell>{{ $empresa->email ?? '—' }}</x-ui.table.cell>
                        <x-ui.table.cell>
                            <x-ui.badge :variant="$empresa->activo ? 'success' : 'danger'">
                                {{ $empresa->activo ? __('Activa') : __('Inactiva') }}
                            </x-ui.badge>
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            <div class="flex items-center justify-end gap-2">
                                @can('empresas.editar')
                                    <x-ui.button :href="route('empresas.edit', $empresa)" variant="ghost" size="sm">
                                        {{ __('Editar') }}
                                    </x-ui.button>
                                @endcan
                            </div>
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>

            <x-slot name="footer">
                {{ $empresas->links() }}
            </x-slot>
        @else
            <x-ui.empty-state
                :title="__('No hay empresas registradas')"
                :description="__('Crea la primera empresa cliente para comenzar a operar.')"
            />
        @endif
    </x-ui.card>
</x-app-layout>
