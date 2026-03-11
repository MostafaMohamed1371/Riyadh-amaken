@extends('auth.layout')

@section('title', 'Create account')

@section('branding_text', 'Create an account to access the dashboard and start managing your content.')

@section('form_heading', 'Create account')
@section('form_subheading', 'Register with your name and email to get started.')

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

    <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Full name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Your name"
                class="mt-1.5 block w-full rounded-lg border border-slate-300 bg-slate-50/50 px-4 py-3 text-slate-800 placeholder-slate-400 transition focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 @error('name') border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" aria-describedby="{{ $errors->has('name') ? 'name-error' : '' }}">
            @error('name')
                <p id="name-error" class="mt-1.5 flex items-center gap-1.5 text-sm font-medium text-red-600" role="alert">
                    <span class="inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-red-500" aria-hidden="true"></span>{{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" placeholder="you@example.com"
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
            <input type="password" name="password" id="password" required autocomplete="new-password" placeholder="••••••••"
                class="mt-1.5 block w-full rounded-lg border border-slate-300 bg-slate-50/50 px-4 py-3 text-slate-800 placeholder-slate-400 transition focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 @error('password') border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" aria-describedby="{{ $errors->has('password') ? 'password-error' : '' }}">
            <p class="mt-1.5 text-xs text-slate-500">At least 8 characters.</p>
            @error('password')
                <p id="password-error" class="mt-1.5 flex items-center gap-1.5 text-sm font-medium text-red-600" role="alert">
                    <span class="inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-red-500" aria-hidden="true"></span>{{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                class="mt-1.5 block w-full rounded-lg border border-slate-300 bg-slate-50/50 px-4 py-3 text-slate-800 placeholder-slate-400 transition focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 @error('password_confirmation') border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/20 @enderror"
                aria-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}" aria-describedby="{{ $errors->has('password_confirmation') ? 'password_confirmation-error' : '' }}">
            @error('password_confirmation')
                <p id="password_confirmation-error" class="mt-1.5 flex items-center gap-1.5 text-sm font-medium text-red-600" role="alert">
                    <span class="inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-red-500" aria-hidden="true"></span>{{ $message }}
                </p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full rounded-xl bg-emerald-600 px-4 py-3.5 font-semibold text-white shadow-md shadow-emerald-900/20 transition hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-900/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 active:bg-emerald-800">
                Create account
            </button>
        </div>
    </form>
@endsection

@section('footer_links')
    <p class="text-sm text-slate-600">Already have an account? <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">Sign in</a></p>
@endsection
