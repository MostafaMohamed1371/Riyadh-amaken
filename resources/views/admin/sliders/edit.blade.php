@extends('admin.layout')

@section('title', 'Edit Slider')

@section('content')
<div class="space-y-6">
    <a href="{{ route('admin.sliders.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">← Back to Sliders</a>

    <x-admin.card>
        <x-slot:header>
            <h2 class="text-lg font-semibold text-slate-800">Edit Slider</h2>
        </x-slot:header>
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $slider->title) }}" required
                        class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">{{ old('description', $slider->description) }}</textarea>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700">Image</label>
                    @if($slider->image)
                        <p class="mb-1.5 text-xs text-slate-500">Current: <img src="{{ asset('storage/' . $slider->image) }}" alt="" class="inline h-10 w-16 rounded-lg object-cover align-middle"></p>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>
            <div class="flex gap-3">
                <x-admin.btn type="submit" variant="primary">Update</x-admin.btn>
                <x-admin.btn href="{{ route('admin.sliders.index') }}" variant="secondary">Cancel</x-admin.btn>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
