@extends('layouts.app')

@php
    $seoTitle = 'Ekstrakurikuler';
    $seoDescription = 'Daftar kegiatan ekstrakurikuler di '.\App\Support\Site::name().' untuk mengembangkan bakat dan minat siswa.';
@endphp

@section('content')
    <x-page-title text="Ekstrakurikuler"
                  :description="'Wadah pengembangan bakat, minat, dan karakter siswa di '.\App\Support\Site::name().'.'" />

    <div class="container-page max-w-5xl space-y-10 py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Ekstrakurikuler']]" />

        <x-gallery-carousel group="ekstrakurikuler" :interval="3000" alt-prefix="Ekstrakurikuler" />

        <x-data-table :headers="['No', 'Nama Ekstrakurikuler']" :rows="$rows" />
    </div>
@endsection
