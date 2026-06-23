<x-guest-layout>
    <x-ui.auth-header
        :title="__('Confirm password')"
        :subtitle="__('This is a secure area. Please confirm your password before continuing.')"
    />

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <x-ui.form-field>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </x-ui.form-field>

        <div class="flex justify-end pt-1">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
