@extends('layouts.app')

@php
    $seoTitle = 'Program Keahlian';
    $seoDescription = 'Daftar program keahlian yang tersedia di '.\App\Support\Site::name().'.';
@endphp

@section('content')
    <x-page-title text="Program Keahlian"
                  :description="'Pilih jurusan yang sesuai dengan minat dan bakatmu di '.\App\Support\Site::name().'.'" />

    <div class="container-page py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Program Keahlian']]" />

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($programs as $program)
                <a href="{{ route('program-keahlian.show', $program) }}"
                   data-reveal="up" data-reveal-delay="{{ ($loop->index % 3) * 100 }}"
                   class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover">
                    @if ($program->image_url)
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="{{ $program->image_url }}" alt="{{ $program->title }}" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]">
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col p-6">
                        @if ($program->category)
                            <span class="badge badge-info mb-3 self-start">{{ $program->category }}</span>
                        @endif

                        <h2 class="font-display text-lg font-bold leading-snug text-slate-900 transition-colors group-hover:text-brand-navy">
                            {{ $program->title }}
                        </h2>

                        @if ($program->summary)
                            <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $program->summary }}</p>
                        @endif

                        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-sky">
                            Lihat detail
                            <span class="transition-transform duration-200 group-hover:translate-x-0.5" aria-hidden="true">&rarr;</span>
                        </span>
                    </div>
                </a>
            @empty
                <p class="col-span-full py-20 text-center text-slate-500">Belum ada program keahlian.</p>
            @endforelse
        </div>
    </div>
@endsection
