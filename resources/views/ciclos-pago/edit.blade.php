<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Editar ciclo de pago') }}</h2></x-slot>
    <x-ui.page-header :title="__('Editar ciclo de pago')" :description="__('Actualiza la frecuencia de pago.')" />
    <x-ui.card>
        <form method="POST" action="{{ route('ciclos-pago.update', $cicloPago) }}" class="space-y-6">
            @csrf @method('PATCH')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="nombre">{{ __('Nombre') }}</x-ui.label>
                    <x-ui.input id="nombre" name="nombre" type="text" :value="old('nombre', $cicloPago->nombre)" required />
                    <x-input-error :messages="$errors->get('nombre')" />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label for="dias">{{ __('Días') }}</x-ui.label>
                    <x-ui.input id="dias" name="dias" type="number" :value="old('dias', $cicloPago->dias)" required min="1" max="90" />
                    <x-input-error :messages="$errors->get('dias')" />
                </x-ui.form-field>
            </div>
            <x-ui.form-field>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="activo" value="1" {{ old('activo', $cicloPago->activo) ? 'checked' : '' }} class="rounded border-border bg-surface text-accent focus:ring-accent dark:border-white/10 dark:bg-dark-surface" />
                    <span class="text-sm text-ink dark:text-dark-ink">{{ __('Activo') }}</span>
                </label>
            </x-ui.form-field>
            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('ciclos-pago.index')" variant="ghost">{{ __('Cancelar') }}</x-ui.button>
                <x-ui.button type="submit" variant="primary">{{ __('Actualizar') }}</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
