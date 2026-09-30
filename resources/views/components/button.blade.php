@props([
    'href' => null,
    'target' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $variants = [
        'primary' => 'bg-brand-sky text-white shadow-sm hover:bg-brand-navy focus-visible:outline-brand-navy',
        'dark' => 'bg-brand-teal text-white shadow-sm hover:bg-brand-navy focus-visible:outline-brand-navy',
        'outline' => 'border border-slate-300 bg-white text-slate-800 hover:border-brand-navy hover:text-brand-navy',
        'ghost' => 'text-slate-700 hover:bg-slate-100 hover:text-brand-navy',
        'danger' => 'bg-red-600 text-white shadow-sm hover:bg-red-700',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-7 py-3 text-base',
    ];
@endphp

@if ($href)
    <a href="{{ $href }}"
       @if ($target) target="{{ $target }}" rel="noopener noreferrer" @endif
       {{ $attributes->merge([
           'class' => 'inline-flex w-fit items-center justify-center gap-2 rounded-lg font-semibold transition-colors duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 '.($variants[$variant] ?? $variants['primary']).' '.($sizes[$size] ?? $sizes['md']),
       ]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge([
                'class' => 'inline-flex w-fit items-center justify-center gap-2 rounded-lg font-semibold transition-colors duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:pointer-events-none disabled:opacity-50 '.($variants[$variant] ?? $variants['primary']).' '.($sizes[$size] ?? $sizes['md']),
            ]) }}>
        {{ $slot }}
    </button>
@endif
