@extends('layouts.auth')

@section('bg_image', asset('images/bg.png'))

@section('content')
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-display font-bold text-gray-900">Welcome Back</h1>
        <p class="text-gray-500 mt-2">Please sign in to your dashboard</p>
    </div>

    @if (session('status'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700 text-sm font-medium border border-green-100">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                       class="block w-full pl-10 pr-3 py-3 rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 focus:bg-white transition-all duration-200" 
                       placeholder="you@example.com">
            </div>
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="block w-full pl-10 pr-3 py-3 rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 focus:bg-white transition-all duration-200"
                       placeholder="••••••••">
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-500 transition-colors" name="remember">
                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-brand-600 hover:text-brand-800 font-semibold transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-500/30 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-200 hover:-translate-y-0.5">
            Sign In
        </button>

        <p class="mt-6 text-center text-sm text-gray-500">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="font-bold text-brand-600 hover:text-brand-500 hover:underline transition-all">
                Create an account
            </a>
        </p>
    </form>
@endsection
    