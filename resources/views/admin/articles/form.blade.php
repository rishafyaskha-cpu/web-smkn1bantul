@extends('layouts.admin')

@php
    $isEdit = $article->exists;
    $seoTitle = $isEdit ? 'Ubah Berita' : 'Tulis Berita';
@endphp

@section('content')
    <header class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-brand-sky transition-colors hover:text-brand-navy">
            <span aria-hidden="true">&larr;</span>
            Kembali ke daftar berita
        </a>
        <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900">{{ $isEdit ? 'Ubah Berita' : 'Tulis Berita' }}</h1>
    </header>

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
            <p class="font-semibold">Periksa kembali isian berikut:</p>
            <ul class="mt-1.5 list-inside list-disc space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $isEdit ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
          class="max-w-3xl space-y-6 rounded-xl border border-slate-200 bg-white p-6 shadow-card sm:p-7">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div>
            <label for="title" class="label">Judul <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}" class="input">
        </div>

        <div>
            <label for="slug" class="label">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug) }}"
                   placeholder="otomatis dari judul jika dikosongkan" class="input">
        </div>

        <div>
            <label for="excerpt" class="label">Ringkasan</label>
            <textarea name="excerpt" id="excerpt" rows="3" class="input">{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        <div>
            <label for="body" class="label">Isi Berita</label>
            <textarea name="body" id="body" rows="12" class="input">{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="image" class="label">Gambar</label>
                <input type="text" name="image" id="image" value="{{ old('image', $article->image) }}"
                       placeholder="images/berita.jpg" class="input">
            </div>

            <div>
                <label for="author" class="label">Penulis</label>
                <input type="text" name="author" id="author" value="{{ old('author', $article->author) }}" class="input">
            </div>

            <div>
                <label for="source" class="label">Sumber</label>
                <input type="text" name="source" id="source" value="{{ old('source', $article->source) }}" class="input">
            </div>

            <div>
                <label for="external_url" class="label">URL Sumber Asli</label>
                <input type="url" name="external_url" id="external_url" value="{{ old('external_url', $article->external_url) }}"
                       placeholder="https://" class="input">
            </div>

            <div>
                <label for="published_at" class="label">Tanggal Terbit <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="published_at" id="published_at" required
                       value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}" class="input">
            </div>
        </div>

        <label class="flex items-center gap-2.5 text-sm text-slate-700">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $article->is_published))
                   class="h-4 w-4 rounded border-slate-300 text-brand-sky focus:ring-brand-sky">
            Terbitkan berita ini
        </label>

        <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
            <x-button type="submit" variant="primary">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Berita' }}
            </x-button>
            <a href="{{ route('admin.articles.index') }}" class="text-sm font-medium text-slate-500 transition-colors hover:text-slate-700">Batal</a>
        </div>
    </form>
@endsection
