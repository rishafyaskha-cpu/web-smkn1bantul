@props([
    'caption' => null,
    'headers' => [],
    'rows' => [],
])

@if (count($rows) > 0)
    <div {{ $attributes->merge(['class' => 'overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-slate-900/5']) }} data-reveal="up">
        @if ($caption)
            <p class="border-b border-slate-100 px-6 py-4 text-sm font-semibold uppercase tracking-wider text-slate-700">{{ $caption }}</p>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-surface text-xs uppercase tracking-wide text-slate-600">
                    <tr>
                        @foreach ($headers as $index => $header)
                            <th scope="col" @class([
                                'px-6 py-3.5 font-semibold',
                                'w-20' => $index === 0,
                            ])>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($rows as $row)
                        <tr class="transition-colors duration-150 hover:bg-surface">
                            @foreach ((array) $row as $index => $cell)
                                <td @class([
                                    'px-6 py-4',
                                    'font-medium text-slate-900' => $index === 0,
                                    'text-slate-600' => $index > 0,
                                ])>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
