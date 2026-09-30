@extends('layouts.admin')

@php
    $seoTitle = 'Kelola Berita';
@endphp

@section('content')
    <header class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900">Berita</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola berita dan informasi sekolah.</p>
        </div>
        <x-button :href="route('admin.articles.create')" variant="primary">Tulis Berita</x-button>
    </header>

    <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-6 flex max-w-md gap-2" role="search">
        <label for="q" class="sr-only">Cari berita</label>
        <input type="search" name="q" id="q" value="{{ $q }}" placeholder="Cari berita..." class="input">
        <x-button type="submit" variant="outline" class="shrink-0">Cari</x-button>
    </form>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-surface text-xs uppercase tracking-wide text-slate-600">
                    <tr>
                        <th scope="col" class="px-5 py-3.5 font-semibold">Judul</th>
                        <th scope="col" class="px-5 py-3.5 font-semibold">Tanggal</th>
                        <th scope="col" class="px-5 py-3.5 font-semibold">Status</th>
                        <th scope="col" class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($articles as $article)
                        <tr class="transition-colors hover:bg-surface">
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-900">{{ $article->title }}</p>
                                @if ($article->author)
                                    <p class="mt-0.5 text-xs text-slate-500">{{ $article->author }}</p>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $article->formatted_date }}</td>
                            <td class="px-5 py-4">
                                @if ($article->is_published)
                                    <span class="badge badge-success">Terbit</span>
                                @else
                                    <span class="badge badge-warning">Draf</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="{{ route('berita.show', $article) }}" target="_blank" rel="noopener"
                                   class="text-sm font-medium text-slate-500 transition-colors hover:text-brand-navy">Lihat</a>
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                   class="ml-4 text-sm font-medium text-brand-sky transition-colors hover:text-brand-navy">Ubah</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline"
                                      onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-4 text-sm font-medium text-red-600 transition-colors hover:text-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-slate-500">
                                {{ $q ? 'Tidak ada berita yang cocok.' : 'Belum ada berita.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($articles->hasPages())
        <div class="mt-6">{{ $articles->links() }}</div>
    @endif
@endsection
