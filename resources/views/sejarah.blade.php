@extends('layouts.app')

@php
    $seoTitle = 'Sejarah Sekolah';
    $seoDescription = 'Sejarah berdirinya dan perkembangan '.\App\Support\Site::name().' sejak tahun 1968 hingga kini.';
@endphp

@section('content')
    <div class="min-h-screen bg-white">
        <main class="py-10 lg:py-16 px-8 sm:px-14">
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-10">
                <div class="w-full lg:w-2/5 flex flex-col items-end">
                    <h1 class="flex flex-col text-[2.5rem] lg:text-[4rem] font-tt-norms font-medium text-right leading-tight" data-reveal="right">
                        <span>Perjalanan</span>
                        <span>Panjang</span>
                        <span>SMKN 1 Bantul</span>
                    </h1>
                    <div class="w-7/10 mt-8 rounded-2xl overflow-hidden shadow-[4px_4px_27px_rgba(0,0,0,0.25)]" data-reveal="zoom" data-reveal-delay="150">
                        <img class="w-full aspect-square object-cover h-auto" src="{{ \App\Support\Site::heroImage() }}" alt="Gedung sekolah" loading="lazy">
                    </div>
                </div>

                <div class="w-full lg:w-1/2 space-y-8" data-reveal="left">
                    <x-breadcrumbs :breadcrumbs="[['label' => 'Sejarah']]" />

                    <div class="space-y-6 text-gray-700 leading-relaxed font-tt-norms">
                        @forelse ($paragraphs as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @empty
                            <p>Sejarah sekolah belum diisi. Silakan tambahkan melalui panel admin.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
