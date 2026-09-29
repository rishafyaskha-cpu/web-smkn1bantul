@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'keywords' => null,
    'type' => 'website',
    'canonical' => null,
    'publishedAt' => null,
    'modifiedAt' => null,
    'author' => null,
    'section' => null,
    'tags' => null,
    'noindex' => false,
    'jsonLd' => [],
])

@php
    use App\Support\Site;

    $siteName = Site::name();
    $defaultDescription = Site::get('seo.default_description', 'Sekolah Menengah Kejuruan Negeri 1 Bantul, Yogyakarta. Mencetak generasi unggul dan kompeten.');
    $resolvedTitle = $title ? "{$title} | {$siteName}" : ($siteName.' — '.Site::get('seo.default_title_suffix', 'Sekolah Menengah Kejuruan Negeri 1 Bantul'));
    $resolvedDescription = $description ?: Site::get('seo.default_description', $defaultDescription);
    $resolvedKeywords = $keywords ?: Site::get('seo.keywords', 'SMKN 1 Bantul, SMK Negeri 1 Bantul, sekolah menengah kejuruan, Bantul, Yogyakarta, pendidikan vokasional');
    $resolvedImage = $image ?: Site::ogImage();
    $resolvedCanonical = $canonical ?: url()->current();
@endphp

<title>{{ $resolvedTitle }}</title>
<meta name="description" content="{{ Str::limit(strip_tags($resolvedDescription), 300) }}">
<meta name="keywords" content="{{ $resolvedKeywords }}">
<meta name="author" content="{{ $author ?: Site::get('seo.author', $siteName) }}">
<meta name="publisher" content="{{ $siteName }}">
<meta name="copyright" content="&copy; {{ date('Y') }} {{ $siteName }}">

@if ($noindex)
    <meta name="robots" content="noindex, nofollow">
@else
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
@endif

<meta name="theme-color" content="#0a3c86">
<meta name="format-detection" content="telephone=no">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:locale" content="id_ID">
<meta property="og:title" content="{{ $resolvedTitle }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($resolvedDescription), 300) }}">
<meta property="og:url" content="{{ $resolvedCanonical }}">
@if ($resolvedImage)
    <meta property="og:image" content="{{ $resolvedImage }}">
    <meta property="og:image:alt" content="{{ $resolvedTitle }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
@endif
@if ($publishedAt)
    <meta property="article:published_time" content="{{ \Illuminate\Support\Carbon::parse($publishedAt)->toIso8601String() }}">
@endif
@if ($modifiedAt)
    <meta property="article:modified_time" content="{{ \Illuminate\Support\Carbon::parse($modifiedAt)->toIso8601String() }}">
@endif
@if ($author)
    <meta property="article:author" content="{{ $author }}">
@endif
@if ($section)
    <meta property="article:section" content="{{ $section }}">
@endif
@if ($tags)
    @foreach ((array) $tags as $tag)
        <meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $resolvedTitle }}">
<meta name="twitter:description" content="{{ Str::limit(strip_tags($resolvedDescription), 300) }}">
@if ($resolvedImage)
    <meta name="twitter:image" content="{{ $resolvedImage }}">
@endif

{{-- Canonical --}}
<link rel="canonical" href="{{ $resolvedCanonical }}">

{{-- Icons --}}
<link rel="icon" href="{{ asset('images/logo.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

{{-- Performance hints --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

{{-- Structured data --}}
@php
    $organization = [
        '@context' => 'https://schema.org',
        '@type' => 'School',
        '@id' => url('/').'#school',
        'name' => $siteName,
        'alternateName' => 'SMKN 1 Bantul',
        'url' => url('/'),
        'logo' => asset('images/logo.png'),
        'image' => Site::ogImage(),
        'description' => Site::get('seo.default_description'),
        'foundingDate' => '1968',
        'telephone' => Site::get('contact.phone'),
        'email' => Site::get('contact.email'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => Site::get('contact.address'),
            'addressLocality' => 'Bantul',
            'addressRegion' => 'Yogyakarta',
            'postalCode' => '55715',
            'addressCountry' => 'ID',
        ],
        'sameAs' => array_values(array_filter([
            Site::get('social.youtube'),
            Site::get('social.instagram'),
            Site::get('social.telegram'),
            Site::get('social.tiktok'),
        ])),
    ];

    $website = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/').'#website',
        'url' => url('/'),
        'name' => $siteName,
        'inLanguage' => 'id-ID',
        'publisher' => ['@id' => url('/').'#school'],
    ];

    $graphs = array_values(array_filter(array_merge([$organization, $website], $jsonLd)));
@endphp

<script type="application/ld+json">{!! json_encode(['@graph' => $graphs], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
