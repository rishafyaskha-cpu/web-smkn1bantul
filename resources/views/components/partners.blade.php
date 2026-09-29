@php
    $partners = \App\Models\Gallery::published()->ordered()->group('partner')->get();
@endphp

@if ($partners->isNotEmpty())
    <div class="w-full">
        <div class="flex flex-col items-center mx-auto py-8">
            <p class="text-2xl text-neutral-500" data-reveal="up">JHIC Powered by</p>
            <div class="flex flex-wrap justify-center w-fit">
                @foreach ($partners as $partner)
                    <img src="{{ $partner->image_url }}" alt="{{ $partner->alt ?: 'Partner' }}" loading="lazy"
                         data-reveal="up" data-reveal-delay="{{ $loop->index * 100 }}"
                         class="w-[12rem] object-contain h-auto transition-all duration-300 lg:grayscale-90 hover:grayscale-0 hover:scale-105">
                @endforeach
            </div>
        </div>
    </div>
@endif
