<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Empresas') }}</h2>
            @can('empresas.crear')
                <x-ui.button :href="route('empresas.create')" variant="primary">
                    {{ __('Nueva empresa') }}
                </x-ui.button>
            @endcan
        </div>
    </x-slot>

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
                                    <x-ui.button :href="route('empresas.edit', $empresa)" variant="ghost" size="sm" title="{{ __('Editar registro') }}">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    </x-ui.button>
                                @endcan

                                @can('empresas.desactivar')
                                    <form method="POST" action="{{ route('empresas.toggle-activo', $empresa) }}" class="inline">
                                        @csrf
                                        <x-ui.button type="submit" variant="ghost" size="sm" title="{{ $empresa->activo ? __('Desactivar registro') : __('Activar registro') }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" /></svg>
                                        </x-ui.button>
                                    </form>
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
