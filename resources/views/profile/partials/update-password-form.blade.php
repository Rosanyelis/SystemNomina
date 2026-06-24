<x-ui.card>
    <x-slot name="header">
        <h3 class="font-medium text-ink dark:text-dark-ink">{{ __('Update Password') }}</h3>
        <p class="mt-1 text-caption text-ink-secondary dark:text-dark-ink/70">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </x-slot>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            
            <x-ui.form-field>
                <x-ui.label for="update_password_current_password">{{ __('Current Password') }}</x-ui.label>
                <x-ui.input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
            </x-ui.form-field>

            
                <x-ui.form-field>
                    <x-ui.label for="update_password_password">{{ __('New Password') }}</x-ui.label>
                    <x-ui.input id="update_password_password" name="password" type="password" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" />
                </x-ui.form-field>

                <x-ui.form-field>
                    <x-ui.label for="update_password_password_confirmation">{{ __('Confirm Password') }}</x-ui.label>
                    <x-ui.input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
                </x-ui.form-field>
            
        </div>

        <div class="flex items-center justify-end gap-4">
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success"
                >{{ __('Saved.') }}</p>
            @endif
            <x-ui.button type="submit" variant="primary">{{ __('Save') }}</x-ui.button>
        </div>
    </form>
</x-ui.card>
