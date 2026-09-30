@props(['href', 'active' => false])

<a href="{{ $href }}"
   @class([
       'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors',
       'bg-blue-50 text-brand-navy' => $active,
       'text-slate-600 hover:bg-white hover:text-brand-navy' => ! $active,
   ])
   @if ($active) aria-current="page" @endif>
    {{ $slot }}
</a>
