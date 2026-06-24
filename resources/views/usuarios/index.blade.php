<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Usuarios') }}</h2>
    </x-slot>

    <x-ui.page-header
        :title="__('Usuarios de plataforma')"
        :description="__('Gestión de operadores de la plataforma y asignación de roles.')"
    />

    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        @can('usuarios.crear')
            <x-ui.button :href="route('usuarios.create')" variant="primary">
                {{ __('Nuevo usuario') }}
            </x-ui.button>
        @endcan
    </div>

    @if (session('success'))
        <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert>
    @endif

    <x-ui.card>
        @if ($usuarios->count() > 0)
            <x-ui.table :caption="__('Listado de usuarios')">
                <x-slot name="head">
                    <tr>
                        <x-ui.table.header-cell>{{ __('Nombre') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Email') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Rol') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Estado') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell>
                    </tr>
                </x-slot>

                @foreach ($usuarios as $usuario)
                    <x-ui.table.row>
                        <x-ui.table.cell class="font-medium">{{ $usuario->name }}</x-ui.table.cell>
                        <x-ui.table.cell class="font-data tabular-nums">{{ $usuario->email }}</x-ui.table.cell>
                        <x-ui.table.cell>
                            @foreach ($usuario->roles as $role)
                                <x-ui.badge variant="accent">{{ $role->name }}</x-ui.badge>
                            @endforeach
                        </x-ui.table.cell>
                        <x-ui.table.cell>
                            <x-ui.badge :variant="$usuario->activo ? 'success' : 'danger'">
                                {{ $usuario->activo ? __('Activo') : __('Inactivo') }}
                            </x-ui.badge>
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            <div class="flex items-center justify-end gap-2">
                                @can('usuarios.editar')
                                    <x-ui.button :href="route('usuarios.edit', $usuario)" variant="ghost" size="sm">
                                        {{ __('Editar') }}
                                    </x-ui.button>
                                @endcan
                            </div>
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>

            <x-slot name="footer">
                {{ $usuarios->links() }}
            </x-slot>
        @else
            <x-ui.empty-state
                :title="__('No hay usuarios registrados')"
                :description="__('Crea el primer usuario operador de la plataforma.')"
            />
        @endif
    </x-ui.card>
</x-app-layout>
