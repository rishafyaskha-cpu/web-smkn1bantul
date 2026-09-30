@extends('layouts.app')

@php
    $seoTitle = 'Organisasi Siswa';
    $seoDescription = 'Organisasi siswa di '.\App\Support\Site::name().' seperti OSIS, MPK, Rohis, PKS, PMR, dan lainnya.';
@endphp

@section('content')
    <x-page-title text="Organisasi Siswa"
                  :description="'Organisasi dan kepemimpinan siswa di '.\App\Support\Site::name().'.'" />

    <div class="container-page max-w-5xl space-y-10 py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Organisasi Siswa']]" />

        <x-gallery-carousel group="organisasi" :interval="2000" alt-prefix="Organisasi" />

        <x-data-table :headers="['No', 'Nama Organisasi']" :rows="$rows" />
    </div>
@endsection
