@extends('layouts.app')

@php
    $seoTitle = 'Teaching Factory';
    $seoDescription = 'Kemitraan Teaching Factory '.\App\Support\Site::name().' bersama industri untuk memberi pengalaman kerja nyata bagi siswa.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-page-title text="Teaching Factory" />

        <main class="py-10 lg:py-16 px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Teaching Factory']]" class="mb-8" />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 max-w-7xl mx-auto">
                @forelse ($partners as $partner)
                    <article class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center" data-reveal="up" data-reveal-delay="{{ ($loop->index % 3) * 100 }}">
                        <h2 class="text-base sm:text-lg lg:text-xl xl:text-2xl font-bold text-gray-900 min-h-[2.5rem] sm:min-h-[3rem] flex items-center justify-center px-2 leading-tight">
                            <a href="{{ $partner->programKeahlian ? route('program-keahlian.show', $partner->programKeahlian) : '#' }}"
                               class="hover:text-brand-navy">{{ $partner->title }}</a>
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-600 font-medium mt-3 sm:mt-4 lg:mt-6">
                            {{ $partner->partner_name ?: 'Bekerjasama Dengan' }}
                        </p>
                        <div class="w-full h-20 sm:h-24 lg:h-32 flex items-center justify-center mt-3 sm:mt-4 lg:mt-6">
                            @if ($partner->logo_url)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->partner_name ?: $partner->title }}" loading="lazy"
                                     class="max-w-full max-h-full object-contain">
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-16">Belum ada data mitra Teaching Factory.</p>
                @endforelse
            </div>
        </main>
    </div>
@endsection
