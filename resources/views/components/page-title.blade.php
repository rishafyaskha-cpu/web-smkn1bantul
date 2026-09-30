@props(['text' => null, 'description' => null])

<header {{ $attributes->merge(['class' => 'border-b border-slate-200/80 bg-surface']) }}>
    <div class="container-page py-10 sm:py-12 lg:py-14">
        <p class="eyebrow">{{ \App\Support\Site::shortName() }}</p>

        @if ($text)
            <h1 class="mt-3 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                {{ $text }}
            </h1>
        @endif

        @if ($description)
            <p class="mt-3 max-w-2xl leading-relaxed text-slate-600">{{ $description }}</p>
        @endif

        @unless ($slot->isEmpty())
            <div class="mt-6">{{ $slot }}</div>
        @endunless
    </div>
</header>
