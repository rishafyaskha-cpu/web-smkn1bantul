@php
    $partners = \App\Models\Gallery::published()->ordered()->group('partner')->get();
@endphp

@if ($partners->isNotEmpty())
    <section class="border-t border-slate-200/80 bg-surface py-12 lg:py-14">
        <div class="container-page">
            <p class="text-center text-xs font-semibold uppercase tracking-[0.18em] text-slate-500" data-reveal="up">
                Mitra Industri &amp; Institusi
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-8 sm:gap-x-14">
                @foreach ($partners as $partner)
                    <img src="{{ $partner->image_url }}" alt="{{ $partner->alt ?: 'Mitra '.$partner->title }}" loading="lazy"
                         data-reveal="up" data-reveal-delay="{{ $loop->index * 75 }}"
                         class="h-12 w-auto max-w-[9rem] object-contain opacity-70 grayscale transition-all duration-300 hover:opacity-100 hover:grayscale-0 sm:h-14">
                @endforeach
            </div>
        </div>
    </section>
@endif
