@props([
    'step' => null,
    'number' => 1,
    'align' => 'text-left',
    'showIcon' => false,
])

<div {{ $attributes->merge(['class' => "bg-white p-6 rounded-xl shadow-sm w-full max-w-md border border-gray-50 {$align}"]) }}>
    <div class="font-metropolis text-brand-sky font-bold text-xs tracking-wider mb-2 uppercase">
        Langkah {{ str_pad((string) $number, 2, '0', STR_PAD_LEFT) }}
    </div>
    <h3 class="font-metropolis text-xl font-bold text-slate-800 mb-2">{{ $step->title }}</h3>
    <p class="text-slate-600 text-sm @if ($showIcon) mb-4 @endif">{{ $step->description }}</p>

    @if ($showIcon)
        <div class="bg-blue-50 w-12 h-12 rounded-lg flex items-center justify-center">
            <x-ppdb-step-icon :icon="$step->icon" />
        </div>
    @endif
</div>
