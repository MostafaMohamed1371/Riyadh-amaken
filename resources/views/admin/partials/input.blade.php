@props(['type' => 'text', 'name', 'id' => null, 'value' => '', 'class' => ''])
@php
    $id = $id ?? $name;
    $inputClass = 'block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 ' . ($class ?: '');
@endphp
<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => $inputClass]) }}>
