@extends('layouts.blank')

@php
    $seoTitle = 'Masuk';
    $seoDescription = 'Masuk ke panel admin '.config('app.name').'.';
@endphp

@section('content')
    <div class="flex flex-1 items-center justify-center bg-surface px-4 py-12">
        <div class="w-full max-w-sm">
            <div class="mb-8 flex flex-col items-center gap-3 text-center">
                <img src="{{ \App\Support\Site::logo() }}" alt="Logo {{ \App\Support\Site::name() }}" width="48" height="48" class="h-12 w-12 object-contain">
                <div>
                    <h1 class="font-display text-lg font-bold text-slate-900">{{ \App\Support\Site::shortName() }}</h1>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Panel Admin</p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-card sm:p-8">
                <h2 class="font-display text-xl font-bold tracking-tight text-slate-900">Masuk</h2>
                <p class="mt-1.5 text-sm text-slate-500">Silakan masuk menggunakan akun admin Anda.</p>

                @if ($errors->any())
                    <div class="mt-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                               autocomplete="username" class="input">
                    </div>

                    <div>
                        <label for="password" class="label">Kata Sandi</label>
                        <input type="password" name="password" id="password" required autocomplete="current-password" class="input">
                    </div>

                    <label class="flex items-center gap-2.5 text-sm text-slate-600">
                        <input type="checkbox" name="remember" value="1"
                               class="h-4 w-4 rounded border-slate-300 text-brand-sky focus:ring-brand-sky">
                        Ingat saya
                    </label>

                    <x-button type="submit" variant="primary" size="lg" class="w-full">
                        Masuk
                    </x-button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm">
                <a href="{{ route('home') }}" class="link-inline">&larr; Kembali ke situs</a>
            </p>
        </div>
    </div>
@endsection
