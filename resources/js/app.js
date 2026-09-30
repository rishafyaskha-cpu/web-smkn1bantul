import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('carousel', (config = {}) => ({
    index: 0,
    count: config.count ?? 0,
    perView: config.perView ?? 1,
    autoplay: config.autoplay ?? false,
    interval: config.interval ?? 4000,
    timer: null,

    get maxIndex() {
        return Math.max(0, this.count - this.perView);
    },

    init() {
        if (this.autoplay && this.count > this.perView) {
            this.play();
        }
    },

    play() {
        this.stop();
        this.timer = setInterval(() => this.next(), this.interval);
    },

    stop() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },

    next() {
        this.index = this.index >= this.maxIndex ? 0 : this.index + 1;
    },

    prev() {
        this.index = this.index <= 0 ? this.maxIndex : this.index - 1;
    },

    goTo(i) {
        this.index = Math.min(i, this.maxIndex);
    },

    get offset() {
        return this.perView > 0 ? -(this.index * (100 / this.perView)) : 0;
    },
}));

Alpine.data('navDropdown', () => ({
    open: false,
    closeTimer: null,

    show() {
        if (this.closeTimer) {
            clearTimeout(this.closeTimer);
            this.closeTimer = null;
        }
        this.open = true;
    },

    hide() {
        this.closeTimer = setTimeout(() => {
            this.open = false;
            this.closeTimer = null;
        }, 150);
    },

    toggle() {
        this.open = !this.open;
    },
}));

Alpine.data('chatbot', (config = {}) => ({
    open: false,
    loading: false,
    hovered: false,
    input: '',
    error: null,
    messages: [],
    suggestions: config.suggestions ?? [],
    iconPaths: config.icons ?? {},
    endpoint: config.endpoint ?? '',
    greeting: config.greeting ?? 'Halo! Ada yang bisa saya bantu?',
    unavailableMessage: config.unavailableMessage ?? '',
    messageId: 0,

    init() {
        this.messages = [this.createMessage('assistant', this.greeting)];
    },

    get showSuggestions() {
        return ! this.loading && this.suggestions.length > 0 && this.messages.length <= 1;
    },

    get history() {
        return this.messages
            .slice(-10)
            .map((message) => ({
                role: message.role,
                content: message.content.slice(0, 2000),
            }));
    },

    createMessage(role, content) {
        return {
            id: ++this.messageId,
            role,
            content,
            time: new Intl.DateTimeFormat('id-ID', { hour: '2-digit', minute: '2-digit' }).format(new Date()),
        };
    },

    toggle() {
        this.open = ! this.open;

        if (this.open) {
            this.$nextTick(() => this.$refs.chatInput?.focus());
        }
    },

    close() {
        this.open = false;
        this.$nextTick(() => this.$refs.chatToggle?.focus());
    },

    reset() {
        this.error = null;
        this.input = '';
        this.messages = [this.createMessage('assistant', this.greeting)];
        this.$nextTick(() => this.$refs.chatInput?.focus());
    },

    askSuggestion(question) {
        this.input = question;
        this.send();
    },

    autoGrow(event) {
        const element = event.target;

        element.style.height = 'auto';
        element.style.height = `${Math.min(element.scrollHeight, 112)}px`;
    },

    async send() {
        const question = this.input.trim();

        if (question === '' || this.loading) {
            return;
        }

        this.error = null;
        this.input = '';

        if (this.$refs.chatInput) {
            this.$refs.chatInput.style.height = 'auto';
        }

        this.messages.push(this.createMessage('user', question));
        this.loading = true;
        this.scrollToLatest();

        try {
            const response = await fetch(this.endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                },
                body: JSON.stringify({
                    message: question,
                    history: this.history.slice(0, -1),
                }),
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw new Error(data.error ?? 'Maaf, terjadi kendala. Silakan coba lagi.');
            }

            this.messages.push(this.createMessage('assistant', data.answer));
        } catch (error) {
            this.error = error.message;
            this.messages.push(this.createMessage('assistant', 'Maaf, saya belum bisa menjawab saat ini. Silakan coba lagi nanti.'));
        } finally {
            this.loading = false;
            this.scrollToLatest();
        }
    },

    scrollToLatest() {
        this.$nextTick(() => {
            const container = this.$refs.chatLog;

            if (container) {
                const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                container.scrollTo({ top: container.scrollHeight, behavior: prefersReducedMotion ? 'auto' : 'smooth' });
            }
        });
    },
}));

/**
 * Scroll reveal animations.
 * Adds `is-revealed` to `[data-reveal]` elements once they enter the viewport.
 */
function initScrollReveal() {
    const elements = document.querySelectorAll('[data-reveal]');

    if (elements.length === 0) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || ! ('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-revealed'));

        return;
    }

    document.documentElement.dataset.revealInitialized = 'true';

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (! entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -60px 0px',
    });

    elements.forEach((element) => observer.observe(element));
}

Alpine.start();

initScrollReveal();
