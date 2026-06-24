@php
    $empresaActual = session('empresa_id') ? \App\Models\Empresa::withoutGlobalScopes()->find(session('empresa_id')) : null;
    $mostrarSelector = auth()->user()->puedeOperarEnContextoTenant();
    $empresasDisponibles = $mostrarSelector
        ? \App\Models\Empresa::withoutGlobalScopes()->where('activo', true)->orderBy('razon_social')->get()
        : collect();
@endphp

<header class="sticky top-0 z-30 flex h-16 shrink-0 items-center gap-4 border-b border-border/60 bg-surface px-4 shadow-ocmb-sm dark:border-white/10 dark:bg-dark-surface sm:px-6">
    <button
        type="button"
        @click="sidebarOpen = ! sidebarOpen"
        class="inline-flex items-center justify-center rounded-md p-2 text-ink-secondary transition-colors duration-ocmb hover:bg-background hover:text-ink focus:outline-none focus:ring-2 focus:ring-accent lg:hidden dark:text-dark-ink/70 dark:hover:bg-dark-background dark:hover:text-dark-ink"
        aria-label="{{ __('Toggle navigation') }}"
    >
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <div class="flex min-w-0 flex-1 items-center gap-4">
        @isset($breadcrumb)
            <nav class="hidden text-sm text-ink-secondary sm:block dark:text-dark-ink/70" aria-label="Breadcrumb">
                {{ $breadcrumb }}
            </nav>
        @else
            <span class="hidden text-sm text-ink-secondary sm:block dark:text-dark-ink/70">
                {{ __('Platform') }}
            </span>
        @endisset

        @if ($mostrarSelector)
            <form method="POST" action="{{ route('seleccionar-empresa') }}" class="flex">
                @csrf
                <select name="empresa_id" onchange="this.form.submit()"
                    class="rounded-md border border-border/60 bg-background px-3 py-1.5 text-caption text-ink-secondary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-background dark:text-dark-ink/70"
                >
                    <option value="">— {{ __('Sin empresa') }} —</option>
                    @foreach ($empresasDisponibles as $emp)
                        <option value="{{ $emp->id }}" {{ session('empresa_id') == $emp->id ? 'selected' : '' }}>
                            {{ $emp->razon_social }}
                        </option>
                    @endforeach
                </select>
            </form>
        @endif
    </div>

    <div class="flex items-center gap-3">
        <x-ui.theme-toggle />

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center gap-2 rounded-md border border-border/60 bg-background px-3 py-2 text-[12px] font-medium text-ink transition-colors duration-ocmb hover:bg-surface focus:outline-none focus:ring-2 focus:ring-accent dark:border-white/10 dark:bg-dark-background dark:text-dark-ink">
                    <span class="hidden max-w-[10rem] truncate sm:inline">{{ Auth::user()->name }}</span>
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-primary text-caption font-semibold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <svg class="h-4 w-4 text-ink-secondary dark:text-dark-ink/70" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="border-b border-border/60 px-4 py-3 dark:border-white/10">
                    <p class="truncate text-[12px] font-medium text-ink dark:text-dark-ink">{{ Auth::user()->name }}</p>
                    <p class="truncate text-caption text-ink-secondary dark:text-dark-ink/70">{{ Auth::user()->email }}</p>
                </div>

                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
