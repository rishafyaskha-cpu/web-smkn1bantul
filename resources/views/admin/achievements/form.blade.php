@extends('layouts.admin')

@php
    $isEdit = $achievement->exists;
    $seoTitle = $isEdit ? 'Ubah Prestasi' : 'Tambah Prestasi';
@endphp

@section('content')
    <header class="mb-6">
        <a href="{{ route('admin.achievements.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-brand-sky transition-colors hover:text-brand-navy">
            <span aria-hidden="true">&larr;</span>
            Kembali ke daftar prestasi
        </a>
        <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900">{{ $isEdit ? 'Ubah Prestasi' : 'Tambah Prestasi' }}</h1>
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
          action="{{ $isEdit ? route('admin.achievements.update', $achievement) : route('admin.achievements.store') }}"
          class="max-w-3xl space-y-6 rounded-xl border border-slate-200 bg-white p-6 shadow-card sm:p-7">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div>
            <label for="title" class="label">Judul Prestasi <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" required value="{{ old('title', $achievement->title) }}" class="input">
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="student_name" class="label">Nama Siswa</label>
                <input type="text" name="student_name" id="student_name" value="{{ old('student_name', $achievement->student_name) }}" class="input">
            </div>

            <div>
                <label for="class_name" class="label">Kelas</label>
                <input type="text" name="class_name" id="class_name" value="{{ old('class_name', $achievement->class_name) }}"
                       placeholder="XII RPL 1" class="input">
            </div>

            <div>
                <label for="level" class="label">Tingkat</label>
                <input type="text" name="level" id="level" value="{{ old('level', $achievement->level) }}"
                       placeholder="Nasional / Provinsi / Kabupaten" class="input">
            </div>

            <div>
                <label for="achieved_at" class="label">Tanggal</label>
                <input type="date" name="achieved_at" id="achieved_at"
                       value="{{ old('achieved_at', $achievement->achieved_at?->format('Y-m-d')) }}" class="input">
            </div>

            <div>
                <label for="image" class="label">Gambar</label>
                <input type="text" name="image" id="image" value="{{ old('image', $achievement->image) }}"
                       placeholder="images/prestasi1.png" class="input">
            </div>

            <div>
                <label for="sort_order" class="label">Urutan</label>
                <input type="number" name="sort_order" id="sort_order" min="0" max="65535"
                       value="{{ old('sort_order', $achievement->sort_order ?? 0) }}" class="input">
            </div>
        </div>

        <div>
            <label for="description" class="label">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" rows="4" required class="input">{{ old('description', $achievement->description) }}</textarea>
        </div>

        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $achievement->is_published))
                       class="h-4 w-4 rounded border-slate-300 text-brand-sky focus:ring-brand-sky">
                Terbitkan prestasi ini
            </label>

            <label class="flex items-center gap-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $achievement->is_featured))
                       class="h-4 w-4 rounded border-slate-300 text-brand-sky focus:ring-brand-sky">
                Tampilkan sebagai unggulan
            </label>
        </div>

        <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
            <x-button type="submit" variant="primary">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Prestasi' }}
            </x-button>
            <a href="{{ route('admin.achievements.index') }}" class="text-sm font-medium text-slate-500 transition-colors hover:text-slate-700">Batal</a>
        </div>
    </form>
@endsection
