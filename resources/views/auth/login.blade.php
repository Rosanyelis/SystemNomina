<x-guest-layout>
    <x-ui.auth-header :title="__('Log in')" class="font-bold text-h5 text-primary dark:text-dark-ink" />

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <x-ui.form-field>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </x-ui.form-field>

        <x-ui.form-field>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </x-ui.form-field>

        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <x-ui.checkbox id="remember_me" name="remember" />
                <span class="text-sm text-ink-secondary dark:text-dark-ink/70">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <x-ui.link href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </x-ui.link>
            @endif
        </div>

        <div class="flex justify-end pt-1">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
