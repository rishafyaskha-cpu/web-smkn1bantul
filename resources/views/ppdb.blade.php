@extends('layouts.app')

@php
    use App\Support\Site;

    $seoTitle = 'PPDB '.\App\Support\Site::shortName();
    $seoDescription = 'Informasi Pendaftaran Peserta Didik Baru (PPDB) '.\App\Support\Site::name().': alur pendaftaran, persyaratan, dan jadwal seleksi.';
@endphp

@section('content')
    <div class="w-full bg-[#f4f7fb]">
        <main class="font-tt-norms">
            <section class="pt-24 md:pt-32 pb-12 md:pb-16 px-4 md:px-8 text-center max-w-4xl mx-auto">
                <h1 class="font-metropolis text-3xl md:text-4xl font-bold text-slate-800 mb-3 leading-tight" data-reveal="up">
                    PPDB {{ Site::name() }}
                </h1>
                <p class="text-slate-600 mb-8 text-base md:text-lg px-2" data-reveal="up" data-reveal-delay="100">
                    Cari tahu jadwal, persyaratan, dan cara mendaftar di {{ Site::name() }}.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4 px-4 sm:px-0" data-reveal="up" data-reveal-delay="200">
                    <a href="{{ $spmbUrl }}" target="_blank" rel="noopener noreferrer"
                       class="font-metropolis w-full sm:w-auto bg-brand-sky text-white px-8 py-3.5 rounded-md font-semibold hover:bg-blue-700 flex items-center justify-center gap-2 transition-colors">
                        Web SPMB
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ $downloadUrl }}" target="_blank" rel="noopener noreferrer"
                       class="font-metropolis w-full sm:w-auto bg-white text-brand-sky px-8 py-3.5 rounded-md font-semibold shadow hover:bg-gray-50 flex items-center justify-center transition-colors">
                        Unduh Berkas
                    </a>
                </div>
            </section>

            <div class="max-w-5xl mx-auto px-4 md:px-8 py-4">
                <div class="border-t border-gray-200"></div>
            </div>

            <section class="py-16 px-4 md:px-8 max-w-5xl mx-auto">
                <h2 class="font-metropolis text-3xl font-bold text-slate-800 text-center mb-3" data-reveal="up">Alur Pendaftaran Siswa Baru</h2>

                <div class="relative">
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-px bg-blue-200"></div>
                    <div class="md:hidden absolute left-9 top-0 h-full w-px bg-blue-200"></div>

                    <div class="space-y-12 md:space-y-0 relative">
                        @foreach ($steps as $step)
                            @php $isTextRight = $loop->index % 2 === 0; @endphp
                            <div class="relative flex flex-col md:flex-row items-center w-full md:h-48 mb-8 md:mb-0" data-reveal="up">
                                <div class="absolute left-9 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white font-bold text-sm z-10 border-4 border-[#f4f7fb]">
                                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                @if ($isTextRight)
                                    <div class="hidden md:flex w-1/2 pr-12 h-full items-center justify-end">
                                        <x-ppdb-step-card :step="$step" :number="$loop->iteration" align="text-right" />
                                    </div>
                                    <div class="hidden md:flex w-1/2 pl-12 h-full items-center justify-start">
                                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                                            <x-ppdb-step-icon :icon="$step->icon" />
                                        </div>
                                    </div>
                                @else
                                    <div class="hidden md:flex w-1/2 pr-12 h-full items-center justify-end">
                                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                                            <x-ppdb-step-icon :icon="$step->icon" />
                                        </div>
                                    </div>
                                    <div class="hidden md:flex w-1/2 pl-12 h-full items-center justify-start">
                                        <x-ppdb-step-card :step="$step" :number="$loop->iteration" />
                                    </div>
                                @endif

                                <div class="md:hidden flex w-full pl-16 pr-2 sm:pl-20 sm:pr-0">
                                    <x-ppdb-step-card :step="$step" :number="$loop->iteration" class="md:hidden" show-icon />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <div class="max-w-5xl mx-auto px-4 md:px-8 py-4">
                <div class="border-t border-gray-200"></div>
            </div>

            <section class="pb-20 pt-8 px-4 md:px-8 max-w-6xl mx-auto">
                <h2 class="font-metropolis text-3xl font-bold text-slate-800 text-center mb-12" data-reveal="up">Program Keahlian</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($programs as $program)
                        <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col border border-gray-50 hover:shadow-md transition-shadow" data-reveal="up" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                            <div class="mb-4">
                                <span class="font-metropolis bg-blue-50 text-brand-sky text-[11px] font-semibold px-3 py-1 rounded">
                                    {{ $program->category }}
                                </span>
                            </div>
                            <h3 class="font-metropolis text-base font-bold text-slate-800 mb-3 leading-tight min-h-[40px]">
                                {{ $program->title }}
                            </h3>
                            <p class="text-slate-600 text-sm mb-6 flex-grow leading-relaxed">{{ $program->description }}</p>

                            @if ($program->programKeahlian)
                                <a href="{{ route('program-keahlian.show', $program->programKeahlian) }}"
                                   class="font-metropolis w-full block text-center bg-slate-50 hover:bg-blue-50 hover:text-brand-sky text-slate-700 text-sm font-medium py-2.5 rounded transition-colors">
                                    Lihat Detail
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
@endsection
