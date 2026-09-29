<!DOCTYPE html>
<html lang="id" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-seo :title="$seoTitle ?? null"
            :description="$seoDescription ?? null"
            :image="$seoImage ?? null"
            :noindex="$seoNoindex ?? true"
            :json-ld="$seoJsonLd ?? []" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased">
    <div class="flex min-h-screen flex-col">
        @yield('content')
    </div>
</body>
</html>
