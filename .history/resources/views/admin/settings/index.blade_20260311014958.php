@extends('admin.layout')

@section('title', 'Settings')

@section('content')
<div class="space-y-6">
    <p class="text-slate-500">Manage site name and contact email.</p>

    <x-admin.card>
        <x-slot:header>
            <h2 class="text-lg font-semibold text-slate-800">Settings</h2>
        </x-slot:header>
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                @foreach($settingKeys as $key => $label)
                    <div class="flex flex-col gap-2 rounded-xl border border-slate-200/80 bg-slate-50/30 p-4 sm:flex-row sm:items-center sm:gap-4">
                        <div class="min-w-0 flex-1">
                            <label class="block text-xs font-medium uppercase tracking-wider text-slate-500">Key</label>
                            <input type="text" name="settings[{{ $loop->index }}][key]" value="{{ $key }}" readonly class="mt-1 block w-full rounded-lg border-slate-200 bg-slate-100/80 px-3 py-2 text-sm text-slate-600">
                        </div>
                        <div class="min-w-0 flex-[2]">
                            <label class="block text-sm font-medium text-slate-700">{{ $label }}</label>
                            @if($key === 'contact_email')
                                <input type="email" name="settings[{{ $loop->index }}][value]" value="{{ old('settings.'.$loop->index.'.value', $values[$key] ?? '') }}" placeholder="info@example.com" class="mt-1 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 @error('contact_email') border-red-400 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                @error('contact_email')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            @else
                                <input type="text" name="settings[{{ $loop->index }}][value]" value="{{ old('settings.'.$loop->index.'.value', $values[$key] ?? '') }}" placeholder="{{ $key === 'site_name' ? config('app.name') : '' }}" class="mt-1 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex gap-3">
                <x-admin.btn type="submit" variant="primary">Update Settings</x-admin.btn>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
