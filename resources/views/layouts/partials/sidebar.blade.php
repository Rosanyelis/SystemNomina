@php
    $dashboardIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>';

    $profileIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>';

    $reportsIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>';
@endphp

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 start-0 z-40 flex w-64 flex-col bg-primary transition-transform duration-ocmb ease-in-out lg:translate-x-0"
>
    <div class="flex h-16 shrink-0 items-center justify-center border-b border-white/10 px-6">
        <a href="{{ route('dashboard') }}" class="inline-flex rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">
            <x-application-logo variant="full" />
        </a>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6" aria-label="{{ __('Main navigation') }}">

        <x-ui.sidebar-nav-link
            :href="route('dashboard')"
            :active="request()->routeIs('dashboard')"
            :icon="$dashboardIcon"
        >
            {{ __('Dashboard') }}
        </x-ui.sidebar-nav-link>

        <x-ui.sidebar-nav-link
            :href="route('profile.edit')"
            :active="request()->routeIs('profile.*')"
            :icon="$profileIcon"
        >
            {{ __('Profile') }}
        </x-ui.sidebar-nav-link>

        <p class="mb-3 mt-6 px-3 text-caption font-medium uppercase tracking-wider text-white/40">
            {{ __('Reports') }}
        </p>

        <x-ui.sidebar-nav-link
            :href="route('reports.payroll-summary')"
            :active="request()->routeIs('reports.*')"
            :icon="$reportsIcon"
        >
            {{ __('Payroll summary') }}
        </x-ui.sidebar-nav-link>
    </nav>

    <div class="border-t border-white/10 px-6 py-4">
        <p class="text-caption text-white/40">
            {{ config('app.name') }}
        </p>
        <p class="mt-1 text-caption text-white/30">
            v1.0
        </p>
    </div>
</aside>
