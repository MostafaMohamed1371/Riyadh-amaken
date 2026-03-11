@extends('admin.layout')

@section('title', 'Create Event')

@section('content')
<div class="space-y-6">
    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">← Back to Events</a>

    <x-admin.card>
        <x-slot:header><h2 class="text-lg font-semibold text-slate-800">New Event</h2></x-slot:header>
        <form action="{{ route('admin.events.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-slate-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="time" class="block text-sm font-medium text-slate-700">Time</label>
                    <input type="time" name="time" id="time" value="{{ old('time') }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div class="sm:col-span-2">
                    <label for="location" class="block text-sm font-medium text-slate-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
            </div>
            <div class="flex gap-3">
                <x-admin.btn type="submit" variant="primary">Create</x-admin.btn>
                <x-admin.btn href="{{ route('admin.events.index') }}" variant="secondary">Cancel</x-admin.btn>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
