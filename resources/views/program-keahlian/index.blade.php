@extends('layouts.app')

@php
    $seoTitle = 'Program Keahlian';
    $seoDescription = 'Daftar program keahlian yang tersedia di '.\App\Support\Site::name().'.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-page-title text="Program Keahlian" />

        <main class="py-10 lg:py-16 px-6 sm:px-10 lg:px-16 max-w-7xl mx-auto">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Program Keahlian']]" class="mb-8" />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($programs as $program)
                    <a href="{{ route('program-keahlian.show', $program) }}"
                       data-reveal="up" data-reveal-delay="{{ ($loop->index % 3) * 100 }}"
                       class="group flex flex-col bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        @if ($program->image_url)
                            <img src="{{ $program->image_url }}" alt="{{ $program->title }}" loading="lazy"
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            @if ($program->category)
                                <span class="inline-block bg-blue-50 text-brand-sky text-[11px] font-semibold px-3 py-1 rounded mb-3">
                                    {{ $program->category }}
                                </span>
                            @endif
                            <h2 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-brand-navy">{{ $program->title }}</h2>
                            @if ($program->summary)
                                <p class="text-sm text-gray-600 line-clamp-3">{{ $program->summary }}</p>
                            @endif
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">Belum ada program keahlian.</p>
                @endforelse
            </div>
        </main>
    </div>
@endsection
