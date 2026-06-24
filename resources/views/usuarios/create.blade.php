<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Nuevo usuario') }}</h2>
    </x-slot>

    <x-ui.page-header
        :title="__('Nuevo usuario')"
        :description="__('Registra un nuevo operador de plataforma con rol asignado.')"
    />

    <x-ui.card>
        <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="name">{{ __('Nombre') }}</x-ui.label>
                    <x-ui.input id="name" name="name" type="text" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                </x-ui.form-field>

                <x-ui.form-field>
                    <x-ui.label for="email">{{ __('Email') }}</x-ui.label>
                    <x-ui.input id="email" name="email" type="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" />
                </x-ui.form-field>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="role">{{ __('Rol') }}</x-ui.label>
                    <select id="role" name="role" required class="block w-full rounded-md border border-border bg-surface text-ink shadow-ocmb-sm transition-colors duration-ocmb focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink h-10 min-h-11 px-3 py-2 text-sm md:min-h-10">
                        <option value="">{{ __('Seleccionar...') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" />
                </x-ui.form-field>

                <x-ui.form-field>
                    <x-ui.label for="activo">{{ __('Estado') }}</x-ui.label>
                    <select id="activo" name="activo" class="block w-full rounded-md border border-border bg-surface text-ink shadow-ocmb-sm transition-colors duration-ocmb focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink h-10 min-h-11 px-3 py-2 text-sm md:min-h-10">
                        <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>{{ __('Activo') }}</option>
                        <option value="0" {{ old('activo') === '0' ? 'selected' : '' }}>{{ __('Inactivo') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('activo')" />
                </x-ui.form-field>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="password">{{ __('Contraseña') }}</x-ui.label>
                    <x-ui.input id="password" name="password" type="password" required />
                    <x-input-error :messages="$errors->get('password')" />
                </x-ui.form-field>

                <x-ui.form-field>
                    <x-ui.label for="password_confirmation">{{ __('Confirmar contraseña') }}</x-ui.label>
                    <x-ui.input id="password_confirmation" name="password_confirmation" type="password" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </x-ui.form-field>
            </div>

            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('usuarios.index')" variant="ghost">
                    {{ __('Cancelar') }}
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    {{ __('Guardar') }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
