@props(['href', 'active' => false])

<a href="{{ $href }}"
   @class([
       'rounded-lg px-3 py-2 text-sm font-medium transition-colors',
       'bg-white/15 text-white' => $active,
       'text-slate-300 hover:bg-white/10 hover:text-white' => ! $active,
   ])
   @if ($active) aria-current="page" @endif>
    {{ $slot }}
</a>
