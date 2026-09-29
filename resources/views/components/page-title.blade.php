@props(['text' => null])

<div {{ $attributes->merge(['class' => 'w-full flex flex-col items-center font-tt-norms text-center my-8']) }}>
    @if ($text)
        <h2 class="text-xl font-normal lg:text-3xl text-[#888888]" data-reveal="up">{{ $text }}</h2>
    @endif
    <h1 class="text-4xl lg:text-5xl font-bold text-[#063852]" data-reveal="up" data-reveal-delay="100">SMKN 1 Bantul</h1>
</div>
