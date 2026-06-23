<x-guest-layout>
    <x-ui.auth-header
        :title="__('Verify email')"
        :subtitle="__('Thanks for signing up! Please verify your email by clicking the link we sent. If you did not receive it, we can send another.')"
    />

    @if (session('status') == 'verification-link-sent')
        <x-ui.alert variant="success" class="mb-4">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </x-ui.alert>
    @endif

    <div class="flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-ui.button type="submit" variant="ghost" size="sm" class="underline">
                {{ __('Log Out') }}
            </x-ui.button>
        </form>
    </div>
</x-guest-layout>
