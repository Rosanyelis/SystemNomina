<x-ui.card>
    <x-slot name="header">
        <h3 class="font-medium text-ink dark:text-dark-ink">{{ __('Profile Information') }}</h3>
        <p class="mt-1 text-caption text-ink-secondary dark:text-dark-ink/70">{{ __("Update your account's profile information and email address.") }}</p>
    </x-slot>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <x-ui.form-field>
                <x-ui.label for="name">{{ __('Name') }}</x-ui.label>
                <x-ui.input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </x-ui.form-field>

            <x-ui.form-field>
                <x-ui.label for="email">{{ __('Email') }}</x-ui.label>
                <x-ui.input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="space-y-2 pt-1">
                        <p class="text-sm text-ink dark:text-dark-ink">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="rounded-md text-sm text-ink-secondary underline underline-offset-2 transition-colors duration-ocmb hover:text-ink focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:text-dark-ink/70 dark:hover:text-dark-ink">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <x-ui.alert variant="success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </x-ui.alert>
                        @endif
                    </div>
                @endif
            </x-ui.form-field>
        </div>

        <div class="flex items-center justify-end gap-4">
            @if (session('status') === 'profile-updated')
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
