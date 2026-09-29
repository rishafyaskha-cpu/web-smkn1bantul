@props(['items' => null])

@php
    $items = $items ?? \App\Models\Achievement::published()->ordered()->get();
    $perView = 3;
@endphp

@if ($items->isNotEmpty())
    <section class="w-full bg-gray-200 py-12 lg:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-start justify-between mb-8 lg:mb-12">
                <div data-reveal="right">
                    <p class="text-gray-500 text-sm sm:text-base uppercase tracking-wide mb-2">PRESTASI SISWA</p>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900">SMKN 1 BANTUL</h2>
                </div>
                <div data-reveal="left">
                    <x-button :href="route('prestasi')" class="whitespace-nowrap">Lihat Semua</x-button>
                </div>
            </div>

            <div class="hidden lg:block relative" x-data="carousel({ count: {{ $items->count() }}, perView: {{ $perView }} })" data-reveal="zoom">
                <button type="button" @click="prev()" :disabled="index === 0"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed enabled:hover:bg-gray-100"
                        aria-label="Prestasi sebelumnya">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button type="button" @click="next()" :disabled="index === maxIndex"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed enabled:hover:bg-gray-100"
                        aria-label="Prestasi berikutnya">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-700 ease-in-out" :style="`transform: translateX(${offset}%)`">
                        @foreach ($items as $item)
                            <div class="w-1/3 flex-shrink-0 px-2">
                                <x-prestasi-card :item="$item" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center gap-2 mt-8">
                    @for ($i = 0; $i <= $items->count() - $perView; $i++)
                        <button type="button" @click="goTo({{ $i }})" :class="index === {{ $i }} ? 'bg-gray-800 w-8' : 'bg-gray-400 hover:bg-gray-600'"
                                class="h-2 rounded-full transition-all duration-300 w-2" aria-label="Slide {{ $i + 1 }}"></button>
                    @endfor
                </div>
            </div>

            <div class="lg:hidden grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($items->take(4) as $item)
                    <x-prestasi-card :item="$item" data-reveal="up" data-reveal-delay="{{ $loop->index * 100 }}" />
                @endforeach
            </div>
        </div>
    </section>
@endif
