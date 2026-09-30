@props(['article' => null])

<article {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover sm:flex-row']) }}>
    <a href="{{ route('berita.show', $article) }}" class="relative block shrink-0 overflow-hidden bg-slate-100 sm:w-2/5">
        @if ($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                 class="h-48 w-full object-cover transition-transform duration-700 group-hover:scale-[1.04] sm:h-full">
        @else
            <div class="flex h-48 w-full items-center justify-center text-sm text-slate-400 sm:h-full">Gambar tidak tersedia</div>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-5 sm:p-6">
        <time datetime="{{ $article->published_at->toDateString() }}" class="text-xs font-medium uppercase tracking-wide text-slate-500">
            {{ $article->formatted_date }}
        </time>
        <h3 class="mt-2 font-display text-base font-bold leading-snug text-slate-900 sm:text-lg">
            <a href="{{ route('berita.show', $article) }}" class="line-clamp-2 transition-colors hover:text-brand-navy">{{ $article->title }}</a>
        </h3>
        <p class="mt-2 line-clamp-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $article->excerpt }}</p>
        <a href="{{ route('berita.show', $article) }}" class="link-inline mt-4 inline-flex w-fit items-center gap-1.5 text-sm">
            Baca selengkapnya
            <span aria-hidden="true">&rarr;</span>
        </a>
    </div>
</article>
