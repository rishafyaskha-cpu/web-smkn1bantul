@props(['breadcrumbs' => []])

@if (count($breadcrumbs) > 0)
    <nav aria-label="Remah roti" class="w-full">
        <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-slate-500">
            <li>
                <a href="{{ route('home') }}" class="transition-colors hover:text-brand-navy">Beranda</a>
            </li>
            @foreach ($breadcrumbs as $crumb)
                <li aria-hidden="true" class="text-slate-300">/</li>
                <li @class(['font-medium text-slate-700' => $crumb['url'] ?? null, 'text-slate-500' => ! ($crumb['url'] ?? null)])>
                    @if ($crumb['url'] ?? null)
                        <a href="{{ $crumb['url'] }}" class="transition-colors hover:text-brand-navy">{{ $crumb['label'] }}</a>
                    @else
                        {{ $crumb['label'] }}
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>

    <script type="application/ld+json">{!!
        json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(
                fn ($crumb, $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $crumb['label'],
                    'item' => $crumb['url'] ?? url()->current(),
                ],
                $breadcrumbs,
                array_keys($breadcrumbs)
            ),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    !!}</script>
@endif
