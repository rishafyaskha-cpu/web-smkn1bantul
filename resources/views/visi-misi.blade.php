@extends('layouts.app')

@php
    $seoTitle = 'Visi & Misi';
    $seoDescription = 'Visi dan misi '.\App\Support\Site::name().' dalam mencetak generasi unggul dan kompeten.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <main class="py-10 lg:py-16 px-6 sm:px-10 lg:px-16 max-w-5xl mx-auto">
            <div class="text-center space-y-4 mb-12">
                <p class="text-gray-400 text-xl" data-reveal="up">Visi &amp; Misi</p>
                <h1 class="text-5xl lg:text-6xl font-bold text-blue-900" data-reveal="up" data-reveal-delay="100">SMKN 1 Bantul</h1>
            </div>

            <x-breadcrumbs :breadcrumbs="[['label' => 'Visi & Misi']]" class="mb-10" />

            <div class="space-y-10 w-full">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl shadow-md p-8" data-reveal="right">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 flex items-center gap-4">
                        <span class="w-12 h-[2px] bg-gray-400"></span>
                        Visi
                        <span class="w-12 h-[2px] bg-gray-400"></span>
                    </h2>
                    @if ($visi)
                        <p class="text-lg text-gray-700 leading-relaxed">{{ implode(' ', $visi) }}</p>
                    @else
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Terwujudnya sekolah berkualitas, berkarakter dan berwawasan lingkungan
                        </p>
                    @endif
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-gray-50 rounded-2xl shadow-md p-8" data-reveal="left" data-reveal-delay="150">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-4">
                        <span class="w-12 h-[2px] bg-gray-400"></span>
                        Misi
                        <span class="w-12 h-[2px] bg-gray-400"></span>
                    </h2>

                    @if ($misi)
                        <ul class="space-y-4 text-gray-800 text-base leading-relaxed list-disc list-inside">
                            @foreach ($misi as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
