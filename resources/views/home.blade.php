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
    <div class="box-border relative flex flex-col gap-16 lg:gap-0 lg:flex-row items-center lg:justify-between px-4 sm:px-10 lg:px-14 lg:py-18">
        <svg width="200" height="40" class="absolute top-1/20 hidden xl:stroke-3 lg:stroke-2 lg:block" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <line x1="10" y1="20" x2="120" y2="20" stroke="black" stroke-linecap="round" />
            <line x1="140" y1="20" x2="180" y2="20" stroke="black" stroke-linecap="round" />
        </svg>

        <div class="w-full lg:w-1/2 font-poppins flex flex-col items-center lg:items-start content-center gap-4 md:gap-8">
            <div class="w-full flex flex-col gap-3 text-3xl sm:text-4xl lg:text-4xl xl:text-5xl 2xl:text-6xl" data-reveal="right">
                <h2 class="font-medium text-center lg:text-start">Selamat Datang di</h2>
                <h2 class="lg:w-fit mx-auto lg:mx-0 text-center text-white font-semibold py-2 px-1 md:py-4 md:px-2 rounded-lg bg-brand-sky">{{ Site::name() }}</h2>
            </div>
            <p class="text-sm sm:text-xl lg:text-xl text-center lg:text-start text-neutral-500" data-reveal="right" data-reveal-delay="100">
                {{ \App\Support\Site::get('school.tagline', 'Membangun wajah sekolah yang dulu kusam jadi terang dan transparan dengan teknologi dan estetika.') }}
            </p>
            <div data-reveal="right" data-reveal-delay="200">
                <x-button :href="Site::mapsUrl()" target="_blank">Kunjungi</x-button>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 auto-rows-[18vh] sm:auto-rows-[24vh] md:auto-rows-[30vh] lg:auto-rows-[14vh]">
            @foreach ([0, 1, 2] as $i)
                @php $image = $heroSlots[$i] ?? null; @endphp
                <div @class([
                    'overflow-hidden rounded-2xl row-span-1',
                    'row-span-2 lg:row-span-3 xl:row-start-2' => $i === 0,
                    'lg:row-span-2 xl:row-span-3' => $i === 1,
                    'xl:row-span-2' => $i === 2,
                ]) data-reveal="zoom" data-reveal-delay="{{ $i * 150 }}">
                    <img src="{{ $image?->image_url ?: Site::heroImage() }}" alt="{{ $image?->alt ?: 'Kegiatan sekolah' }}"
                         class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="{{ $i === 0 ? 'eager' : 'lazy' }}" width="600" height="400">
                </div>
            @endforeach
        </div>
    </div>

    <div class="relative mx-auto px-4 lg:px-20 py-44 mt-55 lg:mt-14 bg-neutral-semiblue z-10">
        <x-statistics :items="$statistics" class="absolute right-1/2 -top-14 transform translate-x-1/2" data-reveal="zoom" />

        <div class="max-w-3xl flex flex-col gap-8 text-center mx-auto mb-44">
            <h2 class="font-metropolis text-3xl md:text-4xl font-bold text-gray-900 mb-3" data-reveal="up">
                {{ \App\Support\Site::get('home.mission_heading', 'Menumbuhkan Harapan, Menempa Masa Depan') }}
            </h2>
            <p class="text-gray-600 font-tt-norms text-md md:text-lg leading-relaxed" data-reveal="up" data-reveal-delay="150">
                {{ \App\Support\Site::get('home.mission_text', 'Di sekolah ini, setiap siswa adalah harapan, setiap guru adalah cahaya, setiap jurusan adalah jalan masa depan, dan setiap ruang belajar adalah jembatan menuju dunia nyata.') }}
            </p>
        </div>
        <div class="h-[3px] bg-black rounded-b-3xl"></div>
    </div>

    <div class="flex flex-col md:flex-row justify-between px-8 md:px-20 bg-neutral-semiblue pb-44">
        <h2 class="font-metropolis font-semibold text-3xl text-center md:text-right lg:text-6xl mb-20 w-full md:w-[35%] text-brand-navy" data-reveal="right">
            {{ \App\Support\Site::get('home.history_heading', 'Perjalanan Panjang SMK Negeri 1 Bantul dalam Membangun') }}
            <br />
            <span class="text-white bg-brand-navy rounded-xl px-3">Masa Depan</span>
        </h2>
        <div class="w-full md:w-[43%] text-lg md:text-[20px] mr-5 font-tt-norms" data-reveal="left" data-reveal-delay="150">
            <p class="leading-relaxed font-normal">
                {{ \App\Support\Site::get('home.history_excerpt', 'SMK Negeri 1 Bantul memiliki perjalanan sejarah panjang yang penuh dengan komitmen terhadap pendidikan berkualitas.') }}
            </p>
            <a href="{{ route('sejarah') }}" class="underline text-[16px] hover:text-brand-sky transition-colors">Baca selengkapnya</a>
        </div>
    </div>

    <x-principal :name="$principal['name']" :image="$principal['photo']" />

    <x-news-feed :articles="$articles" />

    <x-achievements :items="$achievements" />

    <x-partners />

    <x-location />
@endsection
