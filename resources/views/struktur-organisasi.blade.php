@extends('layouts.app')

@php
    $seoTitle = 'Struktur Organisasi';
    $seoDescription = 'Struktur organisasi dan tata kelola '.\App\Support\Site::name().'.';
@endphp

@section('content')
    <div class="min-h-screen bg-white">
        <x-page-title text="Struktur Organisasi" />

        <main class="py-10 lg:py-16 px-6 sm:px-10 lg:px-16 max-w-6xl mx-auto">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Struktur Organisasi']]" class="mb-8" />

            <figure class="flex flex-col gap-4" data-reveal="zoom">
                <img src="{{ $image }}" alt="Struktur organisasi {{ \App\Support\Site::name() }}" loading="lazy"
                     class="w-full h-auto shadow-md">
                <figcaption class="text-sm text-gray-500 text-center">
                    Struktur organisasi {{ \App\Support\Site::name() }}
                </figcaption>
            </figure>
        </main>
    </div>
@endsection
