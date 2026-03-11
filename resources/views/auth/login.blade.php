@extends('auth.layout')

@section('title', 'Sign in')

@section('branding_text', 'Sign in to access the dashboard and manage your content.')

@section('form_heading', 'Sign in')
@section('form_subheading', 'Enter your email and password to continue.')

@section('content')
    @if ($errors->any())
        <div class="mb-6 flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4" role="alert">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600" aria-hidden="true">!</span>
            <div class="min-w-0 flex-1">
                <p class="font-medium text-red-800">Please fix the errors below.</p>
                <ul class="mt-1.5 list-inside space-y-0.5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com"
                class="mt-1.5 block w-full rounded-lg border border-slate-300 bg-slate-50/50 px-4 py-3 text-slate-800 placeholder-slate-400 transition focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 @error('email') border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}">
            @error('email')
                <p id="email-error" class="mt-1.5 flex items-center gap-1.5 text-sm font-medium text-red-600" role="alert">
                    <span class="inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-red-500" aria-hidden="true"></span>{{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <input type="password" name="password" id="password" required autocomplete="current-password" placeholder="••••••••"
                class="mt-1.5 block w-full rounded-lg border border-slate-300 bg-slate-50/50 px-4 py-3 text-slate-800 placeholder-slate-400 transition focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 @error('password') border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" aria-describedby="{{ $errors->has('password') ? 'password-error' : '' }}">
            @error('password')
                <p id="password-error" class="mt-1.5 flex items-center gap-1.5 text-sm font-medium text-red-600" role="alert">
                    <span class="inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-red-500" aria-hidden="true"></span>{{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex items-center pt-1">
            <input type="checkbox" name="remember" id="remember"
                class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-2 focus:ring-emerald-500/30">
            <label for="remember" class="ml-2.5 text-sm text-slate-600">Remember me</label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full rounded-xl bg-emerald-600 px-4 py-3.5 font-semibold text-white shadow-md shadow-emerald-900/20 transition hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-900/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 active:bg-emerald-800">
                Sign in
            </button>
        </div>
    </form>
@endsection

@section('footer_links')
    <p class="text-sm text-slate-600">Don't have an account? <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">Create account</a></p>
@endsection
