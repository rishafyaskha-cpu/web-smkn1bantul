@extends('layouts.app')

@php
    $seoTitle = 'Berita & Informasi';
    $seoDescription = 'Kabar terbaru, prestasi, dan informasi resmi dari '.\App\Support\Site::name().'.';
@endphp

@section('content')
    <x-page-title text="Berita & Informasi"
                  :description="'Kabar terbaru, prestasi, dan informasi resmi '.\App\Support\Site::name().'.'" />

    <div class="container-page py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Berita']]" />

        <form method="GET" action="{{ route('berita.index') }}" role="search" class="mt-8 max-w-md">
            <label for="q" class="sr-only">Cari berita</label>
            <div class="flex gap-2">
                <input type="search" name="q" id="q" value="{{ $q }}" placeholder="Cari berita..."
                       class="input">
                <x-button type="submit" variant="dark" class="shrink-0">Cari</x-button>
            </div>
        </form>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($articles as $article)
                <article class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover"
                         data-reveal="up" data-reveal-delay="{{ ($loop->index % 3) * 100 }}">
                    @if ($article->image_url)
                        <a href="{{ route('berita.show', $article) }}" class="aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]">
                        </a>
                    @endif

                    <div class="flex flex-1 flex-col p-6">
                        <p class="flex flex-wrap items-center gap-x-3 text-xs font-medium uppercase tracking-wide text-slate-500">
                            <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->formatted_date }}</time>
                            @if ($article->source)
                                <span class="text-slate-400">{{ $article->source }}</span>
                            @endif
                        </p>

                        <h2 class="mt-3 font-display text-lg font-bold leading-snug text-slate-900">
                            <a href="{{ route('berita.show', $article) }}" class="transition-colors hover:text-brand-navy">{{ $article->title }}</a>
                        </h2>

                        <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $article->excerpt }}</p>

                        <a href="{{ route('berita.show', $article) }}" class="link-inline mt-4 inline-flex w-fit items-center gap-1.5 text-sm">
                            Baca selengkapnya
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <p class="col-span-full py-20 text-center text-slate-500">
                    {{ $q ? 'Tidak ada berita yang cocok dengan pencarian Anda.' : 'Belum ada berita yang dipublikasikan.' }}
                </p>
            @endforelse
        </div>

        @if ($articles->hasPages())
            <div class="mt-12">{{ $articles->links() }}</div>
        @endif
    </div>
@endsection
