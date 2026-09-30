@props(['items' => null])

@php
    $items = $items ?? \App\Models\SiteStatistic::ordered()->get();
@endphp

@if ($items->isNotEmpty())
    <section class="bg-white">
        <div class="container-page">
            <div {{ $attributes->merge(['class' => 'relative -mt-px rounded-2xl bg-brand-teal px-6 py-8 shadow-panel sm:px-10 sm:py-10']) }}>
                <dl class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-4" data-reveal="up">
                    @foreach ($items as $item)
                        <div class="text-center sm:text-left">
                            <dd class="font-display text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                {{ $item->value }}
                            </dd>
                            <dt class="mt-1.5 text-sm font-medium text-slate-300">
                                {{ $item->label }}
                            </dt>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>
@endif
