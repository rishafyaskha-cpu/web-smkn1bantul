@props(['article' => null])

<article {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row bg-white rounded-xl shadow-md overflow-hidden hover:scale-[1.01] hover:shadow-[0_4px_30px_rgba(0,0,0,0.2)] transition-all duration-150']) }}>
    @if ($article->image_url)
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy"
             class="w-full sm:w-1/3 md:w-1/4 h-48 sm:h-full object-cover rounded-t-xl sm:rounded-l-xl sm:rounded-t-none">
    @else
        <div class="w-full sm:w-1/3 md:w-1/4 h-48 sm:h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm rounded-t-xl sm:rounded-l-xl sm:rounded-t-none">
            No Image
        </div>
    @endif

    <div class="w-full h-full flex flex-col justify-between">
        <div class="p-3 md:p-4">
            <h3 class="text-base md:text-lg font-bold line-clamp-2">
                <a href="{{ route('berita.show', $article) }}" class="hover:text-brand-navy">{{ $article->title }}</a>
            </h3>
            <p class="text-xs md:text-sm text-gray-600 mt-2 line-clamp-2">{{ $article->excerpt }}</p>
        </div>
        <div class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 px-3 md:px-4 pb-3 md:pb-4">
            <x-button :href="route('berita.show', $article)">Read More</x-button>
            <p class="w-fit text-right text-xs md:text-sm text-neutral-500 font-medium px-3 sm:px-0 sm:pr-2">
                <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->formatted_date }}</time>
            </p>
        </div>
    </div>
</article>
