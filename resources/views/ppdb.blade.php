@extends('layouts.app')

@php
    use App\Support\Site;

    $seoTitle = 'PPDB '.Site::shortName();
    $seoDescription = 'Informasi Pendaftaran Peserta Didik Baru (PPDB) '.Site::name().': alur pendaftaran, persyaratan, dan jadwal seleksi.';
@endphp

@section('content')
    <section class="relative overflow-hidden bg-brand-teal text-white">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(60%_70%_at_85%_0%,rgba(11,76,240,0.45),transparent_65%)]" aria-hidden="true"></div>

        <div class="container-page relative py-14 text-center lg:py-20">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300" data-reveal="up">Penerimaan Peserta Didik Baru</p>

            <h1 class="mx-auto mt-4 max-w-3xl font-display text-3xl font-bold leading-tight tracking-tight sm:text-4xl lg:text-5xl" data-reveal="up" data-reveal-delay="100">
                Bergabung dengan {{ Site::name() }}
            </h1>

            <p class="mx-auto mt-5 max-w-2xl leading-relaxed text-slate-200" data-reveal="up" data-reveal-delay="150">
                Temukan jadwal, persyaratan, dan langkah pendaftaran. Siapkan berkasmu dan mulai perjalanan menuju karier profesional.
            </p>

            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row" data-reveal="up" data-reveal-delay="200">
                <x-button :href="$spmbUrl" target="_blank" size="lg" class="w-full sm:w-auto">
                    Daftar via Web SPMB
                    <span aria-hidden="true">&nearr;</span>
                </x-button>
                <x-button :href="$downloadUrl" target="_blank" variant="outline" size="lg"
                          class="w-full border-white/25 bg-white/10 text-white hover:border-white hover:text-white hover:bg-white/20 sm:w-auto">
                    Unduh Berkas
                </x-button>
            </div>
        </div>
    </section>

    <section class="container-page py-14 lg:py-20">
        <div class="mx-auto max-w-2xl text-center" data-reveal="up">
            <p class="eyebrow">Langkah Pendaftaran</p>
            <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Alur Pendaftaran Siswa Baru</h2>
        </div>

        <div class="relative mx-auto mt-12 max-w-4xl">
            <div class="absolute left-[19px] top-2 h-[calc(100%-1rem)] w-px bg-slate-200 md:left-1/2 md:-translate-x-1/2" aria-hidden="true"></div>

            <ol class="relative space-y-8 md:space-y-12">
                @foreach ($steps as $step)
                    @php $isTextRight = $loop->index % 2 === 0; @endphp

                    <li class="relative flex items-start gap-6 md:grid md:grid-cols-2 md:items-center md:gap-12" data-reveal="up">
                        <span class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-sky font-display text-sm font-bold text-white ring-4 ring-white md:absolute md:left-1/2 md:-translate-x-1/2"
                              aria-hidden="true">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div @class([
                            'min-w-0 flex-1 md:col-start-1 md:row-start-1',
                            'md:text-right' => $isTextRight,
                        ])>
                            <x-ppdb-step-card :step="$step" :number="$loop->iteration" :align="$isTextRight ? 'md:text-right' : 'md:text-left'" />
                        </div>

                        <div @class([
                            'hidden md:col-start-2 md:row-start-1 md:flex md:items-center',
                            'md:justify-start' => $isTextRight,
                            'md:col-start-1 md:justify-end' => ! $isTextRight,
                        ])>
                            <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-surface-muted text-brand-sky ring-1 ring-slate-900/5">
                                <x-ppdb-step-icon :icon="$step->icon" />
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="border-t border-slate-200/80 bg-surface">
        <div class="container-page py-14 lg:py-20">
            <div class="mx-auto max-w-2xl text-center" data-reveal="up">
                <p class="eyebrow">Jurusan</p>
                <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Program Keahlian</h2>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($programs as $program)
                    <article class="flex flex-col rounded-2xl bg-white p-6 shadow-card ring-1 ring-slate-900/5 transition-shadow duration-300 hover:shadow-card-hover"
                             data-reveal="up" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                        @if ($program->category)
                            <span class="badge badge-info mb-4 self-start">{{ $program->category }}</span>
                        @endif

                        <h3 class="font-display text-base font-bold leading-snug text-slate-900">{{ $program->title }}</h3>

                        <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $program->description }}</p>

                        @if ($program->programKeahlian)
                            <a href="{{ route('program-keahlian.show', $program->programKeahlian) }}"
                               class="link-inline mt-5 inline-flex w-fit items-center gap-1.5 text-sm">
                                Lihat detail
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
