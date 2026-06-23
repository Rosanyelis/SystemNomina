<x-guest-layout>
    <x-ui.auth-header
        :title="__('Forgot password')"
        :subtitle="__('No problem. Enter your email and we will send you a reset link.')"
    />

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <x-ui.form-field>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </x-ui.form-field>

        <div class="flex justify-end pt-1">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
