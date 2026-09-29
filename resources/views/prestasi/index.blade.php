@extends('layouts.app')

@php
    $seoTitle = 'Prestasi Siswa';
    $seoDescription = 'Daftar prestasi siswa dan siswi '.\App\Support\Site::name().' di berbagai lomba tingkat sekolah, provinsi, hingga nasional.';
@endphp

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-page-title text="Prestasi Siswa dan Siswi" />

        <main class="py-10 lg:py-16 px-6 sm:px-10 lg:px-16 max-w-7xl mx-auto">
            <x-breadcrumbs :breadcrumbs="[['label' => 'Prestasi']]" class="mb-8" />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 justify-items-center">
                @forelse ($achievements as $item)
                    <x-prestasi-card :item="$item" class="w-full" data-reveal="up" data-reveal-delay="{{ ($loop->index % 5) * 100 }}" />
                @empty
                    <p class="col-span-full text-center text-gray-500 py-16">Belum ada data prestasi.</p>
                @endforelse
            </div>

            @if ($achievements->hasPages())
                <div class="mt-12">{{ $achievements->links() }}</div>
            @endif
        </main>
    </div>
@endsection
