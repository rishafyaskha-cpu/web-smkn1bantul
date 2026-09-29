@props(['items' => null])

@php
    $items = $items ?? \App\Models\SiteStatistic::ordered()->get();
@endphp

@if ($items->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'font-red-hat w-4/5 sm:w-3/4 lg:w-2/3 xl:w-1/2 bg-primary-blue rounded-2xl px-0 md:px-14 drop-shadow-[0_7px_13px_rgba(8,50,71,0.3)]']) }}>
        <ol class="grid grid-cols-2 grid-rows-2 gap-y-6 sm:flex sm:justify-between text-secondary-white [&>li]:flex [&>li]:flex-col [&>li]:items-center [&>li]:gap-0 md:[&>li]:gap-2 px-8 py-4 text-sm md:text-base lg:text-lg">
            @foreach ($items as $item)
                <li data-reveal="up" data-reveal-delay="{{ $loop->index * 100 }}">
                    <span class="font-bold text-xl md:text-3xl">{{ $item->value }}</span>
                    <span>{{ $item->label }}</span>
                </li>
            @endforeach
        </ol>
    </div>
@endif
