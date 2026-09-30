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
    <article class="bg-white">
        <div class="container-page max-w-3xl py-10 lg:py-14">
            <x-breadcrumbs :breadcrumbs="[
                ['label' => 'Berita', 'url' => route('berita.index')],
                ['label' => $article->title],
            ]" />

            <header class="mt-8" data-reveal="up">
                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                    <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->formatted_date }}</time>
                    @if ($article->author)
                        <span aria-hidden="true" class="text-slate-300">&middot;</span>
                        <span>{{ $article->author }}</span>
                    @endif
                    @if ($article->source)
                        <span aria-hidden="true" class="text-slate-300">&middot;</span>
                        <span>{{ $article->source }}</span>
                    @endif
                    <span aria-hidden="true" class="text-slate-300">&middot;</span>
                    <span>{{ $article->reading_time }} menit baca</span>
                </div>

                <h1 class="mt-4 font-display text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                    {{ $article->title }}
                </h1>

                @if ($article->excerpt)
                    <p class="mt-5 text-lg leading-relaxed text-slate-600">{{ $article->excerpt }}</p>
                @endif
            </header>
        </div>

        @if ($article->image_url)
            <figure class="container-page max-w-4xl" data-reveal="zoom">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                     class="aspect-[16/9] w-full rounded-2xl object-cover shadow-card">
            </figure>
        @endif

        <div class="container-page max-w-3xl py-10 lg:py-12">
            @if ($article->body)
                <div class="prose-body text-lg text-slate-700" data-reveal="up">{!! nl2br(e($article->body)) !!}</div>
            @endif

            @if ($article->external_url)
                <x-button :href="$article->external_url" target="_blank" variant="dark" size="lg" class="mt-8">
                    Baca di sumber asli
                    <span aria-hidden="true">&nearr;</span>
                </x-button>
            @endif

            <a href="{{ route('berita.index') }}" class="link-inline mt-10 inline-flex items-center gap-1.5 text-sm">
                <span aria-hidden="true">&larr;</span>
                Kembali ke daftar berita
            </a>
        </div>

        @if ($related->isNotEmpty())
            <section class="border-t border-slate-200/80 bg-surface">
                <div class="container-page py-12 lg:py-16">
                    <h2 class="font-display text-2xl font-bold tracking-tight text-slate-900">Berita Lainnya</h2>

                    <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($related as $item)
                            <a href="{{ route('berita.show', $item) }}"
                               class="group flex flex-col gap-2 rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">{{ $item->formatted_date }}</p>
                                <h3 class="font-display font-bold leading-snug text-slate-900 transition-colors group-hover:text-brand-navy">{{ $item->title }}</h3>
                                <p class="line-clamp-2 text-sm leading-relaxed text-slate-600">{{ $item->excerpt }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection
