@php
    $chatbotEnabled = (bool) config('services.chatbot.enabled', true)
        && filled(config('services.gemini.key'));
@endphp

@if ($chatbotEnabled)
    <div
        x-data="chatbot({
            endpoint: @js(route('chatbot.ask')),
            greeting: @js('Halo! Saya Skansaba Bot, asisten informasi '.config('app.name').'. Silakan tanya tentang jurusan, PPDB, fasilitas, prestasi, atau kegiatan sekolah.'),
        })"
        class="fixed bottom-4 right-4 z-90 print:hidden"
        @keydown.escape.window="if (open) close()"
    >
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            id="chatbot-panel"
            role="dialog"
            aria-modal="false"
            aria-labelledby="chatbot-title"
            class="mb-3 flex h-[32rem] w-[calc(100vw-2rem)] max-w-sm flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-2xl"
        >
            <div class="flex items-center justify-between gap-3 bg-brand-navy px-4 py-3 text-white">
                <div class="flex items-center gap-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h8M8 14h5m8-2a8 8 0 0 1-8 8H7l-4 3v-5.6A8 8 0 1 1 21 12Z" />
                    </svg>
                    <h2 id="chatbot-title" class="text-sm font-semibold">Skansaba Bot</h2>
                </div>

                <button
                    type="button"
                    @click="close()"
                    class="rounded-full p-1 transition-colors hover:bg-white/20"
                    aria-label="Tutup jendela chat"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6 6 18" />
                    </svg>
                </button>
            </div>

            <div
                x-ref="chatLog"
                class="flex-1 space-y-3 overflow-y-auto bg-gray-50 px-4 py-4"
                role="log"
                aria-live="polite"
                aria-relevant="additions text"
                aria-label="Riwayat percakapan"
            >
                <template x-for="(message, index) in messages" :key="index">
                    <div
                        class="flex"
                        :class="message.role === 'user' ? 'justify-end' : 'justify-start'"
                    >
                        <p
                            class="max-w-[85%] whitespace-pre-line rounded-2xl px-3 py-2 text-sm leading-relaxed"
                            :class="message.role === 'user'
                                ? 'bg-brand-sky text-white rounded-br-sm'
                                : 'bg-white text-gray-800 shadow-sm border border-gray-200 rounded-bl-sm'"
                            x-text="message.content"
                        ></p>
                    </div>
                </template>

                <div x-show="loading" x-cloak class="flex justify-start" aria-hidden="true">
                    <p class="rounded-2xl rounded-bl-sm border border-gray-200 bg-white px-3 py-2 text-sm text-gray-500 shadow-sm">
                        Sedang mengetik…
                    </p>
                </div>
            </div>

            <p
                x-show="error"
                x-cloak
                x-text="error"
                role="alert"
                class="border-t border-red-100 bg-red-50 px-4 py-2 text-xs text-red-700"
            ></p>

            <form @submit.prevent="send()" class="border-t border-gray-200 bg-white px-3 py-3">
                <label for="chatbot-input" class="sr-only">Tulis pertanyaan Anda</label>
                <div class="flex items-end gap-2">
                    <textarea
                        id="chatbot-input"
                        x-ref="chatInput"
                        x-model="input"
                        rows="1"
                        maxlength="{{ config('services.chatbot.max_question_length', 500) }}"
                        placeholder="Tulis pertanyaan…"
                        class="max-h-24 flex-1 resize-none rounded-xl border border-gray-300 px-3 py-2 text-sm text-gray-800 focus:border-brand-sky focus:outline-none"
                        @keydown.enter.prevent="if (!$event.shiftKey) send()"
                    ></textarea>

                    <button
                        type="submit"
                        :disabled="loading || input.trim() === ''"
                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-brand-navy text-white transition-colors enabled:hover:bg-brand-sky disabled:cursor-not-allowed disabled:opacity-50"
                        aria-label="Kirim pertanyaan"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m0 0-6-6m6 6-6 6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <button
            type="button"
            x-ref="chatToggle"
            @click="toggle()"
            class="ml-auto flex items-center gap-2 rounded-full bg-brand-navy px-4 py-3 text-sm font-semibold text-white shadow-lg transition-colors hover:bg-brand-sky"
            :aria-expanded="open ? 'true' : 'false'"
            aria-controls="chatbot-panel"
        >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h8M8 14h5m8-2a8 8 0 0 1-8 8H7l-4 3v-5.6A8 8 0 1 1 21 12Z" />
            </svg>
            <span x-text="open ? 'Tutup Chat' : 'Tanya Skansaba Bot'">Tanya Skansaba Bot</span>
        </button>
    </div>
@endif
