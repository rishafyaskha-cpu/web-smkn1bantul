@extends('layouts.app')

@php
    $seoTitle = 'Prestasi Siswa';
    $seoDescription = 'Daftar prestasi siswa dan siswi '.\App\Support\Site::name().' di berbagai lomba tingkat sekolah, provinsi, hingga nasional.';
@endphp

@section('content')
    <x-page-title text="Prestasi Siswa"
                  :description="'Pencapaian siswa dan siswi '.\App\Support\Site::name().' di berbagai kompetisi tingkat kabupaten, provinsi, hingga nasional.'" />

    <div class="container-page py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Prestasi']]" />

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($achievements as $item)
                <x-prestasi-card :item="$item" data-reveal="up" data-reveal-delay="{{ ($loop->index % 4) * 100 }}" />
            @empty
                <p class="col-span-full py-20 text-center text-slate-500">Belum ada data prestasi.</p>
            @endforelse
        </div>

        @if ($achievements->hasPages())
            <div class="mt-12">{{ $achievements->links() }}</div>
        @endif
    </div>
@endsection
