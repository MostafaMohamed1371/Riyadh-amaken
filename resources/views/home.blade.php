<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <title>{{ $settings['site_name'] ?? config('app.name') }} – Discover Riyadh</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body { font-family: 'DM Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    {{-- Header --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold text-slate-800">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-500 text-white text-sm font-bold">R</span>
                <span>{{ $settings['site_name'] ?? config('app.name') }}</span>
            </a>
            <nav class="flex items-center gap-2">
                @auth
                    <a href="{{ url('/admin/sliders') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700">Admin</a>
                    <span class="text-sm text-slate-500">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700">Log in</a>
                    <a href="{{ route('register') }}" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        {{-- Sliders / Hero --}}
        @if($sliders->isNotEmpty())
            <section class="relative overflow-hidden bg-slate-900">
                <div class="flex snap-x snap-mandatory overflow-x-auto scroll-smooth">
                    @foreach($sliders as $slider)
                        <div class="relative flex min-w-full snap-center items-center justify-center px-4 py-16 sm:py-24 lg:py-32">
                            @if($slider->image)
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="absolute inset-0 h-full w-full object-cover opacity-40">
                            @endif
                            <div class="relative z-10 max-w-2xl text-center">
                                <h1 class="text-3xl font-bold text-white drop-shadow sm:text-4xl lg:text-5xl">{{ $slider->title }}</h1>
                                @if($slider->description)
                                    <p class="mt-4 text-lg text-slate-200">{{ $slider->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @else
            <section class="bg-gradient-to-br from-emerald-600 to-emerald-800 px-4 py-20 text-center sm:py-28">
                <h1 class="text-3xl font-bold text-white sm:text-4xl lg:text-5xl">{{ $settings['site_name'] ?? config('app.name') }}</h1>
                <p class="mx-auto mt-4 max-w-xl text-lg text-emerald-100">Discover places and events in Riyadh.</p>
            </section>
        @endif

        {{-- Categories --}}
        @if($categories->isNotEmpty())
            <section class="mx-auto max-w-6xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8">
                <h2 class="text-2xl font-bold text-slate-800 sm:text-3xl">Categories</h2>
                <p class="mt-2 text-slate-500">Explore by type of place.</p>
                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($categories as $category)
                        <a href="#" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:border-emerald-200 hover:shadow-md">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}" class="h-40 w-full object-cover transition group-hover:scale-105">
                            @else
                                <div class="flex h-40 w-full items-center justify-center bg-slate-100 text-slate-400">
                                    <span class="text-4xl font-bold">{{ Str::limit($category->title, 1) }}</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-slate-800 group-hover:text-emerald-600">{{ $category->title }}</h3>
                                @if($category->no_places)
                                    <p class="mt-1 text-sm text-slate-500">{{ $category->no_places }} places</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Gallery --}}
        @if($gallery->isNotEmpty())
            <section class="border-t border-slate-200 bg-white py-12 sm:py-16">
                <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-slate-800 sm:text-3xl">Gallery</h2>
                    <p class="mt-2 text-slate-500">See what’s happening in Riyadh.</p>
                    <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach($gallery as $item)
                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-xl shadow-sm ring-1 ring-slate-200/80 transition hover:ring-emerald-300 hover:shadow-md">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" class="aspect-square w-full object-cover transition hover:scale-105">
                                    @else
                                        <div class="aspect-square w-full bg-slate-100"></div>
                                    @endif
                                </a>
                            @else
                                <div class="overflow-hidden rounded-xl shadow-sm ring-1 ring-slate-200/80">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" class="aspect-square w-full object-cover">
                                    @else
                                        <div class="aspect-square w-full bg-slate-100"></div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Activities --}}
        @if($activities->isNotEmpty())
            <section class="mx-auto max-w-6xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8">
                <h2 class="text-2xl font-bold text-slate-800 sm:text-3xl">Activities & Places</h2>
                <p class="mt-2 text-slate-500">Things to do and places to visit.</p>
                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($activities as $activity)
                        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:border-emerald-200 hover:shadow-md">
                            <div class="p-4">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-semibold text-slate-800">{{ $activity->title }}</h3>
                                    @if($activity->rate !== null)
                                        <span class="shrink-0 rounded-lg bg-amber-100 px-2 py-0.5 text-sm font-medium text-amber-800">{{ number_format($activity->rate, 1) }}</span>
                                    @endif
                                </div>
                                @if($activity->category)
                                    <p class="mt-1 text-sm text-slate-500">{{ $activity->category->title }}</p>
                                @endif
                                @if($activity->location)
                                    <p class="mt-2 text-sm text-slate-600">{{ Str::limit($activity->location, 40) }}</p>
                                @endif
                                @if($activity->description)
                                    <p class="mt-2 line-clamp-2 text-sm text-slate-500">{{ $activity->description }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Events --}}
        @if($events->isNotEmpty())
            <section class="border-t border-slate-200 bg-white py-12 sm:py-16">
                <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-slate-800 sm:text-3xl">Upcoming Events</h2>
                    <p class="mt-2 text-slate-500">Don’t miss what’s next.</p>
                    <div class="mt-8 space-y-4">
                        @foreach($events as $event)
                            <article class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition hover:border-emerald-200 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h3 class="font-semibold text-slate-800">{{ $event->title }}</h3>
                                    <p class="mt-1 text-sm text-slate-500">
                                        @if($event->date)
                                            {{ $event->date->format('l, F j, Y') }}
                                            @if($event->time)
                                                · {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                                            @endif
                                        @endif
                                        @if($event->location)
                                            <span class="block mt-0.5">{{ $event->location }}</span>
                                        @endif
                                    </p>
                                </div>
                                @if($event->description)
                                    <p class="line-clamp-2 text-sm text-slate-600 sm:max-w-md">{{ $event->description }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Empty state --}}
        @if($sliders->isEmpty() && $categories->isEmpty() && $gallery->isEmpty() && $activities->isEmpty() && $events->isEmpty())
            <section class="mx-auto max-w-2xl px-4 py-20 text-center sm:py-28">
                <h2 class="text-2xl font-bold text-slate-800">Welcome to {{ $settings['site_name'] ?? config('app.name') }}</h2>
                <p class="mt-4 text-slate-500">Content is being prepared. Add sliders, categories, gallery, activities, and events from the admin panel.</p>
                @auth
                    <a href="{{ url('/admin/sliders') }}" class="mt-8 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-emerald-700">Go to Admin</a>
                @else
                    <a href="{{ route('login') }}" class="mt-8 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-emerald-700">Log in</a>
                @endauth
            </section>
        @endif
    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 bg-white py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <p class="text-sm text-slate-500">{{ $settings['site_name'] ?? config('app.name') }} · Riyadh</p>
                @auth
                    <a href="{{ url('/admin/sliders') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">Register</a>
                @endauth
            </div>
        </div>
    </footer>
</body>
</html>
