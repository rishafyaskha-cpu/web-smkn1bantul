@extends('layouts.app')

@php
    $seoTitle = 'Struktur Organisasi';
    $seoDescription = 'Struktur organisasi dan tata kelola '.\App\Support\Site::name().'.';
@endphp

@section('content')
    <x-page-title text="Struktur Organisasi"
                  :description="'Susunan kepengurusan dan tata kelola '.\App\Support\Site::name().'.'" />

    <div class="container-page max-w-5xl py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Struktur Organisasi']]" />

        <figure class="mt-10" data-reveal="zoom">
            <div class="overflow-hidden rounded-2xl bg-surface-muted p-2 shadow-card ring-1 ring-slate-900/5 sm:p-4">
                <img src="{{ $image }}" alt="Struktur organisasi {{ \App\Support\Site::name() }}" loading="lazy"
                     class="w-full rounded-xl bg-white">
            </div>
            <figcaption class="mt-4 text-center text-sm text-slate-500">
                Struktur organisasi {{ \App\Support\Site::name() }}
            </figcaption>
        </figure>
    </div>
@endsection
