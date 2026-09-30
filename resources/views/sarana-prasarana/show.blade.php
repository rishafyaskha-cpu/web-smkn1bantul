@extends('layouts.app')

@php
    $seoTitle = $item->title;
    $seoDescription = $item->description;
    $seoImage = $item->image_url;
    $seoType = 'article';
@endphp

@section('content')
    <article class="bg-white">
        <div class="container-page max-w-4xl py-10 lg:py-14">
            <x-breadcrumbs :breadcrumbs="[
                ['label' => 'Sarana Prasarana', 'url' => route('sarana-prasarana.index')],
                ['label' => $item->title],
            ]" />

            <header class="mt-8" data-reveal="up">
                <p class="eyebrow">Sarana &amp; Prasarana</p>
                <h1 class="mt-3 font-display text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                    {{ $item->title }}
                </h1>
            </header>

            @if ($item->image_url)
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                     class="mt-8 aspect-[16/9] w-full rounded-2xl object-cover shadow-card" data-reveal="zoom">
            @endif

            <p class="mt-8 text-lg leading-relaxed text-slate-700" data-reveal="up">{{ $item->description }}</p>

            <a href="{{ route('sarana-prasarana.index') }}" class="link-inline mt-10 inline-flex items-center gap-1.5 text-sm">
                <span aria-hidden="true">&larr;</span>
                Kembali ke daftar sarana prasarana
            </a>
        </div>
    </article>
@endsection
