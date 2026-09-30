<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-seo :title="$seoTitle ?? 'Panel Admin'"
            :description="$seoDescription ?? null"
            :noindex="true" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-slate-800 antialiased">
    <div class="flex min-h-screen flex-col" x-data="{ navOpen: false }">
        <header class="sticky top-0 z-50 border-b border-slate-800/60 bg-slate-950 text-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('admin.dashboard') }}" class="flex min-w-0 items-center gap-3">
                    <img src="{{ \App\Support\Site::logo() }}" alt="" width="36" height="36" class="h-9 w-9 object-contain">
                    <span class="min-w-0 leading-tight">
                        <span class="block truncate font-display text-sm font-bold sm:text-base">{{ \App\Support\Site::shortName() }}</span>
                        <span class="block text-[11px] font-medium uppercase tracking-wide text-slate-400">Panel Admin</span>
                    </span>
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank" rel="noopener"
                       class="hidden rounded-lg px-3 py-1.5 text-sm text-slate-300 transition-colors hover:bg-white/10 hover:text-white sm:inline-flex sm:items-center sm:gap-1.5">
                        Lihat Situs
                        <span aria-hidden="true">&nearr;</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="rounded-lg bg-white/10 px-3 py-1.5 text-sm font-medium text-white transition-colors hover:bg-white/20">
                            Keluar
                        </button>
                    </form>

                    <button type="button" class="rounded-lg p-2 text-slate-300 transition-colors hover:bg-white/10 hover:text-white lg:hidden"
                            aria-label="Buka menu" @click="navOpen = !navOpen" :aria-expanded="navOpen">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <nav class="border-t border-white/10 px-4 pb-3 lg:hidden" x-show="navOpen" x-cloak aria-label="Navigasi admin">
                <div class="flex flex-col gap-1 pt-3">
                    <x-admin.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-admin.nav-link>
                    <x-admin.nav-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.*')">Berita</x-admin.nav-link>
                    <x-admin.nav-link :href="route('admin.achievements.index')" :active="request()->routeIs('admin.achievements.*')">Prestasi</x-admin.nav-link>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener"
                       class="rounded-lg px-3 py-2 text-sm text-slate-300 transition-colors hover:bg-white/10 hover:text-white">
                        Lihat Situs &nearr;
                    </a>
                </div>
            </nav>
        </header>

        <div class="mx-auto flex w-full max-w-7xl flex-1 gap-8 px-4 py-8 sm:px-6 lg:px-8">
            <aside class="hidden w-56 shrink-0 lg:block">
                <nav class="sticky top-24 space-y-1" aria-label="Navigasi admin">
                    <p class="px-3 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">Menu</p>
                    <x-admin.side-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <x-admin.icon name="dashboard" />
                        Dashboard
                    </x-admin.side-link>
                    <x-admin.side-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.*')">
                        <x-admin.icon name="news" />
                        Berita
                    </x-admin.side-link>
                    <x-admin.side-link :href="route('admin.achievements.index')" :active="request()->routeIs('admin.achievements.*')">
                        <x-admin.icon name="trophy" />
                        Prestasi
                    </x-admin.side-link>
                </nav>
            </aside>

            <main class="min-w-0 flex-1">
                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <footer class="border-t border-slate-200 bg-white py-5">
            <p class="text-center text-xs text-slate-500">
                &copy; {{ date('Y') }} {{ \App\Support\Site::name() }} &mdash; Panel Admin
            </p>
        </footer>
    </div>
</body>
</html>
