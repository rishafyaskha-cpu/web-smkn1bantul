@extends('layouts.app')

@php
    $seoTitle = $item->title;
    $seoDescription = $item->description;
    $seoImage = $item->image_url;
    $seoType = 'article';
@endphp

@section('content')
    <div class="min-h-screen bg-white">
        <x-page-title text="Sarana Prasarana" />

        <main class="py-10 lg:py-16 px-6 sm:px-10 lg:px-16 max-w-5xl mx-auto">
            <x-breadcrumbs :breadcrumbs="[
                ['label' => 'Sarana Prasarana', 'url' => route('sarana-prasarana.index')],
                ['label' => $item->title],
            ]" class="mb-8" />

            <article class="flex flex-col gap-8" data-reveal="up">
                @if ($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full rounded-2xl shadow-md object-cover" loading="lazy">
                @endif

                <h1 class="text-3xl lg:text-4xl font-bold text-brand-teal">{{ $item->title }}</h1>
                <p class="text-lg text-gray-700 leading-relaxed font-tt-norms">{{ $item->description }}</p>

                <a href="{{ route('sarana-prasarana.index') }}" class="text-brand-sky underline w-fit">&larr; Kembali ke daftar</a>
            </article>
        </main>
    </div>
@endsection
