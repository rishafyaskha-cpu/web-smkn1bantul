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
    <div class="relative w-full bg-gray-200 rounded-lg sm:rounded-xl lg:rounded-2xl overflow-hidden shadow-md"
         x-data="carousel({ count: {{ $images->count() }}, perView: 1, autoplay: {{ $autoplay ? 'true' : 'false' }}, interval: {{ $interval }} })"
         data-reveal="zoom"
         @mouseenter="stop()" @mouseleave="play()">
        <div class="relative aspect-[16/10] sm:aspect-video lg:aspect-[21/9] overflow-hidden">
            <div class="flex transition-transform duration-700 ease-in-out h-full" :style="`transform: translateX(${offset}%)`">
                @foreach ($images as $image)
                    <img src="{{ $image->image_url }}" alt="{{ $image->alt ?: $altPrefix.' '.($loop->iteration) }}"
                         class="w-full h-full flex-shrink-0 object-cover" loading="lazy">
                @endforeach
            </div>

            <button type="button" @click="prev()"
                    class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-white/70 hover:bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200 hover:scale-110"
                    aria-label="Gambar sebelumnya">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button type="button" @click="next()"
                    class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all duration-200 hover:scale-110"
                    aria-label="Gambar berikutnya">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="absolute bottom-2 sm:bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 sm:gap-2">
                @foreach ($images as $image)
                    <button type="button" @click="goTo({{ $loop->index }})"
                            :class="index === {{ $loop->index }} ? 'bg-white w-6' : 'bg-white/50 hover:bg-white/75 w-1.5 sm:w-2'"
                            class="h-1.5 sm:h-2 rounded-full transition-all duration-300"
                            aria-label="Gambar {{ $loop->iteration }}"></button>
                @endforeach
            </div>
        </div>
    </div>
@endif
