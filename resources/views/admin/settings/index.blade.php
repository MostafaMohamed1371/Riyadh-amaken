@extends('admin.layout')

@section('title', 'Settings')

@section('content')
<div class="space-y-6">
    <p class="text-slate-500">Edit key-value settings. Only list and update are available.</p>

    <x-admin.card>
        <x-slot:header>
            <h2 class="text-lg font-semibold text-slate-800">Settings</h2>
        </x-slot:header>
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                @forelse($settings->values() as $index => $setting)
                    <div class="flex flex-col gap-2 rounded-xl border border-slate-200/80 bg-slate-50/30 p-4 sm:flex-row sm:items-center sm:gap-4">
                        <div class="min-w-0 flex-1">
                            <label class="block text-xs font-medium uppercase tracking-wider text-slate-500">Key</label>
                            <input type="text" name="settings[{{ $index }}][key]" value="{{ $setting->key }}" readonly class="mt-1 block w-full rounded-lg border-slate-200 bg-slate-100/80 px-3 py-2 text-sm text-slate-600">
                        </div>
                        <div class="min-w-0 flex-[2]">
                            <label class="block text-xs font-medium uppercase tracking-wider text-slate-500">Value</label>
                            <input type="text" name="settings[{{ $index }}][value]" value="{{ old('settings.'.$index.'.value', $setting->value ?? '') }}" class="mt-1 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                        </div>
                    </div>
                @empty
                    <p class="rounded-xl border border-slate-200 bg-slate-50/50 p-4 text-sm text-slate-500">No settings in the database. Add rows to the <code class="rounded bg-slate-200 px-1.5 py-0.5 font-mono text-xs">settings</code> table (key, value) to manage them here.</p>
                @endforelse
            </div>
            @if($settings->isNotEmpty())
                <div class="flex gap-3">
                    <x-admin.btn type="submit" variant="primary">Update Settings</x-admin.btn>
                </div>
            @endif
        </form>
    </x-admin.card>
</div>
@endsection
