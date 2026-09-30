@props(['size' => 'md', 'state' => 'idle'])

@php
    $sizes = [
        'sm' => 'h-8 w-8',
        'md' => 'h-10 w-10',
        'lg' => 'h-12 w-12',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<span {{ $attributes->merge(['class' => "relative inline-flex shrink-0 items-center justify-center {$sizeClass}"]) }}
      role="img" aria-label="Skansaba Bot">
    @if ($state === 'thinking')
        <span class="absolute inset-0 rounded-full bg-brand-sky/40 animate-bot-pulse" aria-hidden="true"></span>
    @endif

    <span class="chatbot-glow relative flex h-full w-full items-center justify-center rounded-full shadow-[0_6px_18px_-4px_rgba(11,76,240,0.55)] ring-1 ring-white/25">
        <svg class="h-[58%] w-[58%] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                  d="M12 3v2.2M7.5 6.5h9A2.5 2.5 0 0 1 19 9v5.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 5 14.5V9a2.5 2.5 0 0 1 2.5-2.5Z" />
            <circle cx="9.6" cy="11.4" r="1.05" fill="currentColor" stroke="none" class="origin-center animate-bot-blink" />
            <circle cx="14.4" cy="11.4" r="1.05" fill="currentColor" stroke="none" class="origin-center animate-bot-blink" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.8 14.2h4.4" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9.5 17v1.6M14.5 17v1.6" />
        </svg>
    </span>
</span>
