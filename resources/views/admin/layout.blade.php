<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <title>@yield('title', 'Admin') – {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'DM Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col border-r border-slate-200/60 bg-white shadow-sm lg:flex">
            <div class="flex h-16 items-center gap-2 border-b border-slate-200/60 px-6">
                <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold text-slate-800">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500 text-white text-sm font-bold">R</span>
                    <span>{{ config('app.name') }}</span>
                </a>
            </div>
            <nav class="flex-1 space-y-0.5 overflow-y-auto p-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Dashboard</a>
                <p class="mb-2 mt-4 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">Content</p>
                <a href="{{ route('admin.sliders.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.sliders.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Sliders</a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Categories</a>
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Gallery</a>
                <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.activities.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Activities</a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.events.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Events</a>
                <p class="mb-2 mt-6 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">System</p>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Users</a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Settings</a>
            </nav>
            <div class="border-t border-slate-200/60 space-y-1 p-4">
                <a href="{{ url('/') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-500 hover:bg-slate-100 hover:text-slate-700">← Back to site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-500 hover:bg-slate-100 hover:text-slate-700">Log out</button>
                </form>
            </div>
        </aside>

        <div class="flex flex-1 flex-col lg:pl-64">
            {{-- Top bar (mobile nav) --}}
            <header class="sticky top-0 z-30 border-b border-slate-200/60 bg-white/95 shadow-sm backdrop-blur">
                <div class="flex h-14 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="truncate text-lg font-semibold text-slate-800">@yield('title', 'Admin')</h1>
                    @hasSection('header_action')
                        @yield('header_action')
                    @endif
                </div>
                <nav class="flex gap-1 overflow-x-auto border-t border-slate-100 px-4 py-2 lg:hidden">
                    <a href="{{ route('admin.dashboard') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Dashboard</a>
                    <a href="{{ route('admin.sliders.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Sliders</a>
                    <a href="{{ route('admin.categories.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Categories</a>
                    <a href="{{ route('admin.gallery.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Gallery</a>
                    <a href="{{ route('admin.activities.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Activities</a>
                    <a href="{{ route('admin.events.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Events</a>
                    <a href="{{ route('admin.users.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Users</a>
                    <a href="{{ route('admin.settings.index') }}" class="whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-100">Settings</a>
                </nav>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-600">✓</span>
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-medium">Please fix the following errors:</p>
                        <ul class="mt-1 list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
