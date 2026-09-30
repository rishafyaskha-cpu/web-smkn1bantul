@php
    use App\Support\Site;

    $chatbotEnabled = (bool) config('services.chatbot.enabled', true)
        && filled(config('services.gemini.key'));

    $pageSuggestions = match (request()->route()?->getName()) {
        'ppdb' => [
            ['label' => 'Informasi PPDB', 'icon' => 'graduation-cap', 'question' => 'Apa syarat mendaftar PPDB?'],
            ['label' => 'Alur pendaftaran', 'icon' => 'clipboard', 'question' => 'Bagaimana alur pendaftaran PPDB?'],
            ['label' => 'Jadwal PPDB', 'icon' => 'calendar', 'question' => 'Kapan jadwal PPDB dibuka?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Jurusan apa saja yang bisa dipilih?'],
        ],
        'program-keahlian.index', 'program-keahlian.show' => [
            ['label' => 'Daftar jurusan', 'icon' => 'layers', 'question' => 'Apa saja program keahlian yang ada?'],
            ['label' => 'Profil sekolah', 'icon' => 'school', 'question' => 'Profil sekolah seperti apa?'],
            ['label' => 'Kegiatan sekolah', 'icon' => 'calendar', 'question' => 'Apa saja kegiatan siswa?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Bagaimana cara mendaftar PPDB?'],
        ],
        'berita.index', 'berita.show' => [
            ['label' => 'Berita terbaru', 'icon' => 'newspaper', 'question' => 'Apa berita terbaru di sekolah ini?'],
            ['label' => 'Prestasi terbaru', 'icon' => 'trophy', 'question' => 'Prestasi terbaru siswa apa saja?'],
            ['label' => 'Kegiatan sekolah', 'icon' => 'calendar', 'question' => 'Apa saja kegiatan siswa?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Bagaimana cara mendaftar PPDB?'],
        ],
        'prestasi' => [
            ['label' => 'Prestasi terbaru', 'icon' => 'trophy', 'question' => 'Prestasi terbaru siswa apa saja?'],
            ['label' => 'Kompetisi', 'icon' => 'medal', 'question' => 'Kompetisi apa yang sering diikuti siswa?'],
            ['label' => 'Daftar jurusan', 'icon' => 'layers', 'question' => 'Apa saja program keahlian yang ada?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Bagaimana cara mendaftar PPDB?'],
        ],
        'download' => [
            ['label' => 'Berkas tersedia', 'icon' => 'folder-down', 'question' => 'Berkas apa saja yang bisa diunduh?'],
            ['label' => 'Info SNBP', 'icon' => 'graduation-cap', 'question' => 'Apa informasi SNBP terbaru?'],
            ['label' => 'Profil sekolah', 'icon' => 'school', 'question' => 'Profil sekolah seperti apa?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Bagaimana cara mendaftar PPDB?'],
        ],
        'sarana-prasarana.index', 'sarana-prasarana.show' => [
            ['label' => 'Fasilitas sekolah', 'icon' => 'building', 'question' => 'Apa saja fasilitas di sekolah ini?'],
            ['label' => 'Laboratorium', 'icon' => 'beaker', 'question' => 'Apakah ada laboratorium komputer?'],
            ['label' => 'Lokasi sekolah', 'icon' => 'map-pin', 'question' => 'Di mana alamat sekolah?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Apa saja program keahlian yang ada?'],
        ],
        'ekstrakurikuler', 'organisasi-siswa' => [
            ['label' => 'Ekstrakurikuler', 'icon' => 'users', 'question' => 'Ekstrakurikuler apa yang tersedia?'],
            ['label' => 'Organisasi siswa', 'icon' => 'flag', 'question' => 'Apa saja organisasi siswa di sini?'],
            ['label' => 'Cara bergabung', 'icon' => 'user-plus', 'question' => 'Bagaimana cara ikut ekstrakurikuler?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Apa saja prestasi siswa?'],
        ],
        'teaching-factory' => [
            ['label' => 'Tentang Tefa', 'icon' => 'factory', 'question' => 'Apa itu Teaching Factory?'],
            ['label' => 'Mitra industri', 'icon' => 'handshake', 'question' => 'Industri apa saja yang bekerja sama?'],
            ['label' => 'Manfaat Tefa', 'icon' => 'lightbulb', 'question' => 'Apa manfaat Teaching Factory untuk siswa?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Apa saja program keahlian yang ada?'],
        ],
        'sejarah', 'visi-misi', 'struktur-organisasi' => [
            ['label' => 'Visi & Misi', 'icon' => 'compass', 'question' => 'Apa visi dan misi sekolah ini?'],
            ['label' => 'Sejarah sekolah', 'icon' => 'book-open', 'question' => 'Bagaimana sejarah berdirinya sekolah?'],
            ['label' => 'Kepala sekolah', 'icon' => 'user-round', 'question' => 'Siapa kepala sekolah saat ini?'],
            ['label' => 'Lainnya', 'icon' => 'sparkles', 'question' => 'Apa saja program keahlian yang ada?'],
        ],
        default => collect(config('services.chatbot.suggestions', []))
            ->map(fn (string $suggestion): array => [
                'label' => $suggestion,
                'icon' => 'sparkles',
                'question' => $suggestion,
            ])
            ->all(),
    };

    $greeting = 'Halo! 👋 Saya Skansaba AI, asisten virtual '.Site::name().'. Ada yang bisa saya bantu?';

    $chipIcons = [
        'graduation-cap' => '<path d="M22 9 12 4 2 9l10 5 10-5Z"/><path d="M6 11.5V16c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.5"/><path d="M22 9v5"/>',
        'clipboard' => '<rect x="8" y="3" width="8" height="4" rx="1"/><path d="M16 5h2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2"/><path d="M9 12h6M9 16h4"/>',
        'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/>',
        'layers' => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/><path d="m3 17 9 5 9-5"/>',
        'school' => '<path d="m3 9 9-5 9 5v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9Z"/><path d="M12 4v4M9 21v-6h6v6"/>',
        'newspaper' => '<path d="M4 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/><path d="M18 8h2a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H4"/><path d="M8 7h6M8 11h6M8 15h4"/>',
        'trophy' => '<path d="M8 21h8M12 17v4"/><path d="M7 4h10v5a5 5 0 0 1-10 0V4Z"/><path d="M7 6H4v2a3 3 0 0 0 3 3M17 6h3v2a3 3 0 0 1-3 3"/>',
        'medal' => '<circle cx="12" cy="14" r="5"/><path d="m8.5 9.5-2-6h11l-2 6"/>',
        'building' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h1M14 8h1M9 12h1M14 12h1M9 16h6"/>',
        'beaker' => '<path d="M9 3h6M10 3v5.5L4.5 18a2 2 0 0 0 1.7 3h11.6a2 2 0 0 0 1.7-3L14 8.5V3"/><path d="M7 15h10"/>',
        'map-pin' => '<path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/>',
        'folder-down' => '<path d="M4 5h5l2 2h9a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/><path d="M12 10v5m0 0-2-2m2 2 2-2"/>',
        'users' => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16.5 5a3.5 3.5 0 0 1 0 7M21.5 20a6.5 6.5 0 0 0-5-6.3"/>',
        'flag' => '<path d="M5 21V4"/><path d="M5 5h11l-1.5 4L16 13H5"/>',
        'user-plus' => '<circle cx="10" cy="8" r="3.5"/><path d="M3.5 20a6.5 6.5 0 0 1 13 0"/><path d="M19 8v6M16 11h6"/>',
        'factory' => '<path d="M3 21V9l6 4V9l6 4V4h5v17H3Z"/><path d="M8 17h.01M12 17h.01M16 17h.01"/>',
        'handshake' => '<path d="m11 17 2 2 4-4"/><path d="M3 12h4l3-3 3 3h3l3-3"/><path d="M14 9 12 7l3-3 4 4v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-5"/>',
        'lightbulb' => '<path d="M9 18h6M10 21h4"/><path d="M12 3a6 6 0 0 1 4 10.5c-.7.7-1 1.5-1 2.5H9c0-1-.3-1.8-1-2.5A6 6 0 0 1 12 3Z"/>',
        'compass' => '<circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/>',
        'book-open' => '<path d="M12 6.5C10.5 5 8 4 4 4v13c4 0 6.5 1 8 2.5 1.5-1.5 4-2.5 8-2.5V4c-4 0-6.5 1-8 2.5Z"/><path d="M12 6.5V19.5"/>',
        'user-round' => '<circle cx="12" cy="8" r="4"/><path d="M5 21a7 7 0 0 1 14 0"/>',
        'sparkles' => '<path d="M12 3c.6 4.2 2.3 5.9 6.5 6.5-4.2.6-5.9 2.3-6.5 6.5-.6-4.2-2.3-5.9-6.5-6.5 4.2-.6 5.9-2.3 6.5-6.5Z"/><path d="M19 15.5c.3 2 1.2 2.9 3 3.2-1.8.3-2.7 1.2-3 3.2-.3-2-1.2-2.9-3-3.2 1.8-.3 2.7-1.2 3-3.2Z"/>',
    ];
@endphp

@if ($chatbotEnabled)
    <div
        x-data="chatbot({
            endpoint: @js(route('chatbot.ask')),
            greeting: @js($greeting),
            suggestions: @js(array_values($pageSuggestions)),
            icons: @js($chipIcons),
            pageContext: @js(request()->route()?->getName()),
        })"
        class="fixed bottom-4 right-4 z-90 print:hidden"
        @keydown.escape.window="if (open) close()"
    >
        {{-- Chat panel --}}
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-6 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            id="chatbot-panel"
            role="dialog"
            aria-modal="false"
            aria-labelledby="chatbot-title"
            class="mb-3 flex h-[34rem] max-h-[calc(100vh-7rem)] w-[calc(100vw-2rem)] max-w-[26rem] origin-bottom-right flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-[0_24px_60px_-12px_rgba(15,23,42,0.28)]"
        >
            {{-- Header --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-brand-sky via-brand-accent to-brand-navy px-5 py-4 text-white">
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(80%_120%_at_100%_0%,rgba(255,255,255,0.22),transparent_60%)]" aria-hidden="true"></div>

                <div class="relative flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <x-chatbot-avatar size="lg" state="idle" sparkle />

                        <div class="leading-tight">
                            <h2 id="chatbot-title" class="font-display text-base font-bold tracking-tight">Skansaba AI</h2>
                            <p class="mt-0.5 text-xs text-white/80">Asisten Virtual {{ Site::shortName() }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-1">
                        <button
                            type="button"
                            x-show="messages.length > 1"
                            x-cloak
                            @click="reset()"
                            class="rounded-full p-2 text-white/80 transition-colors hover:bg-white/15 hover:text-white"
                            aria-label="Mulai percakapan baru"
                            title="Mulai percakapan baru"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M20 20v-5h-5M20 9A8 8 0 0 0 6.3 5.3M4 15a8 8 0 0 0 13.7 3.7" />
                            </svg>
                        </button>

                        <button
                            type="button"
                            @click="close()"
                            class="rounded-full p-2 text-white/80 transition-colors hover:bg-white/15 hover:text-white"
                            aria-label="Tutup jendela chat"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6 6 18" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Messages --}}
            <div
                x-ref="chatLog"
                class="chatbot-scroll flex-1 space-y-4 overflow-y-auto bg-surface px-4 py-5"
                role="log"
                aria-live="polite"
                aria-relevant="additions text"
                aria-label="Riwayat percakapan"
            >
                <template x-for="message in messages" :key="message.id">
                    <div
                        class="flex items-end gap-2.5 animate-bot-rise"
                        :class="message.role === 'user' ? 'flex-row-reverse' : ''"
                    >
                        <template x-if="message.role === 'assistant'">
                            <x-chatbot-avatar size="sm" />
                        </template>

                        <div class="flex max-w-[82%] flex-col" :class="message.role === 'user' ? 'items-end' : 'items-start'">
                            <div
                                class="whitespace-pre-line rounded-2xl px-4 py-2.5 text-sm leading-relaxed"
                                :class="message.role === 'user'
                                    ? 'rounded-br-md bg-brand-sky text-white shadow-[0_6px_16px_-6px_rgba(11,76,240,0.7)]'
                                    : 'rounded-bl-md bg-white text-slate-700 shadow-card ring-1 ring-slate-900/5'"
                                x-text="message.content"
                            ></div>

                            <time class="mt-1 px-1 text-[11px] text-slate-400" x-text="message.time"></time>
                        </div>
                    </div>
                </template>

                {{-- Typing indicator --}}
                <div x-show="loading" x-cloak class="flex items-end gap-2.5 animate-bot-rise" aria-hidden="true">
                    <x-chatbot-avatar size="sm" state="thinking" />

                    <div class="flex items-center gap-1 rounded-2xl rounded-bl-md bg-white px-4 py-3 shadow-card ring-1 ring-slate-900/5">
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-sky animate-bot-typing"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-sky animate-bot-typing" style="animation-delay: 150ms"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-sky animate-bot-typing" style="animation-delay: 300ms"></span>
                        <span class="sr-only">Sedang menyusun jawaban</span>
                    </div>
                </div>

                {{-- Suggestion chips --}}
                <div x-show="showSuggestions" x-cloak class="space-y-3 pt-1" data-reveal="up">
                    <p class="px-1 text-xs font-semibold uppercase tracking-wider text-slate-400">Pertanyaan populer</p>

                    <div class="flex flex-col gap-2">
                        <template x-for="(suggestion, index) in suggestions" :key="suggestion.label">
                            <button
                                type="button"
                                class="suggestion-chip w-full"
                                :style="`animation-delay: ${index * 40}ms`"
                                @click="askSuggestion(suggestion.question)"
                            >
                                <svg class="h-4 w-4 shrink-0 text-brand-sky" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                                     stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                     x-html="iconPaths[suggestion.icon] ?? iconPaths.sparkles"></svg>
                                <span x-text="suggestion.label"></span>
                                <svg class="ml-auto h-4 w-4 shrink-0 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 6 6 6-6 6" />
                                </svg>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Error --}}
            <p
                x-show="error"
                x-cloak
                x-text="error"
                role="alert"
                class="border-t border-red-100 bg-red-50 px-4 py-2 text-xs font-medium text-red-700"
            ></p>

            {{-- Composer --}}
            <form @submit.prevent="send()" class="border-t border-slate-200 bg-white px-3 py-3">
                <label for="chatbot-input" class="sr-only">Tulis pertanyaan Anda</label>

                <div class="flex items-end gap-2 rounded-full border border-slate-300 bg-white py-1.5 pl-4 pr-1.5 transition focus-within:border-brand-sky focus-within:ring-2 focus-within:ring-brand-sky/15">
                    <textarea
                        id="chatbot-input"
                        x-ref="chatInput"
                        x-model="input"
                        rows="1"
                        maxlength="{{ config('services.chatbot.max_question_length', 500) }}"
                        placeholder="Ketik pesan Anda…"
                        class="max-h-28 flex-1 resize-none border-0 bg-transparent p-0 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-0"
                        @keydown.enter.prevent="if (!$event.shiftKey) send()"
                        @input="autoGrow($event)"
                    ></textarea>

                    <button
                        type="submit"
                        :disabled="loading || input.trim() === ''"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-sky text-white shadow-[0_8px_18px_-8px_rgba(11,76,240,0.9)] transition-all duration-200 enabled:hover:scale-105 enabled:hover:bg-brand-navy disabled:cursor-not-allowed disabled:opacity-40"
                        aria-label="Kirim pertanyaan"
                    >
                        <svg class="h-[18px] w-[18px] -translate-x-px translate-y-px" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M21 3 3.6 10.3c-.5.2-.5.9 0 1.1l7 2.8 2.8 7c.2.5.9.5 1.1 0L21 3ZM10.6 13.4 21 3" />
                        </svg>
                    </button>
                </div>

                <p class="mt-2 flex items-center justify-between px-1 text-[11px] text-slate-400">
                    <span>Tekan Enter untuk kirim</span>
                    <span x-text="`${input.length}/${ {{ config('services.chatbot.max_question_length', 500) }} }`"></span>
                </p>
            </form>
        </div>

        {{-- Launcher --}}
        <div class="relative flex justify-end">
            {{-- Greeting teaser --}}
            <div
                x-show="!open"
                x-cloak
                x-transition:enter="transition ease-out duration-400 delay-200"
                x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="pointer-events-none absolute bottom-3 right-full mr-3 hidden w-60 rounded-2xl border border-slate-200 bg-white p-3.5 text-sm shadow-panel sm:block"
                aria-hidden="true"
            >
                <p class="font-display text-xs font-bold text-brand-navy">Butuh informasi?</p>
                <p class="mt-1 leading-snug text-slate-600">Tanya Skansaba AI soal jurusan, PPDB, atau fasilitas sekolah.</p>
                <span class="absolute -right-1.5 bottom-4 h-3 w-3 rotate-45 border-r border-t border-slate-200 bg-white"></span>
            </div>

            <button
                type="button"
                x-ref="chatToggle"
                @click="toggle()"
                @mouseenter="hovered = true"
                @mouseleave="hovered = false"
                @focus="hovered = true"
                @blur="hovered = false"
                class="chatbot-launcher chatbot-glow flex min-h-14 items-center gap-3 rounded-full py-2.5 pl-3 pr-6 text-sm font-semibold text-white shadow-[0_14px_34px_-10px_rgba(10,60,134,0.8)]"
                :class="hovered && !open && 'chatbot-launcher-hover'"
                :aria-expanded="open ? 'true' : 'false'"
                aria-controls="chatbot-panel"
            >
                <span class="relative flex h-9 w-9 items-center justify-center rounded-full bg-white/15 ring-1 ring-white/25">
                    <svg x-show="!open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h8M8 14h5m8-2a8 8 0 0 1-8 8H7l-4 3v-5.6A8 8 0 1 1 21 12Z" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6 6 18" />
                    </svg>

                    <svg x-show="!open" class="absolute -right-1.5 -top-1.5 h-4 w-4 text-amber-300 animate-bot-sparkle" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2.2c.7 4.8 2.6 6.7 7.4 7.4-4.8.7-6.7 2.6-7.4 7.4-.7-4.8-2.6-6.7-7.4-7.4 4.8-.7 6.7-2.6 7.4-7.4Z" />
                    </svg>
                </span>

                <span class="hidden sm:inline" x-text="open ? 'Tutup' : 'Tanya Skansaba AI'">Tanya Skansaba AI</span>

                <svg x-show="!open" class="hidden h-4 w-4 sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m0 0-6-6m6 6-6 6" />
                </svg>
            </button>
        </div>
    </div>
@endif
