<x-guest-layout>
    <x-ui.auth-header :title="__('Log in')" />

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <x-ui.checkbox id="remember_me" name="remember" />
                <span class="ms-2 text-sm text-ink-secondary dark:text-dark-ink/70">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <x-ui.link href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </x-ui.link>
            @endif
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
