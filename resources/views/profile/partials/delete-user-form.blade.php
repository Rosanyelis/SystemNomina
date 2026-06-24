@php
    $isSuperAdmin = Auth::user()->hasRole('Super Admin');
@endphp

<x-ui.card>
    <x-slot name="header">
        <h3 class="font-medium text-ink dark:text-dark-ink">{{ __('Delete Account') }}</h3>
        <p class="mt-1 text-caption text-ink-secondary dark:text-dark-ink/70">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
    </x-slot>

    @if ($isSuperAdmin)
        <div class="rounded-md bg-amber-50 p-4 dark:bg-amber-900/20">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-amber-800 dark:text-amber-200">{{ __('No puedes eliminar tu cuenta') }}</p>
                    <p class="mt-1 text-sm text-amber-700 dark:text-amber-300">{{ __('Eres el único usuario Super Admin. Para eliminar tu cuenta, primero debes asignar el rol Super Admin a otro usuario.') }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-end">
            <x-ui.button
                variant="danger"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            >{{ __('Delete Account') }}</x-ui.button>
        </div>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4 p-6">
            @csrf
            @method('delete')

            <div class="space-y-1.5">
                <h2 class="text-lg font-medium text-ink dark:text-dark-ink">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="text-sm text-ink-secondary dark:text-dark-ink/70">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <x-ui.form-field>
                <x-ui.label for="password" class="sr-only">{{ __('Password') }}</x-ui.label>
                <x-ui.input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </x-ui.form-field>

            <div class="flex justify-end gap-3 pt-1">
                <x-ui.button type="button" variant="ghost" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-ui.button>

                <x-ui.button type="submit" variant="danger">
                    {{ __('Delete Account') }}
                </x-ui.button>
            </div>
        </form>
    </x-modal>
    @endif
</x-ui.card>
