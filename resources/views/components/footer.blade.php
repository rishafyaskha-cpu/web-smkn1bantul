@php
    use App\Support\Site;
@endphp

<footer class="bg-[#0A0A0A] text-white py-10 px-6 sm:px-10 lg:px-20">
    <div class="max-w-screen mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <div>
            <h2 class="text-lg font-poppins mb-3 text-white">{{ Site::name() }}</h2>
            <address class="not-italic text-base text-gray-400 leading-relaxed mb-3">
                {{ Site::address() }}
            </address>

            @if (Site::phone())
                <a href="tel:{{ preg_replace('/\s+/', '', Site::phone()) }}" class="block text-sm text-gray-400 mt-1 hover:text-white">
                    {{ Site::phone() }}
                </a>
            @endif

            @if (Site::get('contact.email'))
                <a href="mailto:{{ Site::get('contact.email') }}" class="block text-sm text-gray-400 mt-1 hover:text-white">
                    {{ Site::get('contact.email') }}
                </a>
            @endif
        </div>

        <div>
            <h3 class="text-base font-semibold mb-3">Ikuti Kami</h3>
            <div class="flex space-x-4 mb-5">
                @foreach (Site::socialLinks() as $link)
                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link['label'] }}">
                        <img src="{{ asset($link['icon']) }}" alt="{{ $link['label'] }}" width="24" height="24" loading="lazy">
                    </a>
                @endforeach
            </div>
            <a href="{{ Site::mapsUrl() }}" target="_blank" rel="noopener noreferrer"
               class="inline-block bg-white text-black font-semibold px-5 py-2 rounded-md hover:bg-gray-200 transition">
                Hubungi Kami
            </a>
        </div>

        <div>
            <h3 class="text-base font-semibold mb-3">Navigasi Singkat</h3>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('sejarah') }}" class="hover:text-white text-base transition">Sejarah</a></li>
                <li><a href="{{ route('visi-misi') }}" class="hover:text-white text-base transition">Visi &amp; Misi</a></li>
                <li><a href="{{ route('struktur-organisasi') }}" class="hover:text-white text-base transition">Struktur Organisasi</a></li>
                <li><a href="{{ route('sarana-prasarana.index') }}" class="hover:text-white text-base transition">Sarana &amp; Prasarana</a></li>
                <li><a href="{{ route('ppdb') }}" class="hover:text-white text-base transition">PPDB</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-base font-semibold mb-3">Program Keahlian</h3>
            <ul class="space-y-2 text-gray-400 text-sm">
                @foreach (\App\Models\ProgramKeahlian::published()->ordered()->get() as $program)
                    <li><a href="{{ route('program-keahlian.show', $program) }}" class="hover:text-white text-base transition">{{ $program->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="max-w-screen mx-auto text-center text-gray-500 text-xs sm:text-sm mt-10 border-t border-gray-800 pt-5">
        &copy; {{ date('Y') }} {{ Site::name() }}. Hak cipta dilindungi.
    </div>
</footer>
