@props([
    'caption' => null,
    'headers' => [],
    'rows' => [],
])

@if (count($rows) > 0)
    <div {{ $attributes->merge(['class' => 'bg-white rounded-lg sm:rounded-xl lg:rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden']) }} data-reveal="up">
        @if ($caption)
            <p class="px-4 sm:px-6 pt-4 sm:pt-6 text-sm font-semibold uppercase tracking-wider text-gray-700">{{ $caption }}</p>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        @foreach ($headers as $index => $header)
                            <th scope="col" @class([
                                'px-3 sm:px-4 lg:px-6 py-2 sm:py-3 lg:py-4 text-xs sm:text-sm font-semibold text-gray-700 uppercase tracking-wider',
                                'text-left' => $index > 0,
                                'w-16 sm:w-20 lg:w-24 text-left' => $index === 0,
                            ])>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            @foreach ((array) $row as $index => $cell)
                                <td @class([
                                    'px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base',
                                    'text-gray-700 font-medium' => $index === 0,
                                    'text-gray-600' => $index > 0,
                                ])>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
