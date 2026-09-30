@props(['item' => null])

<article {{ $attributes->merge(['class' => 'group flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover']) }}>
    <div class="aspect-[4/3] overflow-hidden bg-slate-100">
        <img src="{{ $item->image_url ?: asset('images/placeholder.svg') }}" alt="{{ $item->title }}" loading="lazy"
             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]">
    </div>

    <div class="flex flex-1 flex-col p-5">
        @if ($item->level)
            <span class="badge badge-info mb-3 self-start">{{ $item->level }}</span>
        @endif

        <h3 class="font-display text-base font-bold leading-snug text-slate-900">{{ $item->title }}</h3>

        @if ($item->student_name)
            <p class="mt-1.5 text-sm text-slate-500">
                {{ $item->student_name }}@if ($item->class_name) &middot; {{ $item->class_name }}@endif
            </p>
        @endif

        @if ($item->description)
            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">{{ $item->description }}</p>
        @endif
    </div>
</article>
