@extends('layouts.app')

@php
    $seoTitle = 'Sejarah Sekolah';
    $seoDescription = 'Sejarah berdirinya dan perkembangan '.\App\Support\Site::name().' sejak tahun 1968 hingga kini.';
@endphp

@section('content')
    <div class="bg-white">
        <div class="container-page py-10 lg:py-14">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Sejarah']]" />

            <div class="mt-10 grid gap-10 lg:grid-cols-12 lg:gap-14">
                <div class="lg:col-span-5" data-reveal="right">
                    <p class="eyebrow">Profil Sekolah</p>
                    <h1 class="mt-3 font-display text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:text-4xl lg:text-[2.75rem]">
                        Perjalanan Panjang {{ \App\Support\Site::shortName() }}
                    </h1>

                    <div class="mt-8 overflow-hidden rounded-2xl shadow-card ring-1 ring-slate-900/5">
                        <img src="{{ \App\Support\Site::heroImage() }}" alt="Gedung {{ \App\Support\Site::name() }}"
                             class="aspect-[4/3] w-full object-cover" loading="lazy">
                    </div>
                </div>

                <div class="lg:col-span-7" data-reveal="left" data-reveal-delay="100">
                    <div class="space-y-5 leading-relaxed text-slate-700">
                        @forelse ($paragraphs as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @empty
                            <p>Sejarah sekolah belum diisi. Silakan tambahkan melalui panel admin.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
