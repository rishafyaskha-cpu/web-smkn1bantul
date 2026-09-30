@props([
    'group' => null,
    'autoplay' => true,
    'interval' => 3000,
    'altPrefix' => 'Galeri',
])

@php
    $images = $group
        ? \App\Models\Gallery::published()->ordered()->group($group)->get()
        : collect();
@endphp

@if ($images->isNotEmpty())
    <div class="relative w-full overflow-hidden rounded-2xl bg-slate-100 shadow-card ring-1 ring-slate-900/5"
         x-data="carousel({ count: {{ $images->count() }}, perView: 1, autoplay: {{ $autoplay ? 'true' : 'false' }}, interval: {{ $interval }} })"
         data-reveal="zoom"
         @mouseenter="stop()" @mouseleave="play()">
        <div class="relative aspect-[16/10] overflow-hidden sm:aspect-video lg:aspect-[21/9]">
            <div class="flex h-full transition-transform duration-700 ease-in-out" :style="`transform: translateX(${offset}%)`">
                @foreach ($images as $image)
                    <img src="{{ $image->image_url }}" alt="{{ $image->alt ?: $altPrefix.' '.($loop->iteration) }}"
                         class="h-full w-full shrink-0 object-cover" loading="lazy">
                @endforeach
            </div>

            <button type="button" @click="prev()"
                    class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-slate-800 shadow-card backdrop-blur transition-all hover:bg-white sm:left-4 sm:h-11 sm:w-11"
                    aria-label="Gambar sebelumnya">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button type="button" @click="next()"
                    class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-slate-800 shadow-card backdrop-blur transition-all hover:bg-white sm:right-4 sm:h-11 sm:w-11"
                    aria-label="Gambar berikutnya">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
                @foreach ($images as $image)
                    <button type="button" @click="goTo({{ $loop->index }})"
                            :class="index === {{ $loop->index }} ? 'w-7 bg-white' : 'w-2 bg-white/60 hover:bg-white/80'"
                            class="h-2 rounded-full transition-all duration-300"
                            aria-label="Gambar {{ $loop->iteration }}"></button>
                @endforeach
            </div>
        </div>
    </div>
@endif
