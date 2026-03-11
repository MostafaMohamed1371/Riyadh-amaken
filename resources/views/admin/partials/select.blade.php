@props(['name', 'id' => null])
@php
    $id = $id ?? $name;
@endphp
<select name="{{ $name }}" id="{{ $id }}"
    class="block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
    {{ $attributes }}>
    {{ $slot }}
</select>
