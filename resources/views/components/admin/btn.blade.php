@props(['variant' => 'primary', 'type' => 'button', 'href' => null])
@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 no-underline';
    $variants = [
        'primary' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus:ring-emerald-500',
        'secondary' => 'border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 focus:ring-slate-400',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'ghost' => 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-400',
    ];
    $class = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp
@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</button>
@endif
