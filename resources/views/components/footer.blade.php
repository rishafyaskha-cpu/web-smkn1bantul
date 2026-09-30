@php
    use App\Support\Site;

    $programs = \App\Models\ProgramKeahlian::published()->ordered()->get();
@endphp

<footer class="bg-slate-950 text-slate-300">
    <div class="container-page">
        <div class="grid grid-cols-1 gap-10 py-14 sm:grid-cols-2 lg:grid-cols-12 lg:gap-8 lg:py-16">
            <div class="lg:col-span-4">
                <div class="flex items-center gap-3">
                    <img src="{{ Site::logo() }}" alt="" width="40" height="40" class="h-10 w-10 object-contain" loading="lazy">
                    <div class="leading-tight">
                        <p class="font-display text-base font-bold text-white">{{ Site::shortName() }}</p>
                        <p class="text-xs text-slate-400">{{ Site::name() }}</p>
                    </div>
                </div>

                <address class="mt-5 space-y-2.5 not-italic text-sm leading-relaxed text-slate-400">
                    <p>{{ Site::address() }}</p>

                    @if (Site::phone())
                        <p>
                            <a href="tel:{{ preg_replace('/\s+/', '', Site::phone()) }}" class="inline-flex items-center gap-2 transition-colors hover:text-white">
                                <svg class="h-4 w-4 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 0 1 2-2h2.2a1 1 0 0 1 .95.68l1 3a1 1 0 0 1-.27 1.06L7.6 9.2a12.5 12.5 0 0 0 6.2 6.2l1.46-1.28a1 1 0 0 1 1.06-.27l3 1A1 1 0 0 1 20 15.8V18a2 2 0 0 1-2 2h-.5C9.4 20 3 13.6 3 5.5V5Z" />
                                </svg>
                                {{ Site::phone() }}
                            </a>
                        </p>
                    @endif

                    @if (Site::get('contact.email'))
                        <p>
                            <a href="mailto:{{ Site::get('contact.email') }}" class="inline-flex items-center gap-2 transition-colors hover:text-white">
                                <svg class="h-4 w-4 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1Zm0 1.5 8 5.5 8-5.5" />
                                </svg>
                                {{ Site::get('contact.email') }}
                            </a>
                        </p>
                    @endif
                </address>

                <div class="mt-6 flex items-center gap-2">
                    @foreach (Site::socialLinks() as $link)
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link['label'] }}"
                           class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/5 ring-1 ring-white/10 transition-colors hover:bg-white/10">
                            <img src="{{ asset($link['icon']) }}" alt="" width="18" height="18" class="h-[18px] w-[18px] object-contain" loading="lazy">
                        </a>
                    @endforeach
                </div>
            </div>

            <nav class="lg:col-span-2" aria-label="Navigasi footer">
                <h2 class="font-display text-sm font-semibold tracking-wide text-white">Profil</h2>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('sejarah') }}" class="text-slate-400 transition-colors hover:text-white">Sejarah</a></li>
                    <li><a href="{{ route('visi-misi') }}" class="text-slate-400 transition-colors hover:text-white">Visi &amp; Misi</a></li>
                    <li><a href="{{ route('struktur-organisasi') }}" class="text-slate-400 transition-colors hover:text-white">Struktur Organisasi</a></li>
                    <li><a href="{{ route('sarana-prasarana.index') }}" class="text-slate-400 transition-colors hover:text-white">Sarana &amp; Prasarana</a></li>
                    <li><a href="{{ route('teaching-factory') }}" class="text-slate-400 transition-colors hover:text-white">Teaching Factory</a></li>
                </ul>
            </nav>

            <nav class="lg:col-span-2" aria-label="Tautan informasi">
                <h2 class="font-display text-sm font-semibold tracking-wide text-white">Informasi</h2>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('berita.index') }}" class="text-slate-400 transition-colors hover:text-white">Berita &amp; Informasi</a></li>
                    <li><a href="{{ route('prestasi') }}" class="text-slate-400 transition-colors hover:text-white">Prestasi</a></li>
                    <li><a href="{{ route('ekstrakurikuler') }}" class="text-slate-400 transition-colors hover:text-white">Ekstrakurikuler</a></li>
                    <li><a href="{{ route('organisasi-siswa') }}" class="text-slate-400 transition-colors hover:text-white">Organisasi Siswa</a></li>
                    <li><a href="{{ route('ppdb') }}" class="text-slate-400 transition-colors hover:text-white">PPDB</a></li>
                </ul>
            </nav>

            <nav class="lg:col-span-4" aria-label="Program keahlian">
                <h2 class="font-display text-sm font-semibold tracking-wide text-white">Program Keahlian</h2>
                <ul class="mt-4 grid grid-cols-1 gap-2.5 text-sm sm:grid-cols-2">
                    @foreach ($programs as $program)
                        <li>
                            <a href="{{ route('program-keahlian.show', $program) }}" class="text-slate-400 transition-colors hover:text-white">
                                {{ $program->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div class="flex flex-col items-center justify-between gap-3 border-t border-white/10 py-6 sm:flex-row">
            <p class="text-xs text-slate-500">&copy; {{ date('Y') }} {{ Site::name() }}. Hak cipta dilindungi.</p>
            <a href="{{ Site::mapsUrl() }}" target="_blank" rel="noopener noreferrer"
               class="text-xs font-medium text-slate-400 transition-colors hover:text-white">
                Lihat Lokasi &rarr;
            </a>
        </div>
    </div>
</footer>
