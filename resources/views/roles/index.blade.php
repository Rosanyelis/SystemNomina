<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Roles') }}</h2>
            <x-ui.button :href="route('roles.create')" variant="primary">
                {{ __('Nuevo rol') }}
            </x-ui.button>
        </div>
    </x-slot>

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
                                <x-ui.button :href="route('roles.edit', $role)" variant="ghost" size="sm" title="{{ __('Editar registro') }}">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                </x-ui.button>

                                @if ($role->name !== 'Super Admin')
                                    <form method="POST" action="{{ route('roles.destroy', $role) }}" class="inline" onsubmit="return confirm('¿Está seguro de eliminar el rol «{{ $role->name }}»?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="danger" size="sm" title="{{ __('Eliminar registro') }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
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
