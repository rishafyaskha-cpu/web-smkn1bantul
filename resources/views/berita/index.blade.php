@extends('layouts.app')

@php
    $seoTitle = 'Berita & Informasi';
    $seoDescription = 'Kabar terbaru, prestasi, dan informasi resmi dari '.\App\Support\Site::name().'.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-page-title text="Berita &amp; Informasi" />

        <main class="py-10 lg:py-16 px-6 sm:px-10 lg:px-16 max-w-7xl mx-auto">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Berita']]" class="mb-8" />

            <form method="GET" action="{{ route('berita.index') }}" role="search" class="mb-10 max-w-md">
                <label for="q" class="sr-only">Cari berita</label>
                <div class="flex gap-2">
                    <input type="search" name="q" id="q" value="{{ $q }}" placeholder="Cari berita..."
                           class="w-full rounded-full border-2 border-neutral-900 px-5 py-2 text-sm focus:border-brand-sky">
                    <button type="submit" class="rounded-full bg-neutral-900 px-5 py-2 text-white text-sm font-medium hover:bg-brand-sky transition">
                        Cari
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($articles as $article)
                    <article class="flex flex-col bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow" data-reveal="up" data-reveal-delay="{{ ($loop->index % 3) * 100 }}">
                        @if ($article->image_url)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <p class="text-xs text-gray-500 mb-2">
                                <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->formatted_date }}</time>
                                @if ($article->source)
                                    <span class="ml-2 text-gray-400">{{ $article->source }}</span>
                                @endif
                            </p>
                            <h2 class="text-lg font-bold text-gray-900 mb-2">
                                <a href="{{ route('berita.show', $article) }}" class="hover:text-brand-navy">{{ $article->title }}</a>
                            </h2>
                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 flex-grow">{{ $article->excerpt }}</p>
                            <a href="{{ route('berita.show', $article) }}" class="mt-4 text-sm font-medium text-brand-sky hover:underline w-fit">
                                Baca selengkapnya &rarr;
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-16">
                        {{ $q ? 'Tidak ada berita yang cocok dengan pencarian Anda.' : 'Belum ada berita yang dipublikasikan.' }}
                    </p>
                @endforelse
            </div>

            @if ($articles->hasPages())
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @endif
        </main>
    </div>
@endsection
