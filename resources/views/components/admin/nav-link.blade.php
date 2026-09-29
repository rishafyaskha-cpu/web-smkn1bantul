@props(['href', 'active' => false])

<a href="{{ $href }}"
   @class([
       'rounded-lg px-3 py-1.5 text-sm transition',
       'bg-white/15 font-semibold text-white' => $active,
       'text-blue-100 hover:bg-white/10 hover:text-white' => ! $active,
   ])
   @if ($active) aria-current="page" @endif>
    {{ $slot }}
</a>
