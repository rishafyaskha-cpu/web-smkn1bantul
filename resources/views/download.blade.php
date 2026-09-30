@extends('layouts.app')

@php
    $seoTitle = 'Download';
    $seoDescription = 'Unduh berkas dan dokumen resmi '.\App\Support\Site::name().' seperti akreditasi, surat edaran, dan informasi SNBP.';
@endphp

@section('content')
    <x-page-title text="Download"
                  :description="'Berkas dan dokumen resmi '.\App\Support\Site::name().' yang dapat diunduh publik.'" />

    <div class="container-page max-w-5xl space-y-10 py-10 lg:py-14">
        <x-breadcrumbs :breadcrumbs="[['label' => 'Download']]" />

        @if ($downloads->isEmpty())
            <p class="py-20 text-center text-slate-500">Belum ada berkas yang tersedia.</p>
        @else
            <div class="overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5" data-reveal="up">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-slate-200 bg-surface text-xs uppercase tracking-wide text-slate-600">
                            <tr>
                                <th scope="col" class="w-16 px-6 py-3.5 font-semibold">No</th>
                                <th scope="col" class="px-6 py-3.5 font-semibold">Berkas</th>
                                <th scope="col" class="w-36 px-6 py-3.5 font-semibold">Tanggal Upload</th>
                                <th scope="col" class="w-24 px-6 py-3.5 font-semibold">Ukuran</th>
                                <th scope="col" class="w-32 px-6 py-3.5 font-semibold">Unduh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($downloads as $download)
                                <tr class="transition-colors duration-150 hover:bg-surface">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $download->title }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $download->uploaded_at?->translatedFormat('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $download->formatted_size }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ $download->file_url }}" target="_blank" rel="noopener noreferrer"
                                           class="link-inline inline-flex items-center gap-1.5 font-semibold">
                                            Unduh
                                            <span aria-hidden="true">&darr;</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
