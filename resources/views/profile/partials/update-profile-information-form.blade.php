<section>
    <header class="space-y-1.5">
        <h2 class="text-lg font-medium text-ink dark:text-dark-ink">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-sm text-ink-secondary dark:text-dark-ink/70">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('patch')

        <x-ui.form-field>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </x-ui.form-field>

        <x-ui.form-field>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required autocomplete="username" />
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

        <div class="flex items-center gap-3 pt-1">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
