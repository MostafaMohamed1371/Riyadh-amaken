@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Welcome --}}
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Welcome back, {{ auth()->user()->name }}</h2>
        <p class="mt-1 text-slate-500">Here’s an overview of your content.</p>
    </div>

    {{-- Stats grid --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('admin.sliders.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Sliders</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $stats['sliders'] }}</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-200">S</span>
            </div>
            <p class="mt-3 text-sm text-slate-500">Homepage sliders</p>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Categories</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $stats['categories'] }}</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 text-sky-600 transition group-hover:bg-sky-200">C</span>
            </div>
            <p class="mt-3 text-sm text-slate-500">Place categories</p>
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Gallery</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $stats['gallery'] }}</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-amber-600 transition group-hover:bg-amber-200">G</span>
            </div>
            <p class="mt-3 text-sm text-slate-500">Gallery items</p>
        </a>
        <a href="{{ route('admin.activities.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Activities</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $stats['activities'] }}</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-600 transition group-hover:bg-violet-200">A</span>
            </div>
            <p class="mt-3 text-sm text-slate-500">Activities & places</p>
        </a>
        <a href="{{ route('admin.events.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Events</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $stats['events'] }}</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-100 text-rose-600 transition group-hover:bg-rose-200">E</span>
            </div>
            <p class="mt-3 text-sm text-slate-500">Upcoming events</p>
        </a>
        <a href="{{ route('admin.users.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Users</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $stats['users'] }}</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition group-hover:bg-slate-200">U</span>
            </div>
            <p class="mt-3 text-sm text-slate-500">Registered users</p>
        </a>
    </div>

    {{-- Quick actions --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-800">Quick actions</h3>
        <div class="mt-4 flex flex-wrap gap-3">
            <x-admin.btn href="{{ route('admin.sliders.create') }}" variant="primary">Add Slider</x-admin.btn>
            <x-admin.btn href="{{ route('admin.categories.create') }}" variant="secondary">Add Category</x-admin.btn>
            <x-admin.btn href="{{ route('admin.gallery.create') }}" variant="secondary">Add Gallery Item</x-admin.btn>
            <x-admin.btn href="{{ route('admin.activities.create') }}" variant="secondary">Add Activity</x-admin.btn>
            <x-admin.btn href="{{ route('admin.events.create') }}" variant="secondary">Add Event</x-admin.btn>
        </div>
    </div>
</div>
@endsection
