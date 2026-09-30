@props(['name' => 'dashboard'])

@php
    $paths = [
        'dashboard' => 'M3 12l9-8 9 8M5 10v10a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1V10',
        'news' => 'M19 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2h2ZM7 8h8M7 12h8M7 16h5',
        'trophy' => 'M8 21h8M12 17v4M7 4h10v4a5 5 0 0 1-10 0V4Zm10 1h3a3 3 0 0 1-3 3M7 5H4a3 3 0 0 0 3 3',
    ];
@endphp

<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $paths[$name] ?? $paths['dashboard'] }}" />
</svg>
