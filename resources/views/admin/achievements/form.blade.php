@extends('layouts.admin')

@php
    $isEdit = $achievement->exists;
    $seoTitle = $isEdit ? 'Ubah Prestasi' : 'Tambah Prestasi';
@endphp

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.achievements.index') }}" class="text-sm text-brand-sky hover:underline">&larr; Kembali ke daftar prestasi</a>
        <h1 class="mt-2 text-2xl font-bold text-gray-900">{{ $isEdit ? 'Ubah Prestasi' : 'Tambah Prestasi' }}</h1>
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
          action="{{ $isEdit ? route('admin.achievements.update', $achievement) : route('admin.achievements.store') }}"
          class="max-w-3xl space-y-6 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div>
            <label for="title" class="mb-1.5 block text-sm font-medium text-gray-700">Judul Prestasi <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" required value="{{ old('title', $achievement->title) }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="student_name" class="mb-1.5 block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="student_name" id="student_name" value="{{ old('student_name', $achievement->student_name) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="class_name" class="mb-1.5 block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="class_name" id="class_name" value="{{ old('class_name', $achievement->class_name) }}"
                       placeholder="XII RPL 1"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="level" class="mb-1.5 block text-sm font-medium text-gray-700">Tingkat</label>
                <input type="text" name="level" id="level" value="{{ old('level', $achievement->level) }}"
                       placeholder="Nasional / Provinsi / Kabupaten"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="achieved_at" class="mb-1.5 block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="achieved_at" id="achieved_at"
                       value="{{ old('achieved_at', $achievement->achieved_at?->format('Y-m-d')) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="image" class="mb-1.5 block text-sm font-medium text-gray-700">Gambar</label>
                <input type="text" name="image" id="image" value="{{ old('image', $achievement->image) }}"
                       placeholder="images/prestasi1.png"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>

            <div>
                <label for="sort_order" class="mb-1.5 block text-sm font-medium text-gray-700">Urutan</label>
                <input type="number" name="sort_order" id="sort_order" min="0" max="65535"
                       value="{{ old('sort_order', $achievement->sort_order ?? 0) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
            </div>
        </div>

        <div>
            <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" rows="4" required
                      class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">{{ old('description', $achievement->description) }}</textarea>
        </div>

        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $achievement->is_published))
                       class="rounded border-gray-300 text-brand-sky focus:ring-brand-sky">
                Terbitkan prestasi ini
            </label>

            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $achievement->is_featured))
                       class="rounded border-gray-300 text-brand-sky focus:ring-brand-sky">
                Tampilkan sebagai unggulan
            </label>
        </div>

        <div class="flex items-center gap-3 border-t border-gray-100 pt-6">
            <button type="submit"
                    class="rounded-lg bg-brand-sky px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Prestasi' }}
            </button>
            <a href="{{ route('admin.achievements.index') }}" class="text-sm text-gray-500 hover:underline">Batal</a>
        </div>
    </form>
@endsection
