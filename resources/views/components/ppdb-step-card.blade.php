@props([
    'step' => null,
    'number' => 1,
    'align' => 'text-left',
    'showIcon' => false,
])

<div {{ $attributes->merge(['class' => "card p-6 {$align}"]) }}>
    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-sky">
        Langkah {{ str_pad((string) $number, 2, '0', STR_PAD_LEFT) }}
    </p>
    <h3 class="mt-2 font-display text-lg font-bold leading-snug text-slate-900">{{ $step->title }}</h3>
    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $step->description }}</p>

    @if ($showIcon)
        <div class="mt-4 flex h-12 w-12 items-center justify-center rounded-xl bg-surface-muted text-brand-sky">
            <x-ppdb-step-icon :icon="$step->icon" />
        </div>
    @endif
</div>
