@extends('layouts.app')

@php
    $seoTitle = 'Ekstrakurikuler';
    $seoDescription = 'Daftar kegiatan ekstrakurikuler di '.\App\Support\Site::name().' untuk mengembangkan bakat dan minat siswa.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-page-title text="Ekstrakurikuler" />

        <main class="py-10 lg:py-16 px-4 sm:px-8 lg:px-12">
            <div class="max-w-5xl mx-auto space-y-6 sm:space-y-8 lg:space-y-12">
                <x-breadcrumbs :breadcrumbs="[['label' => 'Ekstrakurikuler']]" />

                <x-gallery-carousel group="ekstrakurikuler" :interval="3000" alt-prefix="Ekstrakurikuler" />

                <x-data-table :headers="['No', 'Nama Ekstrakurikuler']" :rows="$rows" />
            </div>
        </main>
    </div>
@endsection
