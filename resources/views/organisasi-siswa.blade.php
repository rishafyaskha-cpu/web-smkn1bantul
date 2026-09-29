@extends('layouts.app')

@php
    $seoTitle = 'Organisasi Siswa';
    $seoDescription = 'Organisasi siswa di '.\App\Support\Site::name().' seperti OSIS, MPK, Rohis, PKS, PMR, dan lainnya.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-page-title text="Organisasi Siswa" />

        <main class="py-10 lg:py-16 px-4 sm:px-8 lg:px-12">
            <div class="max-w-5xl mx-auto space-y-6 sm:space-y-8 lg:space-y-12">
                <x-breadcrumbs :breadcrumbs="[['label' => 'Organisasi Siswa']]" />

                <x-gallery-carousel group="organisasi" :interval="2000" alt-prefix="Organisasi" />

                <x-data-table :headers="['No', 'Nama Organisasi']" :rows="$rows" />
            </div>
        </main>
    </div>
@endsection
