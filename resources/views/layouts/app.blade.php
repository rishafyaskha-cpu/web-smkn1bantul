<!DOCTYPE html>
<html lang="id" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-seo :title="$seoTitle ?? null"
            :description="$seoDescription ?? null"
            :image="$seoImage ?? null"
            :keywords="$seoKeywords ?? null"
            :type="$seoType ?? 'website'"
            :canonical="$seoCanonical ?? null"
            :published-at="$seoPublishedAt ?? null"
            :modified-at="$seoModifiedAt ?? null"
            :author="$seoAuthor ?? null"
            :section="$seoSection ?? null"
            :tags="$seoTags ?? null"
            :noindex="$seoNoindex ?? false"
            :json-ld="$seoJsonLd ?? []" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.documentElement.classList.add('reveal-ready');

        window.setTimeout(function () {
            if (! document.documentElement.dataset.revealInitialized) {
                document.documentElement.classList.remove('reveal-ready');
            }
        }, 4000);
    </script>
</head>
<body class="flex min-h-screen flex-col bg-white text-slate-800 antialiased">
    <a href="#konten-utama" class="sr-only focus:not-sr-only focus:absolute focus:z-100 focus:m-3 focus:rounded-lg focus:bg-brand-navy focus:px-4 focus:py-2 focus:text-sm focus:font-medium focus:text-white">
        Lewati ke konten utama
    </a>

    <x-navbar />

    <main id="konten-utama" class="flex-1">
        @yield('content')
    </main>

    <x-footer />

    <x-chatbot />

    <button
        type="button"
        x-data="{ visible: false }"
        x-cloak
        @scroll.window.throttle.150ms="visible = window.scrollY > 600"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        x-show="visible"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-24 right-4 z-40 flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-brand-navy shadow-card transition-colors hover:bg-brand-navy hover:text-white print:hidden"
        aria-label="Kembali ke atas"
    >
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    @stack('scripts')
</body>
</html>
