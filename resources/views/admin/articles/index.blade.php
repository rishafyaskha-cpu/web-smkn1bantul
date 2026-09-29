@extends('layouts.admin')

@php
    $seoTitle = 'Kelola Berita';
@endphp

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Berita</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola berita dan informasi sekolah.</p>
        </div>
        <x-button :href="route('admin.articles.create')" variant="primary">Tulis Berita</x-button>
    </div>

    <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-4 flex max-w-md gap-2" role="search">
        <label for="q" class="sr-only">Cari berita</label>
        <input type="search" name="q" id="q" value="{{ $q }}" placeholder="Cari berita..."
               class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
        <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700">
            Cari
        </button>
    </form>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-600">
                    <tr>
                        <th scope="col" class="px-5 py-3 font-semibold">Judul</th>
                        <th scope="col" class="px-5 py-3 font-semibold">Tanggal</th>
                        <th scope="col" class="px-5 py-3 font-semibold">Status</th>
                        <th scope="col" class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($articles as $article)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <p class="font-medium text-gray-900">{{ $article->title }}</p>
                                @if ($article->author)
                                    <p class="text-xs text-gray-500">{{ $article->author }}</p>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-3 text-gray-600">{{ $article->formatted_date }}</td>
                            <td class="px-5 py-3">
                                @if ($article->is_published)
                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Terbit</span>
                                @else
                                    <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800">Draf</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-3 text-right">
                                <a href="{{ route('berita.show', $article) }}" target="_blank" rel="noopener"
                                   class="text-gray-500 hover:underline">Lihat</a>
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                   class="ml-3 text-brand-sky hover:underline">Ubah</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline"
                                      onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-3 text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-gray-500">
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
