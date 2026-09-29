@props([
    'name' => null,
    'image' => null,
])

@php
    $principal = \App\Support\Site::principal();
@endphp

<div {{ $attributes->merge(['class' => 'justify-center items-center flex flex-col w-full gap-y-12 md:gap-y-28 py-12 md:py-16 lg:py-20']) }}>
    <x-principal-header />

    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] grid-rows-[auto_auto] md:grid-rows-[1fr_10fr] gap-x-6 md:gap-x-12 gap-y-6 md:gap-y-0 items-start min-h-[auto] md:h-[90vh] px-4 sm:px-6 md:px-[5%]">
        <div class="order-1 md:order-none md:col-start-1 md:row-start-1 md:row-span-2" data-reveal="right">
            <img src="{{ $image ?: $principal['photo'] }}" alt="Foto {{ $name ?: $principal['name'] }}" loading="lazy"
                 class="w-full md:w-6xl h-auto rounded-md shadow-lg">
        </div>

        <div class="order-2 md:order-none md:col-start-2 md:row-start-1" data-reveal="left">
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-semibold mb-4 font-metropolis">{{ $name ?: $principal['name'] }}</h3>
            <x-long-line color="#0093DD" class="w-32 sm:w-36 md:w-44" />
            <x-short-line color="#0093DD" class="ml-32 sm:ml-36 md:ml-48" />
        </div>

        <div class="order-3 md:order-none md:col-start-2 md:row-start-2 text-left items-start pl-0 md:pl-7" data-reveal="left" data-reveal-delay="150">
            <div class="font-geomanist text-sm sm:text-base md:text-lg leading-relaxed text-gray-700">
                {{ $slot->isEmpty() ? $principal['message'] : $slot }}
            </div>
        </div>
    </div>
</div>
