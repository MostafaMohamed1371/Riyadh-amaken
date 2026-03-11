@props(['name', 'id' => null])
@php
    $id = $id ?? $name;
@endphp
<textarea name="{{ $name }}" id="{{ $id }}" rows="{{ $rows ?? 4 }}"
    class="block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
    {{ $attributes }}>{{ old($name, $slot ?? '') }}</textarea>
