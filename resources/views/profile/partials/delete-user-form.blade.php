<section class="space-y-4">
    <header class="space-y-1.5">
        <h2 class="text-lg font-medium text-ink dark:text-dark-ink">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-sm text-ink-secondary dark:text-dark-ink/70">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

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
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </x-ui.form-field>

            <div class="flex justify-end gap-3 pt-1">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
