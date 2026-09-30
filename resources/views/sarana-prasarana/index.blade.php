@extends('layouts.app')

@php
    $seoTitle = 'Sarana & Prasarana';
    $seoDescription = 'Daftar sarana dan prasarana yang tersedia di '.\App\Support\Site::name().', mulai dari perpustakaan, laboratorium, kantin, hingga taman hijau.';
@endphp

@section('content')
    <x-page-title text="Sarana & Prasarana"
                  :description="'Fasilitas pendukung pembelajaran yang tersedia di '.\App\Support\Site::name().'.'" />

    <div class="container-page py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Sarana Prasarana']]" />

        <div class="mt-10 space-y-8">
            @forelse ($items as $item)
                <article class="group grid overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover lg:grid-cols-5"
                         data-reveal="up">
                    @if ($item->image_url)
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 lg:col-span-2 lg:aspect-auto lg:h-full">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]">
                        </div>
                    @endif

                    <div class="flex flex-col p-6 sm:p-8 lg:col-span-3">
                        <h2 class="font-display text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">{{ $item->title }}</h2>
                        <p class="mt-3 flex-1 leading-relaxed text-slate-600">{{ $item->description }}</p>
                        <a href="{{ route('sarana-prasarana.show', $item) }}" class="link-inline mt-5 inline-flex w-fit items-center gap-1.5 text-sm">
                            Lihat detail
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <p class="py-20 text-center text-slate-500">Belum ada data sarana dan prasarana.</p>
            @endforelse
        </div>
    </div>
@endsection
