<!DOCTYPE html>
<html lang="id" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-seo :title="$seoTitle ?? 'Panel Admin'"
            :description="$seoDescription ?? null"
            :noindex="true" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <div class="flex min-h-screen flex-col" x-data="{ navOpen: false }">
        <header class="bg-brand-navy text-white shadow-md sticky top-0 z-50">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <img src="{{ \App\Support\Site::logo() }}" alt="Logo {{ \App\Support\Site::name() }}"
                         width="36" height="36" class="h-9 w-9">
                    <div>
                        <p class="text-sm font-bold leading-tight sm:text-base">{{ \App\Support\Site::shortName() }}</p>
                        <p class="text-[11px] text-blue-200">Panel Admin</p>
                    </div>
                </div>

                <button type="button" class="rounded-md p-2 hover:bg-white/10 lg:hidden" aria-label="Buka menu"
                        @click="navOpen = !navOpen" :aria-expanded="navOpen">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <nav class="hidden items-center gap-1 lg:flex" aria-label="Navigasi admin">
                    <x-admin.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-admin.nav-link>
                    <x-admin.nav-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.*')">Berita</x-admin.nav-link>
                    <x-admin.nav-link :href="route('admin.achievements.index')" :active="request()->routeIs('admin.achievements.*')">Prestasi</x-admin.nav-link>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener"
                       class="ml-2 rounded-lg px-3 py-1.5 text-sm text-blue-100 transition hover:bg-white/10 hover:text-white">
                        Lihat Situs &nearr;
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit"
                                class="rounded-lg bg-white/10 px-3 py-1.5 text-sm text-white transition hover:bg-white/20">
                            Keluar
                        </button>
                    </form>
                </nav>
            </div>

            <nav class="border-t border-white/10 px-4 pb-3 lg:hidden" x-show="navOpen" x-cloak>
                <div class="flex flex-col gap-1 pt-2">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 text-sm hover:bg-white/10">Dashboard</a>
                    <a href="{{ route('admin.articles.index') }}" class="rounded-lg px-3 py-2 text-sm hover:bg-white/10">Berita</a>
                    <a href="{{ route('admin.achievements.index') }}" class="rounded-lg px-3 py-2 text-sm hover:bg-white/10">Prestasi</a>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="rounded-lg px-3 py-2 text-sm hover:bg-white/10">Lihat Situs &nearr;</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm hover:bg-white/10">Keluar</button>
                    </form>
                </div>
            </nav>
        </header>

        @if (session('status'))
            <div class="mx-auto w-full max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="status">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <main class="mx-auto w-full max-w-7xl flex-grow px-4 py-8 sm:px-6 lg:px-8">
            @yield('content')
        </main>

        <footer class="border-t border-gray-200 bg-white py-4">
            <p class="text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} {{ \App\Support\Site::name() }} &mdash; Panel Admin
            </p>
        </footer>
    </div>
</body>
</html>
