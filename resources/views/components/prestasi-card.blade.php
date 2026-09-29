@props(['item' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl h-full shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center p-4']) }}>
    <div class="w-full h-full bg-gray-300 overflow-hidden">
        <img src="{{ $item->image_url ?: asset('images/placeholder.svg') }}" alt="{{ $item->title }}" loading="lazy"
             class="w-full h-full object-cover aspect-square">
    </div>
    <div class="p-6 text-center h-full">
        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $item->title }}</h3>
        <p class="text-sm text-gray-600 leading-relaxed">{{ $item->description }}</p>
    </div>
</div>
