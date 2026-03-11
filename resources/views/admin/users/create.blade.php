@extends('admin.layout')

@section('title', 'Create User')

@section('content')
<div class="space-y-6">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">← Back to Users</a>

    <x-admin.card>
        <x-slot:header>
            <h2 class="text-lg font-semibold text-slate-800">New User</h2>
        </x-slot:header>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" id="password" required autocomplete="new-password"
                        class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    <p class="mt-1 text-xs text-slate-500">At least 8 characters.</p>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                        class="mt-1.5 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>
            </div>
            <div class="flex gap-3">
                <x-admin.btn type="submit" variant="primary">Create User</x-admin.btn>
                <x-admin.btn href="{{ route('admin.users.index') }}" variant="secondary">Cancel</x-admin.btn>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
