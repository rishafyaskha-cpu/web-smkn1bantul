@extends('layouts.blank')

@php
    $seoTitle = 'Halaman Tidak Ditemukan (404)';
    $seoDescription = 'Halaman yang Anda cari tidak dapat ditemukan.';
@endphp

@section('content')
    <div class="relative flex flex-1 flex-col overflow-hidden bg-surface">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(50%_50%_at_50%_0%,rgba(11,76,240,0.10),transparent_65%)]" aria-hidden="true"></div>

        <header class="container-page relative py-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <img src="{{ \App\Support\Site::logo() }}" alt="" width="40" height="40" class="h-10 w-10 object-contain">
                <span class="font-display text-base font-bold text-slate-900">{{ \App\Support\Site::shortName() }}</span>
            </a>
        </header>

        <div class="container-page relative flex flex-1 flex-col items-center justify-center py-16 text-center">
            <p class="font-display text-7xl font-bold tracking-tight text-brand-navy sm:text-8xl">404</p>

            <h1 class="mt-6 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Halaman Tidak Ditemukan
            </h1>

            <p class="mt-3 max-w-md leading-relaxed text-slate-600">
                Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <x-button :href="route('home')" size="lg">
                    Kembali ke Beranda
                </x-button>
                <x-button :href="route('berita.index')" variant="outline" size="lg">
                    Lihat Berita
                </x-button>
            </div>

            <p class="mt-12 text-sm text-slate-500">{{ \App\Support\Site::get('school.tagline_short', 'Mencetak Generasi Unggul dan Kompeten') }}</p>
        </div>
    </div>
@endsection
