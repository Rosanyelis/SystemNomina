<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Editar empresa') }}</h2>
    </x-slot>

    <x-ui.page-header
        :title="__('Editar empresa')"
        :description="__('Actualiza los datos de la empresa cliente.')"
    />

    <x-ui.card>
        <form method="POST" action="{{ route('empresas.update', $empresa) }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-ui.form-field>
                <x-ui.label for="razon_social">{{ __('Razón Social') }}</x-ui.label>
                <x-ui.input id="razon_social" name="razon_social" type="text" :value="old('razon_social', $empresa->razon_social)" required />
                <x-input-error :messages="$errors->get('razon_social')" />
            </x-ui.form-field>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="rif">{{ __('RIF') }}</x-ui.label>
                    <x-ui.input id="rif" name="rif" type="text" :value="old('rif', $empresa->rif)" required />
                    <x-input-error :messages="$errors->get('rif')" />
                </x-ui.form-field>

                <x-ui.form-field>
                    <x-ui.label for="email">{{ __('Email') }}</x-ui.label>
                    <x-ui.input id="email" name="email" type="email" :value="old('email', $empresa->email)" />
                    <x-input-error :messages="$errors->get('email')" />
                </x-ui.form-field>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="telefono">{{ __('Teléfono') }}</x-ui.label>
                    <x-ui.input id="telefono" name="telefono" type="text" :value="old('telefono', $empresa->telefono)" />
                    <x-input-error :messages="$errors->get('telefono')" />
                </x-ui.form-field>

                <x-ui.form-field>
                    <x-ui.label for="activo">{{ __('Estado') }}</x-ui.label>
                    <select id="activo" name="activo" class="block w-full rounded-md border border-border bg-surface text-ink shadow-ocmb-sm transition-colors duration-ocmb focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink h-10 min-h-11 px-3 py-2 text-sm md:min-h-10">
                        <option value="1" {{ old('activo', $empresa->activo ? '1' : '0') === '1' ? 'selected' : '' }}>{{ __('Activa') }}</option>
                        <option value="0" {{ old('activo', $empresa->activo ? '1' : '0') === '0' ? 'selected' : '' }}>{{ __('Inactiva') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('activo')" />
                </x-ui.form-field>
            </div>

            <x-ui.form-field>
                <x-ui.label for="direccion">{{ __('Dirección') }}</x-ui.label>
                <textarea id="direccion" name="direccion" rows="3" class="block w-full rounded-md border border-border bg-surface text-ink shadow-ocmb-sm transition-colors duration-ocmb placeholder:text-ink-secondary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink dark:placeholder:text-dark-ink/50 h-10 min-h-11 px-3 py-2 text-sm md:min-h-10">{{ old('direccion', $empresa->direccion) }}</textarea>
                <x-input-error :messages="$errors->get('direccion')" />
            </x-ui.form-field>

            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('empresas.index')" variant="ghost">
                    {{ __('Cancelar') }}
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    {{ __('Actualizar') }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
