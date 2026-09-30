@props(['title' => null, 'articles' => null])

@php
    $articles = $articles ?? \App\Models\Article::published()->latestPublished()->limit(4)->get();
@endphp

<section class="border-y border-slate-200/80 bg-surface">
    <div class="container-page section">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" data-reveal="up">
            <div>
                <p class="eyebrow">{{ $title ?? 'Berita Terkini' }}</p>
                <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Kabar {{ \App\Support\Site::shortName() }}
                </h2>
            </div>
            <x-button :href="route('berita.index')" variant="outline">
                Lihat Semua
            </x-button>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            @forelse ($articles as $index => $article)
                @if ($index === 0)
                    <article class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover lg:row-span-2" data-reveal="up">
                        <a href="{{ route('berita.show', $article) }}" class="relative block aspect-[16/10] overflow-hidden bg-slate-100">
                            @if ($article->image_url)
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                                     class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]">
                            @else
                                <div class="flex h-full w-full items-center justify-center text-sm text-slate-400">Gambar tidak tersedia</div>
                            @endif
                        </a>

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <time datetime="{{ $article->published_at->toDateString() }}" class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                {{ $article->formatted_date }}
                            </time>
                            <h3 class="mt-3 font-display text-xl font-bold leading-snug text-slate-900 sm:text-2xl">
                                <a href="{{ route('berita.show', $article) }}" class="transition-colors hover:text-brand-navy">{{ $article->title }}</a>
                            </h3>
                            <p class="mt-3 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $article->excerpt }}</p>
                            <a href="{{ route('berita.show', $article) }}" class="link-inline mt-5 inline-flex w-fit items-center gap-1.5 text-sm">
                                Baca selengkapnya
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </article>
                @else
                    <x-news-card :article="$article"
                                 data-reveal="up"
                                 data-reveal-delay="{{ ($index - 1) * 100 }}" />
                @endif
            @empty
                <p class="col-span-full py-16 text-center text-slate-500">Belum ada berita yang dipublikasikan.</p>
            @endforelse
        </div>
    </div>
</section>
