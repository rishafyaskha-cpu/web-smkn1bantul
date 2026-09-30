@php
    use App\Support\Site;
@endphp

<section class="section">
    <div class="container-page">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="relative overflow-hidden rounded-2xl shadow-card ring-1 ring-slate-900/5" data-reveal="right">
                <img src="{{ Site::heroImage() }}" alt="{{ Site::name() }}" loading="lazy"
                     class="h-72 w-full object-cover brightness-[0.65] sm:h-80 lg:h-full lg:min-h-[26rem]">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/85 via-slate-950/40 to-transparent p-6 pt-16 sm:p-8 sm:pt-20">
                    <img src="{{ asset('images/location label.png') }}" alt="" class="mb-3 w-24 sm:w-28" loading="lazy">
                    <h2 class="font-display text-xl font-bold text-white sm:text-2xl">{{ Site::name() }}</h2>
                    <p class="mt-1.5 max-w-md text-sm leading-relaxed text-slate-200">{{ Site::address() }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <div class="overflow-hidden rounded-2xl shadow-card ring-1 ring-slate-900/5" data-reveal="left" data-reveal-delay="100">
                    <iframe title="Lokasi {{ Site::name() }}" src="{{ Site::mapEmbedUrl() }}" width="100%" height="260"
                            style="border: 0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="h-64 w-full sm:h-72"></iframe>
                </div>

                <div class="card flex flex-1 flex-col p-6 sm:p-7" data-reveal="left" data-reveal-delay="150">
                    <h3 class="font-display text-lg font-bold text-slate-900">Hubungi Kami</h3>

                    <dl class="mt-5 space-y-4 text-sm">
                        @if (Site::phone())
                            <div class="flex items-start gap-3">
                                <img src="{{ asset('images/telepon-label.png') }}" alt="" width="20" height="20" class="mt-0.5 h-5 w-5 object-contain" loading="lazy">
                                <div>
                                    <dt class="text-xs font-medium text-slate-500">Telepon</dt>
                                    <dd class="mt-0.5">
                                        <a href="tel:{{ preg_replace('/\s+/', '', Site::phone()) }}" class="text-slate-800 transition-colors hover:text-brand-navy">{{ Site::phone() }}</a>
                                    </dd>
                                </div>
                            </div>
                        @endif

                        @if (Site::get('contact.email'))
                            <div class="flex items-start gap-3">
                                <img src="{{ asset('images/email label.png') }}" alt="" width="20" height="20" class="mt-0.5 h-5 w-5 object-contain" loading="lazy">
                                <div class="min-w-0">
                                    <dt class="text-xs font-medium text-slate-500">Email</dt>
                                    <dd class="mt-0.5">
                                        <a href="mailto:{{ Site::get('contact.email') }}" class="break-all text-slate-800 transition-colors hover:text-brand-navy">{{ Site::get('contact.email') }}</a>
                                    </dd>
                                </div>
                            </div>
                        @endif
                    </dl>

                    <x-button :href="Site::mapsUrl()" target="_blank" variant="dark" size="lg" class="mt-6 w-full">
                        Petunjuk Arah
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</section>
