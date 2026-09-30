@extends('layouts.app')

@php
    $seoTitle = 'Teaching Factory';
    $seoDescription = 'Kemitraan Teaching Factory '.\App\Support\Site::name().' bersama industri untuk memberi pengalaman kerja nyata bagi siswa.';
@endphp

@section('content')
    <x-page-title text="Teaching Factory"
                  :description="'Kemitraan '.\App\Support\Site::name().' dengan industri untuk memberi pengalaman kerja nyata bagi siswa.'" />

    <div class="container-page py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Teaching Factory']]" />

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($partners as $partner)
                <article class="group flex flex-col items-center rounded-2xl bg-white p-6 text-center shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover sm:p-7"
                         data-reveal="up" data-reveal-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="flex h-24 w-full items-center justify-center">
                        @if ($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->partner_name ?: $partner->title }}" loading="lazy"
                                 class="max-h-20 max-w-[10rem] object-contain">
                        @endif
                    </div>

                    <h2 class="mt-5 font-display text-base font-bold leading-snug text-slate-900 sm:text-lg">
                        <a href="{{ $partner->programKeahlian ? route('program-keahlian.show', $partner->programKeahlian) : '#' }}"
                           class="transition-colors hover:text-brand-navy">{{ $partner->title }}</a>
                    </h2>

                    <p class="mt-1.5 text-sm text-slate-500">
                        {{ $partner->partner_name ?: 'Bekerjasama Dengan' }}
                    </p>
                </article>
            @empty
                <p class="col-span-full py-20 text-center text-slate-500">Belum ada data mitra Teaching Factory.</p>
            @endforelse
        </div>
    </div>
@endsection
