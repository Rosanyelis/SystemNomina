<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Nuevo departamento') }}</h2></x-slot>
    <x-ui.page-header :title="__('Nuevo departamento')" :description="__('Registra un nuevo departamento.')" />
    <x-ui.card>
        <form method="POST" action="{{ route('departamentos.store') }}" class="space-y-6">
            @csrf
            <x-ui.form-field>
                <x-ui.label for="nombre">{{ __('Nombre') }}</x-ui.label>
                <x-ui.input id="nombre" name="nombre" type="text" :value="old('nombre')" required autofocus />
                <x-input-error :messages="$errors->get('nombre')" />
            </x-ui.form-field>
            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('departamentos.index')" variant="ghost">{{ __('Cancelar') }}</x-ui.button>
                <x-ui.button type="submit" variant="primary">{{ __('Guardar') }}</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
