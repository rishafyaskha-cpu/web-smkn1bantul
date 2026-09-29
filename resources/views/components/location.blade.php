@php
    use App\Support\Site;
@endphp

<section class="w-full bg-gray-50 py-12 sm:py-16 px-4 sm:px-6 lg:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-5 md:grid-rows-4 gap-4 md:gap-6">
        <div class="md:col-span-3 md:row-span-2 relative rounded-2xl overflow-hidden shadow-md" data-reveal="right">
            <img src="{{ Site::heroImage() }}" alt="{{ Site::name() }}" loading="lazy"
                 class="w-full h-56 sm:h-64 md:h-80 object-cover brightness-75">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute top-3 left-3 md:top-4 md:left-4">
                <img src="{{ asset('images/location label.png') }}" alt="Lokasi" class="w-24 sm:w-28 md:w-35" loading="lazy">
            </div>
            <div class="absolute bottom-3 left-3 md:bottom-4 md:left-4 text-white pr-3">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-poppins mb-1">{{ Site::name() }}</h2>
                <p class="text-xs sm:text-sm md:text-base max-w-md leading-snug">{{ Site::address() }}</p>
            </div>
        </div>

        <div class="md:col-start-1 md:col-span-3 md:row-start-3 md:row-span-2 rounded-2xl overflow-hidden shadow-md order-3 md:order-none" data-reveal="right" data-reveal-delay="150">
            <iframe title="Lokasi {{ Site::name() }}" src="{{ Site::mapEmbedUrl() }}" width="100%" height="280"
                    style="border: 0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-56 sm:h-64 md:h-full rounded-2xl"></iframe>
        </div>

        <div class="flex flex-wrap md:flex-col items-center justify-center gap-2 sm:gap-3 md:gap-4 md:col-span-2 md:row-span-2 md:col-start-4 md:row-start-1 text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-poppins text-gray-900 py-6 md:py-0 order-1 md:order-none" data-reveal="left">
            <span>Temukan</span>
            <span class="text-[#063852]">Kami</span>
            <span>di sini</span>
        </div>

        <div class="md:col-span-2 md:row-span-2 md:col-start-4 md:row-start-3 md:ml-2 bg-white border border-gray-200 shadow-md rounded-2xl p-5 sm:p-6 w-full space-y-3 sm:space-y-4 order-2 md:order-none" data-reveal="left" data-reveal-delay="150">
            <h3 class="text-lg sm:text-xl font-semibold border-b border-gray-300 pb-2 text-[#063852]">Hubungi Kami</h3>

            @if (Site::phone())
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/telepon-label.png') }}" alt="Telepon" width="24" height="24" loading="lazy">
                    <a href="tel:{{ preg_replace('/\s+/', '', Site::phone()) }}" class="text-sm sm:text-base text-gray-700 hover:text-brand-navy">{{ Site::phone() }}</a>
                </div>
            @endif

            @if (Site::get('contact.email'))
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/email label.png') }}" alt="Email" width="24" height="24" loading="lazy">
                    <a href="mailto:{{ Site::get('contact.email') }}" class="text-sm sm:text-base text-gray-700 hover:text-brand-navy break-all">{{ Site::get('contact.email') }}</a>
                </div>
            @endif

            <a href="{{ Site::mapsUrl() }}" target="_blank" rel="noopener noreferrer"
               class="mt-4 sm:mt-6 w-full inline-block text-center bg-[#063852] text-white py-2.5 sm:py-3 rounded-xl text-sm sm:text-base font-medium hover:bg-[#052c42] transition">
                Datang Sekarang
            </a>
        </div>
    </div>
</section>
