@extends('layouts.app')

@php
    $seoTitle = $program->title;
    $seoDescription = $program->summary ?: strip_tags(\Illuminate\Support\Str::limit(collect($program->sections ?? [])->pluck('text')->implode(' '), 200));
    $seoImage = $program->image_url;
@endphp

@section('content')
    <x-page-title text="Program Keahlian" />

    <div class="container-page py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[
            ['label' => 'Program Keahlian', 'url' => route('program-keahlian.index')],
            ['label' => $program->title],
        ]" />

        <div class="mt-10 grid gap-10 lg:grid-cols-12 lg:gap-14">
            <div class="lg:col-span-5" data-reveal="right">
                @if ($program->image_url)
                    <img src="{{ $program->image_url }}" alt="{{ $program->title }}" loading="lazy"
                         class="aspect-[4/3] w-full rounded-2xl object-cover shadow-card ring-1 ring-slate-900/5">
                @endif

                @if ($program->category)
                    <p class="mt-5">
                        <span class="badge badge-info">{{ $program->category }}</span>
                    </p>
                @endif
            </div>

            <div class="lg:col-span-7" data-reveal="left">
                <h1 class="font-display text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                    {{ $program->title }}
                </h1>

                @if ($program->summary)
                    <p class="mt-4 text-lg leading-relaxed text-slate-600">{{ $program->summary }}</p>
                @endif

                <div class="prose-body mt-8 text-slate-700">
                    @forelse ($program->sections ?? [] as $section)
                        @if (($section['type'] ?? null) === 'heading')
                            <h2 class="font-display text-xl font-bold text-slate-900">{{ $section['text'] ?? '' }}</h2>
                        @elseif (($section['type'] ?? null) === 'paragraph')
                            <p>{{ $section['text'] ?? '' }}</p>
                        @elseif (($section['type'] ?? null) === 'list')
                            <ol>
                                @foreach ($section['items'] ?? [] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ol>
                        @endif
                    @empty
                        <p>{{ $program->summary }}</p>
                    @endforelse
                </div>

                <a href="{{ route('program-keahlian.index') }}" class="link-inline mt-10 inline-flex items-center gap-1.5 text-sm">
                    <span aria-hidden="true">&larr;</span>
                    Kembali ke daftar program keahlian
                </a>
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <section class="border-t border-slate-200/80 bg-surface">
            <div class="container-page py-12 lg:py-16">
                <h2 class="font-display text-2xl font-bold tracking-tight text-slate-900">Program Keahlian Lainnya</h2>

                <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $item)
                        <a href="{{ route('program-keahlian.show', $item) }}"
                           class="group flex flex-col gap-2 rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover">
                            @if ($item->category)
                                <span class="text-xs font-semibold uppercase tracking-wide text-brand-sky">{{ $item->category }}</span>
                            @endif
                            <h3 class="font-display font-bold leading-snug text-slate-900 transition-colors group-hover:text-brand-navy">{{ $item->title }}</h3>
                            @if ($item->summary)
                                <p class="line-clamp-2 text-sm leading-relaxed text-slate-600">{{ $item->summary }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
