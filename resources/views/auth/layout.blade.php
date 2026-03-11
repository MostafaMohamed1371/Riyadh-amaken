<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <title>@yield('title', 'Sign in') – {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body { font-family: 'DM Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        {{-- Left: branding (hidden on small screens) --}}
        <div class="relative hidden lg:flex lg:min-h-screen lg:flex-1 lg:flex-col bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 px-12 py-16 xl:px-16 xl:py-20">
            {{-- Same column: R + Riyadh Amaken, tagline, copyright --}}
            <div class="flex flex-col gap-8">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-white hover:opacity-95 transition-opacity">
                        <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-white/25 text-2xl font-bold text-white shadow-lg backdrop-blur-sm">R</span>
                        <span class="text-2xl font-bold tracking-tight text-white">{{ config('app.name') }}</span>
                    </a>
                </div>
                <p class="max-w-sm text-[15px] leading-relaxed text-white/95">
                    @yield('branding_text', 'Manage your content and discover what’s happening in Riyadh.')
                </p>
                <p class="text-sm font-medium text-white/90">© {{ date('Y') }} {{ config('app.name') }}</p>
            </div>
        </div>

        {{-- Right: form --}}
        <div class="flex flex-1 flex-col justify-center bg-gradient-to-b from-slate-50 to-slate-100 px-6 py-12 sm:px-14 lg:px-20">
            <div class="mx-auto w-full max-w-[420px]">
                <a href="{{ route('home') }}" class="mb-10 flex items-center gap-2.5 font-bold text-slate-800 lg:hidden">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-white text-lg font-bold shadow-md">R</span>
                    <span class="text-lg">{{ config('app.name') }}</span>
                </a>

                <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-xl shadow-slate-300/25 ring-1 ring-slate-900/5">
                    <div class="border-b border-slate-100 bg-slate-50/50 px-8 pt-8 pb-6 sm:px-10">
                        <h1 class="text-2xl font-bold tracking-tight text-slate-900">@yield('form_heading', 'Sign in')</h1>
                        <p class="mt-1.5 text-sm text-slate-500">@yield('form_subheading', 'Enter your credentials to continue.')</p>
                    </div>
                    <div class="p-8 sm:p-10">
                        @yield('content')
                    </div>
                </div>

                <div class="mt-8 rounded-xl border border-slate-200/80 bg-white/80 px-6 py-4 text-center shadow-sm">
                    @yield('footer_links')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
