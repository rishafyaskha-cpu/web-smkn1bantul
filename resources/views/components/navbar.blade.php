@php
    use App\Support\Site;

    $nav = [
        ['label' => 'Beranda', 'route' => 'home'],
        [
            'label' => 'Profile Sekolah',
            'children' => [
                ['label' => 'Sejarah', 'route' => 'sejarah'],
                ['label' => 'Visi & Misi', 'route' => 'visi-misi'],
                ['label' => 'Struktur Organisasi', 'route' => 'struktur-organisasi'],
                ['label' => 'Sarana Prasarana', 'route' => 'sarana-prasarana.index'],
                ['label' => 'Teaching Factory', 'route' => 'teaching-factory'],
            ],
        ],
        [
            'label' => 'Informasi',
            'children' => [
                ['label' => 'Berita & Informasi', 'route' => 'berita.index'],
                ['label' => 'Prestasi', 'route' => 'prestasi'],
            ],
        ],
        [
            'label' => 'Program Keahlian',
            'children' => \App\Models\ProgramKeahlian::published()->ordered()->get()
                ->map(fn ($p) => ['label' => $p->title, 'route' => 'program-keahlian.show', 'params' => [$p->slug]])
                ->all(),
        ],
        [
            'label' => 'Kegiatan Siswa',
            'children' => [
                ['label' => 'Ekstrakurikuler', 'route' => 'ekstrakurikuler'],
                ['label' => 'Organisasi Siswa', 'route' => 'organisasi-siswa'],
            ],
        ],
        [
            'label' => 'BLUD & BKK',
            'children' => [
                ['label' => 'PPDB', 'route' => 'ppdb'],
                ['label' => 'Teaching Factory', 'route' => 'teaching-factory'],
            ],
        ],
    ];

    $current = request()->route()?->getName();

    $isRouteActive = function (array $item) use ($current): bool {
        if (isset($item['route'])) {
            return $current === $item['route'];
        }

        foreach ($item['children'] ?? [] as $child) {
            if (($child['route'] ?? null) === $current) {
                return true;
            }

            if (($child['route'] ?? null) && str_starts_with((string) $current, $child['route'].'.')) {
                return true;
            }
        }

        return false;
    };
@endphp

<nav class="bg-white/80 backdrop-blur-2xl border-b border-gray-100 shadow-[0_10px_20px_rgba(0,0,0,0.05)] sticky top-0 left-0 z-80 w-full"
     aria-label="Navigasi utama"
     x-data="{ mobileOpen: false }">
    <div class="max-w-screen px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 lg:h-24">
            <a href="{{ route('home') }}" class="flex items-center md:items-center">
                <img src="{{ Site::logo() }}" alt="Logo {{ Site::name() }}" width="40" height="40"
                     class="pr-2 md:pr-3 lg:pr-4 h-10 w-auto max-h-12" style="object-fit: contain">
                <span class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800">{{ Site::shortName() }}</span>
            </a>

            <div class="hidden lg:flex md:items-center md:space-x-6">
                @foreach ($nav as $item)
                    @continue(empty($item['route']) && empty($item['children']))

                    @if (isset($item['route']))
                        <a href="{{ route($item['route']) }}"
                           class="relative text-gray-700 transition-colors hover:text-brand-navy after:absolute after:-bottom-1.5 after:left-0 after:h-0.5 after:w-0 after:bg-brand-sky after:transition-all after:duration-300 hover:after:w-full @if ($isRouteActive($item)) font-semibold text-brand-navy after:w-full @endif">{{ $item['label'] }}</a>
                    @else
                        <div class="relative" x-data="navDropdown()" @mouseenter="show()" @mouseleave="hide()">
                            <button type="button" @click="toggle()" class="group inline-flex items-center gap-2 transition-colors hover:text-brand-navy focus:outline-none @if ($isRouteActive($item)) font-semibold text-brand-navy @else text-gray-700 @endif"
                                    aria-haspopup="true" :aria-expanded="open">
                                <span>{{ $item['label'] }}</span>
                                <svg class="w-4 h-4 transform transition-transform duration-300" :class="open && 'rotate-180'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div @mouseenter="show()" @mouseleave="hide()"
                                 class="absolute right-0 mt-3 w-56 rounded-xl border border-gray-100 bg-white py-1.5 shadow-xl overflow-clip transition-all duration-200 z-20"
                                 :class="open ? 'opacity-100 visible translate-y-0 pointer-events-auto' : 'opacity-0 invisible -translate-y-1 pointer-events-none'">
                                <ul>
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a href="{{ route($child['route'], $child['params'] ?? []) }}"
                                               class="block px-4 py-2 text-sm transition-colors duration-200 hover:bg-blue-50 hover:text-brand-navy @if ($isRouteActive($child)) bg-blue-50/60 font-medium text-brand-navy @else text-gray-700 @endif">{{ $child['label'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="flex items-center lg:hidden">
                <button type="button" class="p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        aria-label="Buka menu navigasi" :aria-expanded="mobileOpen" @click="mobileOpen = !mobileOpen">
                    <span class="sr-only">Toggle menu</span>
                    <svg class="w-6 h-6" x-show="!mobileOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="w-6 h-6" x-show="mobileOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="lg:hidden overflow-hidden transition-[max-height,opacity,transform] duration-400 ease-out origin-top"
         :class="mobileOpen ? 'max-h-[600px] opacity-100 translate-y-0' : 'max-h-0 opacity-0 pointer-events-none'"
         :aria-hidden="!mobileOpen">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @foreach ($nav as $item)
                @continue(empty($item['route']) && empty($item['children']))

                @if (isset($item['route']))
                    <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                       class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">{{ $item['label'] }}</a>
                @else
                    <details class="group">
                        <summary class="flex items-center justify-between px-3 py-2 cursor-pointer text-gray-700 hover:bg-gray-100 rounded">
                            <span>{{ $item['label'] }}</span>
                            <svg class="w-4 h-4 transform group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <div class="pl-4">
                            @foreach ($item['children'] as $child)
                                <a href="{{ route($child['route'], $child['params'] ?? []) }}"
                                   class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    </details>
                @endif
            @endforeach
        </div>
    </div>
</nav>
