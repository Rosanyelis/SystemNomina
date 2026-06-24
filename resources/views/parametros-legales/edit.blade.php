<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">{{ __('Editar parámetros legales') }}</h2></x-slot>
    <x-ui.page-header :title="__('Editar parámetros legales')" :description="__('Actualiza las tasas y valores legales.')" />
    <x-ui.card>
        <form method="POST" action="{{ route('parametros-legales.update', $parametroEmpresa) }}" class="space-y-6">
            @csrf @method('PATCH')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="salario_minimo">{{ __('Salario Mínimo (Bs.)') }}</x-ui.label>
                    <x-ui.input id="salario_minimo" name="salario_minimo" type="number" step="0.01" :value="old('salario_minimo', $parametroEmpresa->salario_minimo)" required />
                    <x-input-error :messages="$errors->get('salario_minimo')" />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label for="valor_ut">{{ __('Valor UT (Bs.)') }}</x-ui.label>
                    <x-ui.input id="valor_ut" name="valor_ut" type="number" step="0.01" :value="old('valor_ut', $parametroEmpresa->valor_ut)" required />
                    <x-input-error :messages="$errors->get('valor_ut')" />
                </x-ui.form-field>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <x-ui.form-field>
                    <x-ui.label for="porcentaje_ivss">{{ __('IVSS (%)') }}</x-ui.label>
                    <x-ui.input id="porcentaje_ivss" name="porcentaje_ivss" type="number" step="0.01" :value="old('porcentaje_ivss', $parametroEmpresa->porcentaje_ivss)" required />
                    <x-input-error :messages="$errors->get('porcentaje_ivss')" />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label for="porcentaje_faov">{{ __('FAOV (%)') }}</x-ui.label>
                    <x-ui.input id="porcentaje_faov" name="porcentaje_faov" type="number" step="0.01" :value="old('porcentaje_faov', $parametroEmpresa->porcentaje_faov)" required />
                    <x-input-error :messages="$errors->get('porcentaje_faov')" />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label for="porcentaje_rpe">{{ __('RPE (%)') }}</x-ui.label>
                    <x-ui.input id="porcentaje_rpe" name="porcentaje_rpe" type="number" step="0.01" :value="old('porcentaje_rpe', $parametroEmpresa->porcentaje_rpe)" required />
                    <x-input-error :messages="$errors->get('porcentaje_rpe')" />
                </x-ui.form-field>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-ui.form-field>
                    <x-ui.label for="vigencia_desde">{{ __('Vigencia desde') }}</x-ui.label>
                    <x-ui.input id="vigencia_desde" name="vigencia_desde" type="date" :value="old('vigencia_desde', $parametroEmpresa->vigencia_desde->format('Y-m-d'))" required />
                    <x-input-error :messages="$errors->get('vigencia_desde')" />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label for="vigencia_hasta">{{ __('Vigencia hasta (opcional)') }}</x-ui.label>
                    <x-ui.input id="vigencia_hasta" name="vigencia_hasta" type="date" :value="old('vigencia_hasta', $parametroEmpresa->vigencia_hasta?->format('Y-m-d'))" />
                    <p class="text-caption text-ink-secondary mt-1">{{ __('Dejar vacío si sigue vigente.') }}</p>
                    <x-input-error :messages="$errors->get('vigencia_hasta')" />
                </x-ui.form-field>
            </div>
            <div class="flex items-center justify-end gap-4">
                <x-ui.button :href="route('parametros-legales.index')" variant="ghost">{{ __('Cancelar') }}</x-ui.button>
                <x-ui.button type="submit" variant="primary">{{ __('Actualizar') }}</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-app-layout>
