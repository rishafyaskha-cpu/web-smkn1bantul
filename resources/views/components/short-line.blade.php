@props([
    'color' => 'black',
    'class' => '',
])

<svg {{ $attributes->merge(['class' => "absolute w-12 h-1 {$class}"]) }} viewBox="0 0 12 4" preserveAspectRatio="none" aria-hidden="true">
    <rect x="0" y="0" width="12" height="4" rx="0.8" ry="2" fill="{{ $color }}" />
</svg>
