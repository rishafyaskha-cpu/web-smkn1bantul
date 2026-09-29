@props(['title' => null, 'articles' => null])

@php
    $articles = $articles ?? \App\Models\Article::published()->latest()->limit(4)->get();
@endphp

<section class="w-full py-12 sm:py-16 lg:py-24 px-4 sm:px-10 lg:px-24 mt-8 sm:mt-12 md:mt-16 lg:mt-20">
    <div class="w-full flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-12">
        <div class="flex flex-col" data-reveal="right">
            <p class="w-full text-lg sm:text-xl text-left text-gray-500 uppercase tracking-wide">{{ $title ?? 'BERITA TERKINI' }}</p>
            <h2 class="w-full text-3xl sm:text-4xl lg:text-5xl font-bold text-[#063852]">SMKN 1 BANTUL</h2>
        </div>
        <div class="w-full sm:w-auto" data-reveal="left">
            <x-button :href="route('berita.index')" target="_self">Lihat Semua</x-button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 lg:grid-rows-6 gap-6">
        @forelse ($articles as $index => $article)
            @if ($index === 0)
                <article class="flex flex-col md:col-span-2 lg:col-span-2 lg:row-span-6 bg-white rounded-xl shadow-md hover:scale-[1.01] hover:shadow-[0_4px_30px_rgba(0,0,0,0.2)] transition-all duration-150 overflow-hidden" data-reveal="zoom">
                    @if ($article->image_url)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
                             class="w-full h-64 md:h-96 lg:h-2/3 object-cover">
                    @else
                        <div class="w-full h-64 md:h-96 lg:h-2/3 bg-gray-200 flex items-center justify-center text-gray-500">
                            Gambar tidak tersedia
                        </div>
                    @endif
                    <div class="px-4 md:px-6 flex flex-col gap-4 md:gap-6 h-full pt-6 md:pt-12 pb-4 md:pb-6">
                        <h3 class="text-lg md:text-xl font-bold line-clamp-2">
                            <a href="{{ route('berita.show', $article) }}" class="hover:text-brand-navy">{{ $article->title }}</a>
                        </h3>
                        <p class="text-sm md:text-md text-gray-600 line-clamp-2">{{ $article->excerpt }}</p>
                        <x-button :href="route('berita.show', $article)">Read More</x-button>
                    </div>
                    <p class="w-full text-right py-2 px-4 text-sm md:text-base text-neutral-500 font-medium">
                        <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->formatted_date }}</time>
                    </p>
                </article>
            @else
                <x-news-card :article="$article"
                             data-reveal="up"
                             data-reveal-delay="{{ ($index - 1) * 150 }}"
                             :class="match ($index) {
                                 1 => 'md:col-span-2 lg:col-span-3 lg:row-span-2 lg:col-start-3',
                                 2 => 'md:col-span-2 lg:col-span-3 lg:row-span-2 lg:col-start-3 lg:row-start-3',
                                 default => 'md:col-span-2 lg:col-span-3 lg:row-span-2 lg:col-start-3 lg:row-start-5',
                             }" />
            @endif
        @empty
            <p class="col-span-full text-center text-gray-500 py-10">Belum ada berita yang dipublikasikan.</p>
        @endforelse
    </div>
</section>
