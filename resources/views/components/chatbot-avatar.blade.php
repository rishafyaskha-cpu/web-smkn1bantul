@props(['size' => 'md', 'state' => 'idle', 'sparkle' => false])

@php
    $sizes = [
        'sm' => 'h-8 w-8',
        'md' => 'h-10 w-10',
        'lg' => 'h-12 w-12',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<span {{ $attributes->merge(['class' => "relative inline-flex shrink-0 items-center justify-center {$sizeClass}"]) }}
      role="img" aria-label="Skansaba AI">
    @if ($state === 'thinking')
        <span class="absolute inset-0 rounded-full bg-brand-sky/40 animate-bot-pulse" aria-hidden="true"></span>
    @endif

    <span class="relative flex h-full w-full items-center justify-center rounded-full bg-white shadow-[0_6px_18px_-8px_rgba(10,60,134,0.65)] ring-1 ring-slate-900/10">
        <svg class="h-[72%] w-[72%]" viewBox="0 0 40 40" fill="none" aria-hidden="true">
            <path d="M20 7.6v3.2" stroke="#0a3c86" stroke-width="1.8" stroke-linecap="round" />
            <circle cx="20" cy="5.8" r="2.1" fill="#fbbf24" />
            <rect x="3.4" y="17.6" width="3.4" height="7" rx="1.7" fill="#eef2f9" stroke="#0a3c86" stroke-width="1.1" />
            <rect x="33.2" y="17.6" width="3.4" height="7" rx="1.7" fill="#eef2f9" stroke="#0a3c86" stroke-width="1.1" />
            <rect x="6" y="10.4" width="28" height="21.2" rx="8" fill="#ffffff" stroke="#0a3c86" stroke-width="1.6" />
            <rect x="10.6" y="14.6" width="18.8" height="13" rx="6" fill="#0b4cf0" />
            <circle cx="15.9" cy="20.9" r="1.7" fill="#ffffff" class="origin-center [transform-box:fill-box] animate-bot-blink" />
            <circle cx="24.1" cy="20.9" r="1.7" fill="#ffffff" class="origin-center [transform-box:fill-box] animate-bot-blink" />
            <path d="M16.6 24.5c.9 1.1 2 1.6 3.4 1.6s2.5-.5 3.4-1.6" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" />
        </svg>
    </span>

    @if ($sparkle)
        <svg class="absolute -right-1 -top-1 h-4 w-4 text-amber-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2.2c.7 4.8 2.6 6.7 7.4 7.4-4.8.7-6.7 2.6-7.4 7.4-.7-4.8-2.6-6.7-7.4-7.4 4.8-.7 6.7-2.6 7.4-7.4Z" />
        </svg>
    @endif
</span>
