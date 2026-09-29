@extends('layouts.admin')

@php
    $isEdit = $article->exists;
    $seoTitle = $isEdit ? 'Ubah Berita' : 'Tulis Berita';
@endphp

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="text-sm text-brand-sky hover:underline">&larr; Kembali ke daftar berita</a>
        <h1 class="mt-2 text-2xl font-bold text-gray-900">{{ $isEdit ? 'Ubah Berita' : 'Tulis Berita' }}</h1>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
            <p class="font-medium">Periksa kembali isian berikut:</p>
            <ul class="mt-1 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $isEdit ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
          class="max-w-3xl space-y-6 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div>
            <label for="title" class="mb-1.5 block text-sm font-medium text-gray-700">Judul <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
        </div>

        <div>
            <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug) }}"
                   placeholder="otomatis dari judul jika dikosongkan"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
        </div>

        <div>
            <label for="excerpt" class="mb-1.5 block text-sm font-medium text-gray-700">Ringkasan</label>
            <textarea name="excerpt" id="excerpt" rows="3"
                      class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        <div>
            <label for="body" class="mb-1.5 block text-sm font-medium text-gray-700">Isi Berita</label>
            <textarea name="body" id="body" rows="12"
                      class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="image" class="mb-1.5 block text-sm font-medium text-gray-700">Gambar</label>
                <input type="text" name="image" id="image" value="{{ old('image', $article->image) }}"
                       placeholder="images/berita.jpg"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="author" class="mb-1.5 block text-sm font-medium text-gray-700">Penulis</label>
                <input type="text" name="author" id="author" value="{{ old('author', $article->author) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="source" class="mb-1.5 block text-sm font-medium text-gray-700">Sumber</label>
                <input type="text" name="source" id="source" value="{{ old('source', $article->source) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="external_url" class="mb-1.5 block text-sm font-medium text-gray-700">URL Sumber Asli</label>
                <input type="url" name="external_url" id="external_url" value="{{ old('external_url', $article->external_url) }}"
                       placeholder="https://"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="published_at" class="mb-1.5 block text-sm font-medium text-gray-700">Tanggal Terbit <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="published_at" id="published_at" required
                       value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $article->is_published))
                   class="rounded border-gray-300 text-brand-sky focus:ring-brand-sky">
            Terbitkan berita ini
        </label>

        <div class="flex items-center gap-3 border-t border-gray-100 pt-6">
            <button type="submit"
                    class="rounded-lg bg-brand-sky px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Berita' }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="text-sm text-gray-500 hover:underline">Batal</a>
        </div>
    </form>
@endsection
