<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading text-h5 text-ink dark:text-dark-ink">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <x-ui.card>
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-ui.card>

        <x-ui.card>
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-ui.card>

        <x-ui.card>
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
