@extends('layouts.blank')

@php
    $seoTitle = 'Masuk';
    $seoDescription = 'Masuk ke panel admin '.config('app.name').'.';
@endphp

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-50 px-4 py-12">
        <div class="w-full max-w-md">
            <div class="flex items-center justify-center gap-3 mb-8">
                <img src="{{ \App\Support\Site::logo() }}" alt="Logo {{ \App\Support\Site::name() }}" width="48" height="48" class="w-12 h-12">
                <div>
                    <h1 class="text-lg font-bold text-brand-navy leading-tight">{{ \App\Support\Site::shortName() }}</h1>
                    <p class="text-xs text-gray-500">Panel Admin</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Masuk</h2>
                <p class="text-sm text-gray-500 mb-6">Silakan masuk menggunakan akun admin Anda.</p>

                @if ($errors->any())
                    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                               autocomplete="username"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Kata Sandi</label>
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-brand-sky focus:ring-1 focus:ring-brand-sky">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remember" value="1"
                               class="rounded border-gray-300 text-brand-sky focus:ring-brand-sky">
                        Ingat saya
                    </label>

                    <button type="submit"
                            class="w-full rounded-lg bg-brand-sky px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Masuk
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm">
                <a href="{{ route('home') }}" class="text-brand-sky hover:underline">&larr; Kembali ke situs</a>
            </p>
        </div>
    </div>
@endsection
