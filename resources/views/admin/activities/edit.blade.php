@extends('admin.layout')

@section('title', 'Edit Activity')

@section('content')
<div class="space-y-6">
    <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">← Back to Activities</a>

    <x-admin.card>
        <x-slot:header><h2 class="text-lg font-semibold text-slate-800">Edit Activity</h2></x-slot:header>
        <form action="{{ route('admin.activities.update', $activity) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}" required class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">{{ old('description', $activity->description) }}</textarea>
                </div>
                <div>
                    <label for="tags" class="block text-sm font-medium text-slate-700">Tags</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', $activity->tags) }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-slate-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $activity->location) }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="working_hours" class="block text-sm font-medium text-slate-700">Working Hours</label>
                    <input type="text" name="working_hours" id="working_hours" value="{{ old('working_hours', $activity->working_hours) }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $activity->phone) }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="rate" class="block text-sm font-medium text-slate-700">Rate</label>
                    <input type="number" name="rate" id="rate" value="{{ old('rate', $activity->rate) }}" step="0.01" min="0" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div class="sm:col-span-2">
                    <label for="category_id" class="block text-sm font-medium text-slate-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                        <option value="">— None —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $activity->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex gap-3">
                <x-admin.btn type="submit" variant="primary">Update</x-admin.btn>
                <x-admin.btn href="{{ route('admin.activities.index') }}" variant="secondary">Cancel</x-admin.btn>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
