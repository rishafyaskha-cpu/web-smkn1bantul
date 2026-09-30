@extends('layouts.app')

@php
    use App\Support\Site;

    $heroSlots = $heroImages->take(3);
@endphp

@php
    $seoTitle = null;
    $seoDescription = \App\Support\Site::get('seo.home_description', 'Selamat datang di website resmi SMK Negeri 1 Bantul, Yogyakarta. Informasi program keahlian, berita, prestasi, dan pendaftaran siswa baru.');
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-surface">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(60%_60%_at_15%_0%,rgba(11,76,240,0.10),transparent_60%),radial-gradient(50%_50%_at_100%_20%,rgba(0,147,221,0.10),transparent_60%)]" aria-hidden="true"></div>

        <div class="container-page relative">
            <div class="grid items-center gap-12 py-14 lg:grid-cols-2 lg:gap-16 lg:py-20">
                <div class="max-w-xl" data-reveal="right">
                    <p class="eyebrow">Halo sobat skansaba!</p>

                    <h1 class="mt-4 font-display text-4xl font-bold leading-[1.1] tracking-tight text-slate-900 sm:text-5xl lg:text-[3.4rem]">
                        Selamat Datang di
                        <span class="mt-2 block text-brand-sky">{{ Site::name() }}</span>
                    </h1>

                    <p class="mt-6 text-base leading-relaxed text-slate-600 sm:text-lg">
                        {{ \App\Support\Site::get('school.tagline', 'Membangun wajah sekolah yang dulu kusam jadi terang dan transparan dengan teknologi dan estetika.') }}
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-3" data-reveal="up" data-reveal-delay="150">
                        <x-button :href="route('ppdb')" variant="primary" size="lg">
                            Informasi PPDB
                            <span aria-hidden="true">&rarr;</span>
                        </x-button>
                        <x-button :href="Site::mapsUrl()" target="_blank" variant="outline" size="lg">
                            Kunjungi Sekolah
                        </x-button>
                    </div>

                    <dl class="mt-10 grid max-w-sm grid-cols-2 gap-6 border-t border-slate-200 pt-6">
                        <div>
                            <dt class="text-xs font-medium text-slate-500">Berdiri Sejak</dt>
                            <dd class="mt-1 font-display text-xl font-bold text-slate-900">1968</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-slate-500">Program Keahlian</dt>
                            <dd class="mt-1 font-display text-xl font-bold text-slate-900">{{ $programs->count() }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:gap-4" data-reveal="zoom">
                    @php
                        $slots = [
                            ['class' => 'col-span-2 aspect-[16/10]', 'delay' => 0],
                            ['class' => 'aspect-square', 'delay' => 100],
                            ['class' => 'aspect-square', 'delay' => 200],
                        ];
                    @endphp

                    @foreach ($slots as $i => $slot)
                        @php $image = $heroSlots[$i] ?? null; @endphp
                        <div @class(['group overflow-hidden rounded-2xl shadow-card ring-1 ring-slate-900/5', $slot['class']])
                             data-reveal="zoom" data-reveal-delay="{{ $slot['delay'] }}">
                            <img src="{{ $image?->image_url ?: Site::heroImage() }}"
                                 alt="{{ $image?->alt ?: 'Kegiatan '.Site::name() }}"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]"
                                 loading="{{ $i === 0 ? 'eager' : 'lazy' }}" width="800" height="500">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Statistics --}}
    <x-statistics :items="$statistics" />

    {{-- Mission --}}
    <section class="section">
        <div class="container-page">
            <div class="mx-auto max-w-3xl text-center" data-reveal="up">
                <p class="eyebrow">Arah Pendidikan</p>
                <h2 class="mt-4 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    {{ \App\Support\Site::get('home.mission_heading', 'Menumbuhkan Harapan, Menempa Masa Depan') }}
                </h2>
                <p class="mt-5 text-base leading-relaxed text-slate-600 sm:text-lg">
                    {{ \App\Support\Site::get('home.mission_text', 'Di sekolah ini, setiap siswa adalah harapan, setiap guru adalah cahaya, setiap jurusan adalah jalan masa depan, dan setiap ruang belajar adalah jembatan menuju dunia nyata.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- History --}}
    <section class="border-y border-slate-200/80 bg-surface">
        <div class="container-page section">
            <div class="grid gap-10 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-5" data-reveal="right">
                    <p class="eyebrow">Tentang Kami</p>
                    <h2 class="mt-4 font-display text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                        {{ \App\Support\Site::get('home.history_heading', 'Perjalanan Panjang SMK Negeri 1 Bantul dalam Membangun') }}
                        <span class="mt-2 block text-brand-navy">Masa Depan</span>
                    </h2>
                </div>

                <div class="lg:col-span-7" data-reveal="left" data-reveal-delay="150">
                    <p class="text-base leading-relaxed text-slate-600 sm:text-lg">
                        {{ \App\Support\Site::get('home.history_excerpt', 'SMK Negeri 1 Bantul memiliki perjalanan sejarah panjang yang penuh dengan komitmen terhadap pendidikan berkualitas.') }}
                    </p>
                    <a href="{{ route('sejarah') }}" class="link-inline mt-5 inline-flex items-center gap-1.5 text-sm">
                        Baca selengkapnya
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-principal :name="$principal['name']" :image="$principal['photo']" />

    <x-news-feed :articles="$articles" />

    <x-achievements :items="$achievements" />

    <x-partners />

    <x-location />
@endsection
