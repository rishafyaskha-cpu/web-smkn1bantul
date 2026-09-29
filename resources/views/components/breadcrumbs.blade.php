@props(['breadcrumbs' => []])

@if (count($breadcrumbs) > 0)
    <nav aria-label="Remah roti" class="w-full">
        <ol class="flex flex-wrap items-center gap-2 text-sm text-gray-500">
            <li>
                <a href="{{ route('home') }}" class="hover:text-brand-navy">Beranda</a>
            </li>
            @foreach ($breadcrumbs as $index => $crumb)
                <li aria-hidden="true" class="text-gray-300">/</li>
                <li @class(['text-gray-700 font-medium' => $crumb['url'] ?? null, 'text-gray-500' => ! ($crumb['url'] ?? null)])>
                    @if ($crumb['url'] ?? null)
                        <a href="{{ $crumb['url'] }}" class="hover:text-brand-navy">{{ $crumb['label'] }}</a>
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
