@props([
    'text' => null,
    'href' => null,
    'target' => null,
    'variant' => 'neutral',
])

@php
    $classes = match ($variant) {
        'dark' => 'bg-[#063852] text-white hover:bg-[#052c42] border-transparent',
        'primary' => 'bg-brand-sky text-white hover:bg-blue-700 border-transparent',
        default => 'bg-[#f4f4f4] border-neutral-900 text-neutral-950 hover:bg-neutral-950 hover:text-white',
    };

    $tag = $href ? 'a' : 'span';
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @endif
    @if ($target) target="{{ $target }}" rel="noopener noreferrer" @endif
    {{ $attributes->merge(['class' => "inline-block w-fit h-fit font-medium border-2 py-1.5 px-8 rounded-[100px] transition-all duration-200 cursor-pointer {$classes}"]) }}>
    {{ $slot }}
</{{ $tag }}>
