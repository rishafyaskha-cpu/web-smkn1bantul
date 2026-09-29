@extends('layouts.admin')

@php
    $seoTitle = 'Dashboard';
@endphp

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500">Ringkasan konten situs {{ \App\Support\Site::shortName() }}.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-gray-500">Total Berita</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $articleCount }}</p>
        </div>
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-gray-500">Berita Terbit</p>
            <p class="mt-1 text-3xl font-bold text-green-600">{{ $publishedArticleCount }}</p>
        </div>
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-gray-500">Total Prestasi</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $achievementCount }}</p>
        </div>
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-gray-500">Prestasi Terbit</p>
            <p class="mt-1 text-3xl font-bold text-green-600">{{ $publishedAchievementCount }}</p>
        </div>
    </div>

    <div class="mt-8 rounded-xl bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
            <h2 class="font-semibold text-gray-900">Berita Terbaru</h2>
            <a href="{{ route('admin.articles.index') }}" class="text-sm text-brand-sky hover:underline">Kelola berita &rarr;</a>
        </div>

        @forelse ($latestArticles as $article)
            <div class="flex items-center justify-between gap-4 border-b border-gray-50 px-5 py-3 last:border-b-0">
                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-gray-900">{{ $article->title }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $article->formatted_date }}
                        @unless ($article->is_published)
                            &middot; <span class="text-amber-600">Draf</span>
                        @endunless
                    </p>
                </div>
                <a href="{{ route('admin.articles.edit', $article) }}"
                   class="shrink-0 text-sm text-brand-sky hover:underline">Ubah</a>
            </div>
        @empty
            <p class="px-5 py-8 text-center text-sm text-gray-500">Belum ada berita.</p>
        @endforelse
    </div>

    <div class="mt-8 flex flex-wrap gap-3">
        <x-button :href="route('admin.articles.create')" variant="primary">Tulis Berita</x-button>
        <x-button :href="route('admin.achievements.create')">Tambah Prestasi</x-button>
    </div>
@endsection
