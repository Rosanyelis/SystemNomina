<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Roles') }}</h2>
    </x-slot>

    <x-ui.page-header
        :title="__('Roles')"
        :description="__('Gestión de roles y permisos del sistema.')"
    />

    <div class="mb-4 flex items-center justify-between gap-4">
        <div></div>
        <x-ui.button :href="route('roles.create')" variant="primary">
            {{ __('Nuevo rol') }}
        </x-ui.button>
    </div>

    @if (session('success'))
        <x-ui.alert variant="success" class="mb-4">{{ session('success') }}</x-ui.alert>
    @endif

    @if (session('error'))
        <x-ui.alert variant="danger" class="mb-4">{{ session('error') }}</x-ui.alert>
    @endif

    <x-ui.card>
        @if ($roles->count() > 0)
            <x-ui.table :caption="__('Listado de roles')">
                <x-slot name="head">
                    <tr>
                        <x-ui.table.header-cell>{{ __('Rol') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell>{{ __('Permisos') }}</x-ui.table.header-cell>
                        <x-ui.table.header-cell class="text-end">{{ __('Acciones') }}</x-ui.table.header-cell>
                    </tr>
                </x-slot>

                @foreach ($roles as $role)
                    <x-ui.table.row>
                        <x-ui.table.cell class="font-medium">{{ $role->name }}</x-ui.table.cell>
                        <x-ui.table.cell>
                            <x-ui.badge variant="info">
                                {{ trans_choice(':count permiso|:count permisos', $role->permissions_count) }}
                            </x-ui.badge>
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-end">
                            <div class="flex items-center justify-end gap-2">
                                <x-ui.button :href="route('roles.edit', $role)" variant="ghost" size="sm">
                                    {{ __('Editar') }}
                                </x-ui.button>

                                @if ($role->name !== 'Super Admin')
                                    <form method="POST" action="{{ route('roles.destroy', $role) }}" class="inline" onsubmit="return confirm('¿Está seguro de eliminar el rol «{{ $role->name }}»?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="danger" size="sm">
                                            {{ __('Eliminar') }}
                                        </x-ui.button>
                                    </form>
                                @endif
                            </div>
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
        @else
            <x-ui.empty-state
                :title="__('No hay roles registrados')"
                :description="__('Crea el primer rol para comenzar a gestionar permisos.')"
            />
        @endif
    </x-ui.card>
</x-app-layout>
