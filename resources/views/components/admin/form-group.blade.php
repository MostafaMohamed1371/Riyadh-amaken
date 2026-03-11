@props(['label' => null, 'name' => null, 'required' => false, 'hint' => null])
<div class="space-y-1.5">
    @if($label && $name)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    {{ $slot }}
    @if($hint)<p class="text-xs text-slate-500">{{ $hint }}</p>@endif
</div>
