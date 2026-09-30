@extends('layouts.app')

@php
    $seoTitle = 'Visi & Misi';
    $seoDescription = 'Visi dan misi '.\App\Support\Site::name().' dalam mencetak generasi unggul dan kompeten.';
@endphp

@section('content')
    <x-page-title text="Visi & Misi"
                  :description="'Arah dan komitmen '.\App\Support\Site::name().' dalam menyelenggarakan pendidikan vokasional.'" />

    <div class="container-page max-w-4xl py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Visi & Misi']]" />

        <div class="mt-10 space-y-6">
            <section class="rounded-2xl bg-brand-teal p-7 text-white shadow-panel sm:p-9" data-reveal="up">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">Visi</p>
                <p class="mt-4 font-display text-xl font-medium leading-relaxed sm:text-2xl">
                    {{ $visi ? implode(' ', $visi) : 'Terwujudnya sekolah berkualitas, berkarakter dan berwawasan lingkungan' }}
                </p>
            </section>

            <section class="card p-7 sm:p-9" data-reveal="up" data-reveal-delay="100">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-sky">Misi</p>

                @if ($misi)
                    <ol class="mt-5 space-y-4">
                        @foreach ($misi as $point)
                            <li class="flex gap-4">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 font-display text-xs font-bold text-brand-navy">
                                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <p class="pt-0.5 leading-relaxed text-slate-700">{{ $point }}</p>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </section>
        </div>
    </div>
@endsection
