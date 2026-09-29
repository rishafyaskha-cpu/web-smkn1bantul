@extends('layouts.blank')

@php
    $seoTitle = 'Halaman Tidak Ditemukan (404)';
    $seoDescription = 'Halaman yang Anda cari tidak dapat ditemukan.';
@endphp

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 relative overflow-hidden flex-grow">
        <div class="absolute top-6 left-6 flex items-center gap-3 z-10">
            <img src="{{ \App\Support\Site::logo() }}" alt="Logo {{ \App\Support\Site::name() }}" width="40" height="40" class="w-10 h-10">
            <h3 class="text-sm sm:text-xl font-bold text-brand-navy">{{ \App\Support\Site::shortName() }}</h3>
        </div>

        <div class="flex flex-col items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-8xl sm:text-9xl md:text-[12rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-brand-navy to-brand-teal">
                    404
                </h1>
            </div>

            <div class="text-center max-w-2xl mb-10">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 font-metropolis">
                    Halaman Tidak Ditemukan
                </h2>
                <p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                    Maaf, halaman yang Anda cari tidak dapat ditemukan.
                    Silakan kembali ke beranda untuk melanjutkan.
                </p>
            </div>

            <a href="{{ route('home') }}"
               class="px-10 py-4 bg-brand-navy text-white rounded-xl font-semibold hover:bg-brand-teal transition-colors duration-300 shadow-lg text-center">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
                </span>
            </a>

            <p class="text-sm text-gray-500 mt-12">{{ \App\Support\Site::get('school.tagline_short', 'Mencetak Generasi Unggul dan Kompeten') }}</p>
        </div>
    </div>
@endsection
