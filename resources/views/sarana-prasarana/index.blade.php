@extends('layouts.app')

@php
    $seoTitle = 'Sarana & Prasarana';
    $seoDescription = 'Daftar sarana dan prasarana yang tersedia di '.\App\Support\Site::name().', mulai dari perpustakaan, laboratorium, kantin, hingga taman hijau.';
@endphp

@section('content')
    <div class="min-h-screen bg-white">
        <x-page-title text="Sarana Prasarana" />

        <main class="py-10 lg:py-20 px-8 sm:px-14">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Sarana Prasarana']]" class="mb-8" />

            <div class="w-full flex flex-col gap-12 items-start sm:px-10 md:px-15 lg:px-20 font-metropolis">
                @forelse ($items as $item)
                    <article class="flex flex-col lg:flex-row w-full h-fit lg:h-[300px] rounded-2xl overflow-hidden shadow-lg" data-reveal="up">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                             class="min-w-2/5 h-full mb-4 object-cover">
                        <div class="flex-1 p-4">
                            <h2 class="text-2xl font-medium mb-6">{{ $item->title }}</h2>
                            <p class="text-lg text-gray-700">{{ $item->description }}</p>
                            <a href="{{ route('sarana-prasarana.show', $item) }}" class="inline-block mt-4 text-brand-sky underline">
                                Lihat detail
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-500">Belum ada data sarana dan prasarana.</p>
                @endforelse
            </div>
        </main>
    </div>
@endsection
