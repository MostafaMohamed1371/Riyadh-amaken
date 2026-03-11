@extends('admin.layout')

@section('title', 'Add Gallery Item')

@section('content')
<div class="space-y-6">
    <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">← Back to Gallery</a>

    <x-admin.card>
        <x-slot:header><h2 class="text-lg font-semibold text-slate-800">New Gallery Item</h2></x-slot:header>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
                <div>
                    <label for="link" class="block text-sm font-medium text-slate-700">Link</label>
                    <input type="url" name="link" id="link" value="{{ old('link') }}" placeholder="https://..." class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
            </div>
            <div class="flex gap-3">
                <x-admin.btn type="submit" variant="primary">Create</x-admin.btn>
                <x-admin.btn href="{{ route('admin.gallery.index') }}" variant="secondary">Cancel</x-admin.btn>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
