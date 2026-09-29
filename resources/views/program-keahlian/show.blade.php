@extends('layouts.app')

@php
    $seoTitle = $program->title;
    $seoDescription = $program->summary ?: strip_tags(\Illuminate\Support\Str::limit(collect($program->sections ?? [])->pluck('text')->implode(' '), 200));
    $seoImage = $program->image_url;
@endphp

@section('content')
    <div class="min-h-screen w-full bg-gray-50">
        <x-page-title text="Program Keahlian" />

        <main class="w-full flex flex-col lg:flex-row gap-4 py-10 lg:py-16 px-6 lg:px-16">
            <div class="lg:w-1/3 w-full" data-reveal="right">
                @if ($program->image_url)
                    <img src="{{ $program->image_url }}" alt="{{ $program->title }}" loading="lazy"
                         class="rounded-lg shadow-md w-full object-cover">
                @endif
            </div>

            <div class="lg:w-2/3 w-full flex flex-col space-y-6" data-reveal="left">
                <h1 class="w-full px-2 py-1 text-xl uppercase font-semibold border-b-2 border-neutral-500">{{ $program->title }}</h1>

                <div class="px-2 space-y-4 prose-body font-tt-norms text-gray-700">
                    @forelse ($program->sections ?? [] as $section)
                        @if (($section['type'] ?? null) === 'heading')
                            <h2 class="font-semibold text-lg mt-4 mb-2 text-gray-900">{{ $section['text'] ?? '' }}</h2>
                        @elseif (($section['type'] ?? null) === 'paragraph')
                            <p class="text-gray-700 leading-relaxed mb-3">{{ $section['text'] ?? '' }}</p>
                        @elseif (($section['type'] ?? null) === 'list')
                            <ol class="list-decimal pl-6 text-gray-700 leading-relaxed">
                                @foreach ($section['items'] ?? [] as $item)
                                    <li class="mb-1">{{ $item }}</li>
                                @endforeach
                            </ol>
                        @endif
                    @empty
                        <p class="text-gray-700 leading-relaxed">{{ $program->summary }}</p>
                    @endforelse
                </div>
            </div>
        </main>

        @if ($related->isNotEmpty())
            <section class="w-full bg-neutral-semiblue py-12 lg:py-16 px-6 lg:px-16">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-2xl lg:text-3xl font-bold text-brand-teal mb-8">Program Keahlian Lainnya</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($related as $item)
                            <a href="{{ route('program-keahlian.show', $item) }}"
                               class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow p-6 flex flex-col gap-2">
                                @if ($item->category)
                                    <span class="text-[11px] font-semibold text-brand-sky uppercase">{{ $item->category }}</span>
                                @endif
                                <h3 class="font-bold text-gray-900">{{ $item->title }}</h3>
                                @if ($item->summary)
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $item->summary }}</p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
