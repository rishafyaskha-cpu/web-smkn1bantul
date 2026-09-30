@php
    use App\Support\Site;

    $chatbotEnabled = (bool) config('services.chatbot.enabled', true)
        && filled(config('services.gemini.key'));

    $pageSuggestions = match (request()->route()?->getName()) {
        'ppdb' => [
            'Apa syarat mendaftar PPDB?',
            'Bagaimana alur pendaftaran PPDB?',
            'Kapan jadwal PPDB dibuka?',
            'Jurusan apa saja yang bisa dipilih?',
        ],
        'program-keahlian.index', 'program-keahlian.show' => [
            'Apa saja program keahlian yang ada?',
            'Jurusan mana yang paling cocok untuk saya?',
            'Apa prospek kerja tiap jurusan?',
            'Bagaimana cara mendaftar PPDB?',
        ],
        'berita.index', 'berita.show' => [
            'Apa berita terbaru di sekolah ini?',
            'Prestasi terbaru siswa apa saja?',
            'Apa saja kegiatan siswa?',
            'Bagaimana cara mendaftar PPDB?',
        ],
        'prestasi' => [
            'Prestasi terbaru siswa apa saja?',
            'Kompetisi apa yang sering diikuti siswa?',
            'Apa saja program keahlian yang ada?',
            'Bagaimana cara mendaftar PPDB?',
        ],
        'sarana-prasarana.index', 'sarana-prasarana.show' => [
            'Apa saja fasilitas di sekolah ini?',
            'Apakah ada laboratorium komputer?',
            'Fasilitas apa yang mendukung praktik siswa?',
            'Di mana alamat sekolah?',
        ],
        'ekstrakurikuler', 'organisasi-siswa' => [
            'Ekstrakurikuler apa yang tersedia?',
            'Apa saja organisasi siswa di sini?',
            'Bagaimana cara ikut ekstrakurikuler?',
            'Apa saja prestasi siswa?',
        ],
        'teaching-factory' => [
            'Apa itu Teaching Factory?',
            'Industri apa saja yang bekerja sama?',
            'Apa manfaat Teaching Factory untuk siswa?',
            'Apa saja program keahlian yang ada?',
        ],
        'sejarah', 'visi-misi', 'struktur-organisasi' => [
            'Apa visi dan misi sekolah ini?',
            'Bagaimana sejarah berdirinya sekolah?',
            'Siapa kepala sekolah saat ini?',
            'Apa saja program keahlian yang ada?',
        ],
        default => config('services.chatbot.suggestions', []),
    };

    $greeting = 'Halo! Saya Skansaba Bot, asisten informasi '.Site::name().'. Ada yang bisa saya bantu?';
@endphp

@if ($chatbotEnabled)
    <div
        x-data="chatbot({
            endpoint: @js(route('chatbot.ask')),
            greeting: @js($greeting),
            suggestions: @js(array_values($pageSuggestions)),
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
            <div class="relative overflow-hidden bg-brand-teal px-5 py-4 text-white">
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(80%_120%_at_100%_0%,rgba(11,76,240,0.55),transparent_60%)]" aria-hidden="true"></div>

                <div class="relative flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <x-chatbot-avatar size="lg" state="idle" />

                        <div class="leading-tight">
                            <h2 id="chatbot-title" class="font-display text-base font-bold tracking-tight">Skansaba Bot</h2>
                            <p class="mt-0.5 flex items-center gap-1.5 text-xs text-slate-200">
                                <span class="relative flex h-2 w-2">
                                    <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 animate-bot-pulse"></span>
                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                                </span>
                                <span x-text="loading ? 'Sedang mengetik…' : 'Siap membantu'">Siap membantu</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-1">
                        <button
                            type="button"
                            x-show="messages.length > 1"
                            x-cloak
                            @click="reset()"
                            class="rounded-full p-2 text-slate-200 transition-colors hover:bg-white/15 hover:text-white"
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
                            class="rounded-full p-2 text-slate-200 transition-colors hover:bg-white/15 hover:text-white"
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
                <template x-for="(message, index) in messages" :key="message.id">
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

                    <div class="flex flex-wrap gap-2">
                        <template x-for="(suggestion, index) in suggestions" :key="suggestion">
                            <button
                                type="button"
                                class="suggestion-chip"
                                :style="`animation-delay: ${index * 40}ms`"
                                @click="askSuggestion(suggestion)"
                                x-text="suggestion"
                            ></button>
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

                <div class="flex items-end gap-2 rounded-2xl border border-slate-300 bg-white px-3 py-2 transition focus-within:border-brand-sky focus-within:ring-2 focus-within:ring-brand-sky/15">
                    <textarea
                        id="chatbot-input"
                        x-ref="chatInput"
                        x-model="input"
                        rows="1"
                        maxlength="{{ config('services.chatbot.max_question_length', 500) }}"
                        placeholder="Tulis pertanyaan Anda…"
                        class="max-h-28 flex-1 resize-none border-0 bg-transparent p-0 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-0"
                        @keydown.enter.prevent="if (!$event.shiftKey) send()"
                        @input="autoGrow($event)"
                    ></textarea>

                    <button
                        type="submit"
                        :disabled="loading || input.trim() === ''"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-brand-navy text-white transition-all duration-200 enabled:hover:bg-brand-sky enabled:hover:scale-105 disabled:cursor-not-allowed disabled:opacity-40"
                        aria-label="Kirim pertanyaan"
                    >
                        <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m0 0-6-6m6 6-6 6" />
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
                x-show="!open && !hasInteracted"
                x-cloak
                x-transition:enter="transition ease-out duration-400 delay-200"
                x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="pointer-events-none absolute bottom-3 right-full mr-3 hidden w-60 rounded-2xl border border-slate-200 bg-white p-3.5 text-sm shadow-panel sm:block"
                aria-hidden="true"
            >
                <p class="font-display text-xs font-bold text-brand-navy">Butuh informasi?</p>
                <p class="mt-1 leading-snug text-slate-600">Tanya Skansaba Bot soal jurusan, PPDB, atau fasilitas sekolah.</p>
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
                class="chatbot-launcher chatbot-glow flex items-center gap-2.5 rounded-full py-3 pl-3.5 pr-5 text-sm font-semibold text-white shadow-[0_12px_30px_-8px_rgba(10,60,134,0.75)]"
                :class="hovered && !open && 'chatbot-launcher-hover'"
                :aria-expanded="open ? 'true' : 'false'"
                aria-controls="chatbot-panel"
            >
                <span class="relative flex h-8 w-8 items-center justify-center rounded-full bg-white/15">
                    <svg x-show="!open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h8M8 14h5m8-2a8 8 0 0 1-8 8H7l-4 3v-5.6A8 8 0 1 1 21 12Z" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6 6 18" />
                    </svg>

                    <span x-show="!open" class="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full bg-emerald-400 ring-2 ring-brand-navy"></span>
                </span>

                <span class="hidden sm:inline" x-text="open ? 'Tutup' : 'Tanya Skansaba Bot'">Tanya Skansaba Bot</span>
            </button>
        </div>
    </div>
@endif
