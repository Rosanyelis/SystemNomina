<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Editar rol') }}</h2>
    </x-slot>

    <x-ui.card>
        <form method="POST" action="{{ route('roles.update', $role) }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-ui.form-field>
                <x-ui.label for="name">{{ __('Nombre del rol') }}</x-ui.label>
                <x-ui.input id="name" name="name" type="text" :value="old('name', $role->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </x-ui.form-field>

            @if ($role->name === 'Super Admin')
                <x-ui.alert variant="warning">
                    {{ __('El rol Super Admin tiene todos los permisos automáticamente.') }}
                </x-ui.alert>
            @else
                <div>
                    <x-ui.label class="mb-3">{{ __('Permisos') }}</x-ui.label>

                    @php
                        $rolePerms = $role->permissions->pluck('name')->toArray();
                    @endphp

                    @foreach ($grouped as $resource => $perms)
                        <div class="mb-4 rounded-lg border border-border/60 bg-background p-4 dark:border-white/10 dark:bg-dark-background">
                            <p class="mb-2 text-sm font-medium uppercase tracking-wide text-ink-secondary dark:text-dark-ink/70">
                                {{ __(ucfirst($resource)) }}
                            </p>

                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                                @foreach ($perms as $permission)
                                    @php
                                        $action = explode('.', $permission->name)[1];
                                    @endphp
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <x-ui.checkbox
                                            name="permissions[]"
                                            value="{{ $permission->name }}"
                                            :checked="in_array($permission->name, old('permissions', $rolePerms))"
                                        />
                                        <span class="text-sm text-ink dark:text-dark-ink">{{ __(ucfirst($action)) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <x-input-error :messages="$errors->get('permissions')" />
                </div>
            @endif

            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('roles.index')" variant="ghost">
                    {{ __('Cancelar') }}
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    {{ __('Actualizar') }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
