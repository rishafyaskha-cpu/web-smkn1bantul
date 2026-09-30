@extends('layouts.admin')

@php
    $seoTitle = 'Dashboard';

    $stats = [
        ['label' => 'Total Berita', 'value' => $articleCount, 'tone' => 'text-slate-900'],
        ['label' => 'Berita Terbit', 'value' => $publishedArticleCount, 'tone' => 'text-emerald-600'],
        ['label' => 'Total Prestasi', 'value' => $achievementCount, 'tone' => 'text-slate-900'],
        ['label' => 'Prestasi Terbit', 'value' => $publishedAchievementCount, 'tone' => 'text-emerald-600'],
    ];
@endphp

@section('content')
    <header class="mb-8">
        <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900">Dashboard</h1>
        <p class="mt-1 text-sm text-slate-500">Ringkasan konten situs {{ \App\Support\Site::shortName() }}.</p>
    </header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-card">
                <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                <p class="mt-2 font-display text-3xl font-bold tracking-tight {{ $stat['tone'] }}">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <section class="mt-8 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-card">
        <header class="flex items-center justify-between gap-4 border-b border-slate-100 px-5 py-4">
            <h2 class="font-display font-bold text-slate-900">Berita Terbaru</h2>
            <a href="{{ route('admin.articles.index') }}" class="text-sm font-medium text-brand-sky transition-colors hover:text-brand-navy">Kelola berita &rarr;</a>
        </header>

        @forelse ($latestArticles as $article)
            <div class="flex items-center justify-between gap-4 border-b border-slate-50 px-5 py-3.5 last:border-b-0">
                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-slate-900">{{ $article->title }}</p>
                    <p class="mt-0.5 text-xs text-slate-500">
                        {{ $article->formatted_date }}
                        @unless ($article->is_published)
                            <span class="badge badge-warning ml-1">Draf</span>
                        @endunless
                    </p>
                </div>
                <a href="{{ route('admin.articles.edit', $article) }}"
                   class="shrink-0 text-sm font-medium text-brand-sky transition-colors hover:text-brand-navy">Ubah</a>
            </div>
        @empty
            <p class="px-5 py-12 text-center text-sm text-slate-500">Belum ada berita.</p>
        @endforelse
    </section>

    <div class="mt-8 flex flex-wrap gap-3">
        <x-button :href="route('admin.articles.create')" variant="primary">Tulis Berita</x-button>
        <x-button :href="route('admin.achievements.create')" variant="outline">Tambah Prestasi</x-button>
    </div>
@endsection
