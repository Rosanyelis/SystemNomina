<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Nuevo cargo') }}</h2></x-slot>
    <x-ui.page-header :title="__('Nuevo cargo')" :description="__('Registra un nuevo puesto de trabajo.')" />
    <x-ui.card>
        <form method="POST" action="{{ route('cargos.store') }}" class="space-y-6">
            @csrf
            <x-ui.form-field>
                <x-ui.label for="nombre">{{ __('Nombre') }}</x-ui.label>
                <x-ui.input id="nombre" name="nombre" type="text" :value="old('nombre')" required autofocus />
                <x-input-error :messages="$errors->get('nombre')" />
            </x-ui.form-field>
            <x-ui.form-field>
                <x-ui.label for="descripcion">{{ __('Descripción') }}</x-ui.label>
                <textarea id="descripcion" name="descripcion" rows="3" class="block w-full rounded-md border border-border bg-surface text-ink shadow-ocmb-sm transition-colors duration-ocmb placeholder:text-ink-secondary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-surface dark:text-dark-ink dark:placeholder:text-dark-ink/50 h-10 min-h-11 px-3 py-2 text-sm md:min-h-10">{{ old('descripcion') }}</textarea>
                <x-input-error :messages="$errors->get('descripcion')" />
            </x-ui.form-field>
            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('cargos.index')" variant="ghost">{{ __('Cancelar') }}</x-ui.button>
                <x-ui.button type="submit" variant="primary">{{ __('Guardar') }}</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
