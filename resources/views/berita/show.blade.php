@extends('layouts.app')

@php
    $seoTitle = $article->title;
    $seoDescription = $article->excerpt;
    $seoImage = $article->image_url;
    $seoType = 'article';
    $seoPublishedAt = $article->published_at;
    $seoModifiedAt = $article->updated_at;
    $seoAuthor = $article->author;
    $seoJsonLd = [[
        '@type' => 'NewsArticle',
        'headline' => $article->title,
        'description' => $article->excerpt,
        'image' => $article->image_url ? [$article->image_url] : [],
        'datePublished' => $article->published_at->toAtomString(),
        'dateModified' => $article->updated_at->toAtomString(),
        'author' => ['@type' => 'Organization', 'name' => $article->author ?: \App\Support\Site::name()],
        'publisher' => ['@id' => url('/').'#school'],
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('berita.show', $article)],
    ]];
@endphp

@section('content')
    <article class="min-h-screen bg-gray-50">
        <div class="max-w-3xl mx-auto px-6 sm:px-10 py-10 lg:py-16">
            <x-breadcrumbs :breadcrumbs="[
                ['label' => 'Berita', 'url' => route('berita.index')],
                ['label' => $article->title],
            ]" class="mb-8" />

            <header class="mb-8" data-reveal="up">
                <p class="text-sm text-gray-500 mb-3 flex flex-wrap items-center gap-x-3">
                    <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->formatted_date }}</time>
                    @if ($article->author)
                        <span class="text-gray-400">Penulis: {{ $article->author }}</span>
                    @endif
                    @if ($article->source)
                        <span class="text-gray-400">{{ $article->source }}</span>
                    @endif
                    <span class="text-gray-400">{{ $article->reading_time }} menit baca</span>
                </p>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">{{ $article->title }}</h1>
                @if ($article->excerpt)
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">{{ $article->excerpt }}</p>
                @endif
            </header>

            @if ($article->image_url)
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                     class="w-full rounded-2xl shadow-md mb-8 object-cover" data-reveal="zoom">
            @endif

            @if ($article->body)
                <div class="prose-body font-tt-norms text-gray-700 text-lg" data-reveal="up">{!! nl2br(e($article->body)) !!}</div>
            @endif

            @if ($article->external_url)
                <a href="{{ $article->external_url }}" target="_blank" rel="noopener noreferrer"
                   class="inline-block mt-6 rounded-full bg-neutral-900 px-8 py-2.5 text-white text-sm font-medium hover:bg-brand-sky transition">
                    Baca di sumber asli
                </a>
            @endif

            <a href="{{ route('berita.index') }}" class="mt-10 inline-block text-brand-sky underline">&larr; Kembali ke daftar berita</a>
        </div>

        @if ($related->isNotEmpty())
            <section class="w-full bg-neutral-semiblue py-12 lg:py-16 px-6 lg:px-16">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-2xl font-bold text-brand-teal mb-8">Berita Lainnya</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($related as $item)
                            <a href="{{ route('berita.show', $item) }}" class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow p-6 flex flex-col gap-2">
                                <p class="text-xs text-gray-500">{{ $item->formatted_date }}</p>
                                <h3 class="font-bold text-gray-900">{{ $item->title }}</h3>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $item->excerpt }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection
