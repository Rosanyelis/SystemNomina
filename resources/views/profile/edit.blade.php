<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-h5 text-ink dark:text-dark-ink">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-4">
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')

        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
