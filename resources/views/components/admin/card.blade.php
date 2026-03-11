@props(['bodyClass' => ''])
<div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm {{ $attributes->get('class') }}">
    @if(isset($header))
        <div class="border-b border-slate-200/60 bg-slate-50/50 px-6 py-4">
            {{ $header }}
        </div>
    @endif
    <div class="{{ isset($header) ? 'p-6' : 'p-0' }} {{ $bodyClass }}">
        {{ $slot }}
    </div>
</div>
